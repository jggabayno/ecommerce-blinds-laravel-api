<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;

use App\Models\Checkout;
use App\Models\Cart;
use App\Models\PaymentDetail;
use App\Models\ModeOfPayment;
use App\Models\OrderStatusHistory;
use App\Models\Notification;
use App\Models\Inventory;
use App\Models\OrderCancellation;

use App\Helpers\Constant;

use App\Events\OrderUpdated;

class OrderController extends Controller
{
    
    public function withDateFilter(Request $request)
    {
        $hasDateToFilter = $request->start_date != '';

        return $hasDateToFilter ? Order::whereBetween('created_at', [$request->start_date, $request->end_date])->latest()->with(['orderItems.order', 'orderItems.color',
        'orderItems.product.brand', 'billings.user', 'payments.mode_of_payment', 'payments.order',
        'orderStatusHistories.orderStatus','orderCancellation'])->get() : 
        Order::latest()->with(['orderItems.order', 'orderItems.color',
        'orderItems.product.brand', 'billings.user', 'payments.mode_of_payment', 'payments.order',
        'orderStatusHistories.orderStatus','orderCancellation'])->get();
    }

    public function index()
    {
        return Order::orderWithRelation();
    }
    

    public function byUser()
    {
        return auth()->user()->orders()
        ->with(['orderItems.order', 'orderItems.color', 'orderItems.product.brand',
        'billings.user', 'payments.mode_of_payment', 'orderStatusHistories.orderStatus', 'consumer','rates','orderCancellation'])
        ->get();
        
    }

    public function store(Request $request)
    {
        
        $orderNumber = 'FSOR-'.time().$request->user()->id;
 
        // 1. CREATE ORDER
        $order = $request->user()->orders()->create([
            'order_no' => $orderNumber,
            'order_status_id' => 1,
            'shipping_fee' => $request->shipping_fee,
            'total_price' => $request->total_price,
            'message' => $request->message,
        ]);

        $orderStatusHistory = OrderStatusHistory::create([
            'order_id' => $order->id,
            'order_status_id' => $order->order_status_id
        ]);

        // 2. CREATE BILLING DETAILS
        $address = $request->user()->billingDetails()->create([
            'order_id' => $order->id,
            'address' => $request->address
        ]);

        // 3. CREATE PAYMENT DETAILS
        $payment = PaymentDetail::create([
            'order_id' => $order->id,
            'amount' => $request->amount,
            'balance' => ($request->total_price - $request->amount)
        ]);
         
        // 4. CREATE MODE OF PAYMENT DETAILS
        $modeOfPayment = ModeOfPayment::create([
            'payment_detail_id' => $payment->id,
            'name' => $request->mode['name'],
            'details' => json_encode($request->mode['details'])
        ]);

        // 5. CREATE ORDER ITEMS
        foreach($request->items as $item) {
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'color_id' => $item['color_id'],
                'size_id' => $item['size_id'],
                'quantity' => $item['quantity'],
                'ctrl' => $item['ctrl'],
                'product_name' => $item['product_name'],
                'color_name' => $item['color_name'],
                'size_name' => $item['size_name'],
                'unit_price' => $item['unit_price'],
                '_profit' => $item['_profit']
            ]);
            
            $request->user()->inventories()->create([
                'color_id' => $item['color_id'],
                'quantity' => $item['quantity'],
                'type' => 2,
                'remarks' => 'reserved'
            ]);
            
        }

        // 6. DELETING RELATED CHECKOUTS AND CARTS
        
        // this checkout_no need to past in order_post_request as params to make it use here and looks like $request->checkout_no
        $selectedCheckout = $request->user()->checkouts()->where('checkout_no', $request->checkout_no)->with(['checkoutItem'])->first();
        $selectedCheckoutItems = json_decode($selectedCheckout)->checkout_item;
        
        foreach($selectedCheckoutItems as $sci) {

            // DELETE CART
            $selectedCartId = $request->user()->carts()->where('id', $sci->cart_id)->select(['id'])->first()->id;
            $request->user()->carts()->where('id', intval($selectedCartId))->delete();
            // END DELETE CART
        }
     
        // DELETE SELECTED CHECKOUT
        $selectedCheckout->delete();
        // DELETE SELECTED CHECKOUT

        // 7. SEND NOTIFICATION TO CUSTOMER AND TO WHOM CONTROL THE CMS

            // SEND TO CUSTOMER
            Notification::create([
                'title' => 'Order Submitted',
                'content' => 'Your order ' . $order->order_no . ' has been submitted and is awaiting confirmation from staff.',
                'type' =>  Constant::ORDER['SUBMITTED'],
                'reference_id' => $order->id,
                'physical_number' => $order->order_no,
                'user_id' => auth()->user()->id,
            ]);

            // SEND TO WHOM CMS USER
            Notification::create([
                'title' => 'Order Submitted',
                'content' => 'You have received a new order. Please check Order ' . $order->order_no . 'to view the details.',
                'type' =>  Constant::ORDER['SUBMITTED'],
                'reference_id' => $order->id,
                'physical_number' => $order->order_no,
                'user_id' => 1,
            ]);

        return response()->json($selectedCheckoutItems, 200);
    }

    public function update(Order $order, Request $request)
    {

        $matchedOrder = Order::where('id', $order->id);
        
        if($request->order_status_id == Constant::ORDER['FOR_DELIVERY']) {
           $matchedOrder->update([
                'delivery_date' => $request->delivery_date,
                'order_status_id' => $request->order_status_id
            ]);
        } else if($request->order_status_id == Constant::ORDER['COMPLETED']) {
           
            if($request->amount) {
                $payment = PaymentDetail::create([
                    'order_id' => $request->id,
                    'amount' => $request->amount,
                    'balance' => 0
                ]);

                $modeOfPayment = ModeOfPayment::create([
                    'payment_detail_id' => $payment->id,
                    'name' => 'Cash',
                    'details' => json_encode($request->mode['details'])
                ]);
            }
   
            $matchedOrder->update([
                'order_status_id' => $request->order_status_id,
            ]);
        
        } else {

            if ($request->order_status_id == Constant::ORDER['CANCELLED']) {
                $query = OrderCancellation::create([
                    'order_id' => $order->id,
                    'reason' => $request->reason,   
                    'status' => Constant::CANCELLED_STATUS['MANUAL_UPDATE']
                ]);
            }
       
            $matchedOrder->update([
                'order_status_id' => $request->order_status_id,
            ]);
        }

        OrderUpdated::dispatch($matchedOrder->with(['orderItems','orderItems.order', 'orderItems.color'])->first());

        return response()->json(Order::orderWithRelation()->first(), 200);
        
    }

}
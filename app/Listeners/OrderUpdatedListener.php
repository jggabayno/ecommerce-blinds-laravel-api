<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Carbon\Carbon;
use App\Helpers\Constant;
use App\Events\OrderUpdated;
use App\Models\OrderStatusHistory;
use App\Models\Notification;
use App\Models\Inventory;

class OrderUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderUpdated $event)
    {
        $order = $event->order;


        OrderStatusHistory::create([
            'order_id' => $order->id,
            'order_status_id' => $order->order_status_id
        ]);

        // Notify Customer

        if($order->order_status_id == Constant::ORDER['PLACED']) {
            Notification::create([
                'title' => 'Order Placed',
                'content' => 'Your order ' . $order->order_no . ' is has just been placed, It means that your payment has received and your order is confirmed. You will receive an update as soon as your order is being process',
                'type' =>  Constant::ORDER['PLACED'],
                'reference_id' => $order->id,
                'physical_number' => $order->order_no,
                'user_id' => $order->user_id,
            ]);
        }

        if($order->order_status_id == Constant::ORDER['PROCESSING']) {
            Notification::create([
                'title' => 'Order Processing',
                'content' => 'Your order ' . $order->order_no . ' is now being processed. You will receive an update as soon as your order is ready for delivery',
                'type' =>  Constant::ORDER['PROCESSING'],
                'reference_id' => $order->id,
                'physical_number' => $order->order_no,
                'user_id' => $order->user_id,
            ]);
        }

        if($order->order_status_id == Constant::ORDER['FOR_DELIVERY']) {

            Notification::create([
                'title' => 'For Delivery',
                'content' =>  'Your order ' . $order->order_no . ' has been scheduled for delivery on ' . Carbon::parse($order->delivery_date)->format('M d, Y') . '.',
                'type' =>  Constant::ORDER['FOR_DELIVERY'],
                'reference_id' => $order->id,
                'physical_number' => $order->order_no,
                'user_id' => $order->user_id,
            ]);

            
            foreach(json_decode($order)->order_items as $order_item) {

                $selectedIventory = Inventory::where([
                    ['user_id', '=',  $order_item->order->user_id],
                    ['color_id', '=', $order_item->color_id]
                ]);

                $selectedIventory->update([
                    'color_id' => $order_item->color_id,
                    'type' => 3,
                    'remarks' => 'committed on order for delivery'
                ]);

              }

        }

        if($order->order_status_id == Constant::ORDER['DELIVERED']) {
            Notification::create([
                'title' => 'Delivered',
                'content' =>  'Your order ' . $order->order_no . ' has been successfully delivered.',
                'type' =>  Constant::ORDER['DELIVERED'],
                'reference_id' => $order->id,
                'physical_number' => $order->order_no,
                'user_id' => $order->user_id,
            ]);
        }

        
        if($order->order_status_id == Constant::ORDER['CANCELLED']) {
            Notification::create([
                'title' => 'Order Cancelled',
                'content' => 'Your order ' . $order->order_no . ' has been cancelled. You will receive an update regarding the refund process and weather your cancellation of order is approved, rejected, or invalid.',
                'type' =>  Constant::ORDER['CANCELLED'],
                'reference_id' => $order->id,
                'physical_number' => $order->order_no,
                'user_id' => $order->user_id,
            ]);
        }


        if($order->isDirty('delivery_date')) {

            Notification::create([
                'title' => 'Delivery Date Changed',
                'content' =>  'You have successfully changed order ' . $order->order_no . ' delivery date on ' . Carbon::parse($order->delivery_date)->format('M d, Y') . '.',
                'type' => Constant::ORDER['DELIVERY_CHANGED'],
                'reference_id' => $order->id,
                'physical_number' => $order->order_no,
                'user_id' => 1,
            ]);

            Notification::create([
                'title' => 'Delivery Date Changed',
                'content' =>  'Your order ' . $order->order_no .  ' delivery date has been changed on ' . Carbon::parse($order->delivery_date)->format('M d, Y') . '.',
                'type' =>  Constant::ORDER['DELIVERY_CHANGED'],
                'reference_id' => $order->id,
                'physical_number' => $order->order_no,
                'user_id' => $order->user_id,
            ]);

        }

    }
}

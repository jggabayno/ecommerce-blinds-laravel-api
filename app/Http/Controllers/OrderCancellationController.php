<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\OrderCancellation;
use App\Models\Order;
use App\Helpers\Constant;
use App\Events\OrderUpdated;

class OrderCancellationController extends Controller
{
    //

    public function index()
    {
        return OrderCancellation::latest()->get();
    }

    public function withId($order_id)
    {

      return OrderCancellation::where('order_id', $order_id)->get();
    
    }

    public function store(Request $request)
    {
        $matchedOrder = Order::where('id', $request->order_id);
        

        $query = OrderCancellation::create([
            'order_id' => $request->order_id,
            'reason' => $request->reason,   
            'status' => $request->status
        ]);

        $matchedOrder->update([
            'order_status_id' => Constant::ORDER['CANCELLED']
        ]);

        OrderUpdated::dispatch($matchedOrder->with(['orderItems','orderItems.order', 'orderItems.color'])->first());


        if ($query) return response()->json(
            $query->latest()->get()->first()
        , 200);
    }

    public function update(OrderCancellation $order_cancellation, Request $request)
    {
        $selected = OrderCancellation::where('id', $order_cancellation->id);

        $selected->update([
            'order_id' => $request->order_id,
            'reason' => $request->reason,   
            'status' => $request->status
        ]);
        
        
        if ($selected) return response()->json(
            $selected->get()->first()
            ,200);
    }
}

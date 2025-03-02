<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Helpers\Constant;

class AccountReceivableController extends Controller
{

    public function index()
    {   

        return Order::where([
            ['order_status_id', '>=', Constant::ORDER['PLACED']],
            ['order_status_id', '<', Constant::ORDER['COMPLETED']]
            ])->with(['payments','consumer'])
        ->select(['id','user_id','order_status_id','order_no','shipping_fee','total_price'])
        ->get();
    }

    public function withDateFilter(Request $request)
    {
        $hasDateToFilter = $request->start_date != '';

        return $hasDateToFilter ?
        Order::where([
            ['order_status_id', '>=', Constant::ORDER['PLACED']],
            ['order_status_id', '<', Constant::ORDER['COMPLETED']]
        ])
        ->whereBetween('created_at', [$request->start_date, $request->end_date])
        ->select(['id','user_id','order_status_id','order_no','shipping_fee','total_price'])
        ->with(['payments','consumer'])->get()
        :
        Order::where([
            ['order_status_id', '>=', Constant::ORDER['PLACED']],
            ['order_status_id', '<', Constant::ORDER['COMPLETED']]
            ])->with(['payments','consumer'])
        ->select(['id','user_id','order_status_id','order_no','shipping_fee','total_price'])
        ->get();

    }
    
}

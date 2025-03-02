<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentDetail;

class PaymentDetailController extends Controller
{
    public function index()
    {
        return PaymentDetail::with('order','mode_of_payment')->latest()->get();
    }

    
    public function withDateFilter(Request $request)
    {
        $hasDateToFilter = $request->start_date != '';

        return $hasDateToFilter ?
        PaymentDetail::whereBetween('created_at', [$request->start_date, $request->end_date])->latest()->with(['order', 'order.consumer', 'mode_of_payment'])->get() :
        PaymentDetail::latest()->with(['order', 'order.consumer', 'mode_of_payment'])->get();

    }
    
}

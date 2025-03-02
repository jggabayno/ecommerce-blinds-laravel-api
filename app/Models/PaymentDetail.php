<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'amount',
        'balance'
    ];


    public static function withDateFilter($request)
    {

        $hasDateToFilter = $request->start_date != '';
        
        $dataWithFilter = $hasDateToFilter
            ? PaymentDetail::whereBetween('created_at', [$request->start_date, $request->end_date])
            : PaymentDetail::whereNotNull('created_at');
        
            return $dataWithFilter;
    }

    public function mode_of_payment()
    {
        return $this->hasOne(ModeOfPayment::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_status_id',
        'order_no',
        'shipping_fee',
        'total_price',
        'message',
        'delivery_date'
    ];


    public static function monthlyOrders($month, $year)
    {
        return intval(Order::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)->count());
    }

    public static function withDateFilter($request)
    {
        $hasDateToFilter = $request->start_date != '';
        
        $dataWithFilter = $hasDateToFilter
            ? Order::whereBetween('created_at', [$request->start_date, $request->end_date])
            : Order::whereNotNull('created_at');
        
        return $dataWithFilter;
    }


    // CUSTOM HELPERS
    
    public static function orderWithRelation()
    {
        return Order::latest()->with(['orderItems.order', 'orderItems.color',
        'orderItems.product.brand', 'billings.user', 'payments.mode_of_payment', 'payments.order',
        'orderStatusHistories.orderStatus','orderCancellation'])->get();
    }


    // RELATIONSHIPS

    public function orderItemsGetImages()
    {
        return $this->hasMany(OrderItem::class)->select(['id','order_id','color_id']);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function billings()
    {
        return $this->hasMany(BillingDetail::class);
    }

    public function payments()
    {
        return $this->hasMany(PaymentDetail::class, 'order_id');
    }

    public function orderStatusHistories()
    {
        return $this->hasMany(OrderStatusHistory::class);
    }
    
    public function consumer()
    {
        return $this->belongsTo(User::class, 'user_id')
        ->select('id','photo','user_name','first_name','last_name','mobile_number');
    }
    
    public function rates()
    {
        return $this->hasMany(Rate::class)->select(['id','order_id', 'product_id']);
    }

    public function orderCancellation()
    {
        return $this->hasOne(OrderCancellation::class);
    }

}
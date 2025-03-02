<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'checkout_no'
    ];

    public function checkoutItem()
    {
        return $this->hasMany(CheckoutItem::class)->with(['product','color','size']);
    }

    public function withCheckoutAndCart()
    {
        return $this->hasMany(CheckoutItem::class)->select(['id','checkout_id','cart_id']);
    }

}

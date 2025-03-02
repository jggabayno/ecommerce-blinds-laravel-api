<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'photo',
        'description',
        'price_per_square_feet'
    ];

    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function brand()
    {
        return $this->hasMany(Brand::class);
    }

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id')->select('id','order_id','product_id','quantity');
    }
    
}
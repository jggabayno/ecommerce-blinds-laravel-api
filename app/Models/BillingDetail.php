<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function productColors()
    // {
    //     return $this->hasMany(ProductColor::class);
    // }

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'order_id',
        'count',
        'prefer_consumer_name',
        'message',
        'product_variants',
    ];

    
    public function consumer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

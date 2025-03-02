<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'type',
        'reference_id',
        'physical_number',
        'is_seen',
        'is_read'
    ];

    public function orders()
    {
        return $this->belongsTo(Order::class, 'reference_id')->select(['id']);
    }

}

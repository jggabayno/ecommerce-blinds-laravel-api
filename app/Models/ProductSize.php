<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'multiplier',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

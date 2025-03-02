<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'photo',
        'name',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productColors()
    {
        return $this->hasMany(ProductColor::class);
    }

    // public function productColors()
    // {
    //     return $this->belongsTo(ProductColor::class);
    // }

}

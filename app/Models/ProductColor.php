<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'brand_id',
        'photo',
        'name'
    ];


    public static function withDateFilter($request)
    {

        $hasDateToFilter = $request->start_date != '';
        
        $dataWithFilter = $hasDateToFilter
            ? ProductColor::whereBetween('created_at', [$request->start_date, $request->end_date])
            : ProductColor::whereNotNull('created_at');
        
            return $dataWithFilter;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->select('id','price_per_square_feet', 'name');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id')->select('id', 'name');
    }

    public function added_by()
    {
        return $this->belongsTo(User::class, 'user_id')->select('id', 'first_name','last_name');
    }
    
    public function stocks()
    {
        return $this->hasMany(Inventory::class, 'color_id')->select(['id','color_id','quantity','type']);
    }

    public function stock_movement()
    {
        return $this->hasMany(Inventory::class, 'color_id')->select(['id','color_id','quantity','type']);
    }
}

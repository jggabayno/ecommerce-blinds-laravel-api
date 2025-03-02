<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Helpers\Constant;
use DB;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'color_id',
        'size_id',
        'ctrl',
        'quantity',
        'product_name',
        'color_name',
        'size_name',
        'unit_price',
        '_profit'
    ];

    public static function getSalesCount($year, $month)
    {
        
        $deliveredCompletedOrderIds = Order::where([
            ['order_status_id', '>=', Constant::ORDER['DELIVERED']],
            ['order_status_id', '<=', Constant::ORDER['COMPLETED']]
            ])->pluck('id');

        $total_sales = OrderItem::whereIn('order_id', $deliveredCompletedOrderIds)
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->select(
            'product_name',
            'color_name',
            DB::raw('SUM(quantity) * unit_price as sales'))
        ->groupBy('product_name','color_name', 'unit_price')
        ->orderBy('sales', 'DESC')
        ->get()
        ->sum('sales');

        return $total_sales;
    }

    public static function getRevenueCount($year, $month)
    {
        
        $deliveredCompletedOrderIds = Order::where([
            ['order_status_id', '>=', Constant::ORDER['DELIVERED']],
            ['order_status_id', '<=', Constant::ORDER['COMPLETED']]
            ])->pluck('id');

        $total_revenue = OrderItem::whereIn('order_id', $deliveredCompletedOrderIds)
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->select(
            'product_name',
            'color_name',
            DB::raw('SUM(quantity) * _profit as revenue'))
        ->groupBy('product_name','color_name', '_profit')
        ->orderBy('revenue', 'DESC')
        ->get()
        ->sum('revenue');

        return $total_revenue;
    }
    
    public static function getSalesCountWithRangeFilter($request)
    {
        $hasDateToFilter = $request->start_date != '';
        
        $deliveredCompletedOrderIds = Order::where([
            ['order_status_id', '>=', Constant::ORDER['DELIVERED']],
            ['order_status_id', '<=', Constant::ORDER['COMPLETED']]
            ])->pluck('id');
    
        $total_sales = $hasDateToFilter
        ?
        OrderItem::whereIn('order_id', $deliveredCompletedOrderIds)
        ->whereBetween('created_at', [$request->start_date, $request->end_date])
        ->select(
            'product_name',
            'color_name',
            DB::raw('SUM(quantity) * unit_price as sales'))
        ->groupBy('product_name','color_name', 'unit_price')
        ->orderBy('sales', 'DESC')
        ->get()
        ->sum('sales')
        :
        OrderItem::whereIn('order_id', $deliveredCompletedOrderIds)
        ->select(
            'product_name',
            'color_name',
            DB::raw('SUM(quantity) * unit_price as sales'))
        ->groupBy('product_name','color_name', 'unit_price')
        ->orderBy('sales', 'DESC')
        ->get()
        ->sum('sales');
    
        return $total_sales;
    }

    public static function getRevenuCountWithRangeFilter($request)
    {
        $hasDateToFilter = $request->start_date != '';
        
        $deliveredCompletedOrderIds = Order::where([
            ['order_status_id', '>=', Constant::ORDER['DELIVERED']],
            ['order_status_id', '<=', Constant::ORDER['COMPLETED']]
            ])->pluck('id');
    
        $total_sales = $hasDateToFilter
        ?
        OrderItem::whereIn('order_id', $deliveredCompletedOrderIds)
        ->whereBetween('created_at', [$request->start_date, $request->end_date])
        ->select(
            'product_name',
            'color_name',
            DB::raw('SUM(quantity) * _profit as revenue'))
        ->groupBy('product_name','color_name', '_profit')
        ->orderBy('revenue', 'DESC')
        ->get()
        ->sum('revenue')
        :
        OrderItem::whereIn('order_id', $deliveredCompletedOrderIds)
        ->select(
            'product_name',
            'color_name',
            DB::raw('SUM(quantity) * _profit as revenue'))
        ->groupBy('product_name','color_name', '_profit')
        ->orderBy('revenue', 'DESC')
        ->get()
        ->sum('revenue');
    
        return $total_sales;
    }

















    public function colorImage()
    {
        return $this->belongsTo(ProductColor::class, 'color_id')->select(['id','photo']);
    }

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    
    public function color()
    {
        return $this->belongsTo(ProductColor::class, 'color_id');
    }

    public function product()
    {
        return $this->belongsTo(ProductColor::class, 'product_id');
    }

    public function productConstant()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function sizeConstant()
    {
        return $this->belongsTo(ProductSize::class, 'size_id');
    }

}

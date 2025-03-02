<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
 

    protected $fillable = [
        'color_id',
        'quantity',
        'type',
        'remarks'
    ];

    public function getNumberOfStocks($color_id){
        
        $getAddedStock = Inventory::where([
            ['color_id','=', $color_id],
            ['type','=', 1],      
        ])->latest()->with(['color'])->get();

        $addedStock = 0;
        foreach($getAddedStock as $stock) {
            $addedStock += $stock->quantity;
        }

        $getDeductStock = Inventory::where([
            ['color_id','=', $color_id],
            ['type','=', 0],      
        ])->latest()->with(['color'])->get();

        $deductedStock = 0;
        foreach($getDeductStock as $stock) {
            $deductedStock += $stock->quantity;
        }

        $availableStock = $addedStock - $deductedStock;

        $getReservedStock = Inventory::where([
            ['color_id','=', $color_id],
            ['type','=', 2],      
        ])->latest()->with(['color'])->get();

        $reservedStock = 0;
        foreach($getReservedStock as $stock) {
            $reservedStock += $stock->quantity;
        }

        $getCommitedStock = Inventory::where([
            ['color_id','=', $color_id],
            ['type','=', 3],      
        ])->latest()->with(['color'])->get();

        $committedStock = 0;
        foreach($getCommitedStock as $stock) {
            $committedStock += $stock->quantity;
        }

        $result = $availableStock - $reservedStock - $committedStock;

        return $result;
    }

    public static function getInventoryData($color_id){
        
        $getAddedStock = Inventory::where([
            ['color_id','=', $color_id],
            ['type','=', 1],
        ])->latest()->with(['color'])->get();

        $addedStock = 0;
        foreach($getAddedStock as $stock) {
            $addedStock += $stock->quantity;
        }

        $getDeductStock = Inventory::where([
            ['color_id','=', $color_id],
            ['type','=', 0],      
        ])->latest()->with(['color'])->get();

        $deductedStock = 0;
        foreach($getDeductStock as $stock) {
            $deductedStock += $stock->quantity;
        }

        $availableStock = $addedStock - $deductedStock;

        $getReservedStock = Inventory::where([
            ['color_id','=', $color_id],
            ['type','=', 2],      
        ])->latest()->with(['color'])->get();

        $reservedStock = 0;
        foreach($getReservedStock as $stock) {
            $reservedStock += $stock->quantity;
        }

        $getCommitedStock = Inventory::where([
            ['color_id','=', $color_id],
            ['type','=', 3],      
        ])->latest()->with(['color'])->get();

        $committedStock = 0;
        foreach($getCommitedStock as $stock) {
            $committedStock += $stock->quantity;
        }

        $result = $availableStock - $reservedStock - $committedStock;

        return [
            'history' => Inventory::where('color_id', $color_id)->latest()->with(['color'])->get(),
            'stocks' => $result
        ];
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id')->select('id','first_name','middle_name','last_name','mobile_number','added_by');
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class, 'color_id');
    }
}
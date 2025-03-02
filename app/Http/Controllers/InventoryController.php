<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InventoryRequest;
use App\Models\Inventory;

class InventoryController extends Controller
{

    // public function getProductWithColorCount($color_id)
    // {
    //     return Inventory::getNumberOfStocks($color_id);
    // }

    public function index()
    {
        return Inventory::latest()->with(['color'])->get();
    }

    public function withId($color_id)
    {

      return Inventory::getInventoryData($color_id);
    
    }

    public function store(InventoryRequest $request)
    {
        $query = $request->user()->inventories()->create([
            'color_id' => $request->color_id,
            'quantity' => $request->quantity,
            'type' => $request->type,
            'remarks' => $request->remarks
         ]);

        if ($query) return response()->json(
            Inventory::getInventoryData($query->color_id)
        );

     }

}
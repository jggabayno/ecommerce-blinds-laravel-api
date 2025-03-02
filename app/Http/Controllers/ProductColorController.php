<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ProductColorRequest;
use App\Models\ProductColor;

class ProductColorController extends Controller
{

    public function withDateFilter(Request $request)
    {
        $hasDateToFilter = $request->start_date != '';

        return $hasDateToFilter ?
        ProductColor::whereBetween('created_at', [$request->start_date, $request->end_date])->latest()->with(['product', 'brand', 'added_by'])->get() :
        ProductColor::latest()->with(['product', 'brand', 'added_by'])->get();

    }

    public function index(ProductColor $color)
    {
        return ProductColor::where('id', $color->id)->latest()->with(['product'])->get();
    }

    public function withProductAndBrand()
    {
        return ProductColor::latest()->with(['product', 'brand', 'added_by'])->get();
    }
           
    public function store(ProductColorRequest $request)
    {

        $query = $request->user()->productColors()->create([
            'product_id' => $request->product_id,
            'brand_id' => $request->brand_id,   
            'photo' => $request->photo,
            'name' => $request->name
        ]);

        if ($query) return response()->json(
            $query->latest()->with(['product', 'brand', 'added_by'])->get()->first()
        , 200);
    }

    public function update(ProductColor $color, ProductColorRequest $request)
    {
        $selectedProductColor = $request->user()->productColors()->where('id', $color->id);

        $selectedProductColor->update([
            'product_id' => $request->product_id,
            'brand_id' => $request->brand_id,   
            'photo' => $request->photo,
            'name' => $request->name
        ]);
        
        if ($selectedProductColor) return response()->json(
            $selectedProductColor->with(['product', 'brand', 'added_by'])->get()->first()
            ,200);
    }

    public function destroy(ProductColor $color)
    {
        if (auth()->user()->productColors()->where('user_id', $color->user_id)) {
            $color->delete();
            return response()->json($color->id, 200);
        }
    }    
}

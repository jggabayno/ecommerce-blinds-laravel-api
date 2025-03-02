<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ProductSizeRequest;
use App\Models\ProductSize;

class ProductSizeController extends Controller
{

    public function withDateFilter(Request $request)
    {
        $hasDateToFilter = $request->start_date != '';

        return $hasDateToFilter ? 
        ProductSize::whereBetween('created_at', [$request->start_date, $request->end_date])->latest()->get() :
        ProductSize::latest()->get();

    }

    public function index()
    {
        return ProductSize::latest()->get();
    }
    
    public function clientStore(Request $request)
    {
        $filteredSize = ProductSize::where('multiplier', $request->multiplier);
     
        if($filteredSize->count()) {

        return $filteredSize->get()[0];

        } else {

            $query = $request->user()->productSizes()->create([
                'name' => $request->name,
                'multiplier' => $request->multiplier
            ]);

            if ($query) return response()->json($query, 200);
        }
        
    }

        public function store(ProductSizeRequest $request)
        {
            $query = $request->user()->productSizes()->create([
                'name' => $request->name,
                'multiplier' => $request->multiplier
            ]);

            if ($query) return response()->json($query, 200);
            
        }

        public function update(ProductSize $size, ProductSizeRequest $request)
        {
       
            $selectedProductSize = $request->user()->productSizes()->where('id', $size->id);

            $selectedProductSize->update([
                'name' => $request->name,
                'multiplier' => $request->multiplier
            ]);

            return response()->json($selectedProductSize->first(), 200);
        }

        public function destroy(ProductSize $size)
        {
            if (auth()->user()->productSizes()->where('user_id', $size->user_id)) {
                $size->delete();
                return response()->json($size->id, 200);
            }
        }    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;

class ProductController extends Controller
{

    public function withDateFilter(Request $request)
    {
        $hasDateToFilter = $request->start_date != '';

        return $hasDateToFilter ? 
        Product::whereBetween('created_at', [$request->start_date, $request->end_date])->latest()->with(['colors.product','rates', 'rates.consumer'])->get() :
        Product::latest()->with(['colors.product','rates', 'rates.consumer'])->get();

    }

    public function index()
    {
        return Product::latest()->get();
    }

    public function withColors()
    {
        return Product::latest()->with(['colors.product','rates', 'rates.consumer'])->get();
    }
    // withIdAndColors
    public function withIdAndColors(Product $product)
    {
        return Product::where('id', $product->id)->latest()->with(['colors.product','colors.stocks','rates', 'rates.consumer','orderItems'])->first();
    }

    public function store(StoreProductRequest $request)
    {

        $query = $request->user()->products()->create([
            'name' => $request->name,
            'photo' => $request->photo,
            'description' => $request->description,
            'price_per_square_feet' =>  $request->price_per_square_feet
        ]);

        if ($query) return response()->json($query, 200);
    }

    public function update(Product $product, StoreProductRequest $request)
    {

        $product = $request->user()->products()->where('id', $product->id);

        $product->update([
            'name' => $request->name,
            'photo' => $request->photo,
            'description' => $request->description,
            'price_per_square_feet' =>  $request->price_per_square_feet
        ]);

        return response()->json($product->first(), 200);
    }

    public function destroy(Product $product)
    {
        if (auth()->user()->products()->where('user_id', $product->user_id)) {
            $product->delete();
            return response()->json($product->id, 200);
        }
    }    

}

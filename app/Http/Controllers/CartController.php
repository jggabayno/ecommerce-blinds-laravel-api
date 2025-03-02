<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
        public function index()
        {
            return Cart::latest()->with(['product','color','size'])->get();
        }

        public function storeOrUpdate(CartRequest $request)
        {
            // if product and color, size id is exist, will run update otherwise store

            $queryUpdateCart = $request->user()->carts()->where(
                [
                    ['product_id', '=', $request->product_id],
                    ['color_id', '=', $request->color_id],
                    ['size_id', '=', $request->size_id]
                ]
            )->first();
                
                if ($queryUpdateCart) {

                    $queryUpdateCart->update([
                            'product_id' => $queryUpdateCart->product_id,
                            'color_id' => $queryUpdateCart->color_id,
                            'size_id' => $queryUpdateCart->size_id,
                            'quantity' => $queryUpdateCart->quantity + $request->quantity,
                            'price' => $queryUpdateCart->price,
                            'ctrl' => $queryUpdateCart->ctrl
                    ]);

                    return response()->json($queryUpdateCart->latest()->with(['product','color','size'])->first(), 200);

                } else {
                              
                    $query = $request->user()->carts()->create([
                        'product_id' => $request->product_id,
                        'color_id' => $request->color_id,
                        'size_id' => $request->size_id,
                        'quantity' => $request->quantity,
                        'price' => $request->price,
                        'ctrl' => $request->ctrl
                    ]);
                
                    return response()->json($query->latest()->with(['product','color','size'])->first());
                }
        }

        public function update(Cart $cart, CartRequest $request)
        {

            $selectedCart = $request->user()->carts()->where('id', $cart->id);

            $selectedCart->update([
                'product_id' => $request->product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'ctrl' => $request->ctrl
            ]);

            return response()->json($selectedCart->first(), 200);
        }

        public function destroy(Request $request)
        {
            $query = auth()->user()->carts()->whereIn('id', $request->ids)->delete();
            return response()->json($query, 200);
        }
}

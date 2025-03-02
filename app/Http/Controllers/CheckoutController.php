<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Checkout;
use App\Models\CheckoutItem;

class CheckoutController extends Controller
{
    public function index()
    {
        return Checkout::latest()->with(['checkoutItem'])->get();
    }

    // public function index()
    // {
    //     return CheckoutItem::latest()->with(['checkoutItem'])->get();
    // }

    
    public function withId($order_no)
    {
        // return Checkout::where('checkout_no', $order_no)->latest()->with(['checkoutItem','color','size'])->get();

        return Checkout::where('checkout_no', $order_no)->latest()->with(['checkoutItem'])->get();
    }

    public function store(Request $request)
    {
        $checkoutNumber = 'FSCO-'.time().$request->user()->id;
        
        $checkout = $request->user()->checkouts()->create(['checkout_no' => $checkoutNumber]); 
    
        if($checkout) { 
            foreach($request->selected_cart_items as $item) {
                CheckoutItem::create([
                    'checkout_id' => $checkout->id,
                    'cart_id' =>  $item['id'],
                    'product_id' => $item['product_id'],
                    'color_id' => $item['color_id'],
                    'size_id' => $item['size_id'],
                    'quantity' => $item['quantity'],
                    'ctrl' => $item['ctrl'],
                    'price' => $item['price']
                ]);
            }
        }

        return $checkoutNumber;
    }

}
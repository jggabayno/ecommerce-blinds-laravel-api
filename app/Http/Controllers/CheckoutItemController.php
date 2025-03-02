<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CheckoutItem;

class CheckoutItemController extends Controller
{
    public function index()
    {
        return CheckoutItem::latest()->with(['color','size'])->get();
    }
}

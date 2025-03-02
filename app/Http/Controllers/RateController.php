<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rate;

class RateController extends Controller
{
    public function index()
    {
        return Rate::latest()->get();
    }

    public function store(Request $request)
    {
        foreach($request->data as $row) {

           $query = $request->user()->rates()->create([
                'product_id' => $row['product_id'],
                'order_id' => $row['order_id'],
                'count' => $row['count'],
                'prefer_consumer_name' => $row['prefer_consumer_name'],
                'message' => $row['message'],
                'product_variants' => $row['product_variants']
            ]);

            // if ($query) return response()->json($query, 200);
        }

    }
}

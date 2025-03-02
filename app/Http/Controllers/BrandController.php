<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;

class BrandController extends Controller
{

        public function withDateFilter(Request $request)
        {
            $hasDateToFilter = $request->start_date != '';

            return $hasDateToFilter ? 
            Brand::whereBetween('created_at', [$request->start_date, $request->end_date])->latest()->get() :
            Brand::latest()->get();
 
        }

        public function index()
        {
            return Brand::latest()->get();
        }

        public function withAll()
        {
            return Brand::latest()->with(['productColors.product', 'productColors.brand','productColors.stock_movement'])->get();
        }
 

        public function store(BrandRequest $request)
        {

            $query = $request->user()->brands()->create([
                'photo' => $request->photo,
                'name' => $request->name,
                'description' => $request->description
            ]);

            if ($query) return response()->json($query, 200);
        }

        public function update(Brand $brand, BrandRequest $request)
        {

            $selectedBrand = $request->user()->brands()->where('id', $brand->id);

            $selectedBrand->update([
                'photo' => $request->photo,
                'name' => $request->name,
                'description' => $request->description
            ]);

            return response()->json($selectedBrand->first(), 200);
        }

        public function destroy(Brand $brand)
        {
            if (auth()->user()->brands()->where('user_id', $brand->user_id)) {
                $brand->delete();
                return response()->json($brand->id, 200);
            }
        }    

}

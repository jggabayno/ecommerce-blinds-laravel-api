<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Models\ProductColor;

class ProductColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now();

        $productColors = [
            [
                'product_id' => 1,
                'brand_id' => 1,
                'user_id' => 1,
                'photo' => 'default.png',
                'name' => 'S138 Graphite',
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'product_id' => 1,
                'brand_id' => 2,
                'user_id' => 1,
                'photo' => 'default.png',
                'name' => 'S112 Green',
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'product_id' => 1,
                'brand_id' => 1,
                'user_id' => 1,
                'photo' => 'default.png',
                'name' => 'S111 Yellow',
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'product_id' => 1,
                'brand_id' => 1,
                'user_id' => 1,
                'photo' => 'default.png',
                'name' => 'S112 Blue',
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'product_id' => 2,
                'brand_id' => 2,
                'user_id' => 1,
                'photo' => 'default.png',
                'name' => 'S101 Pink',
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'product_id' => 2,
                'brand_id' => 3,
                'user_id' => 1,
                'photo' => 'default.png',
                'name' => 'S271 Gray',
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'product_id' => 3,
                'brand_id' => 4,
                'user_id' => 1,
                'photo' => 'default.png',
                'name' => 'S428 Violet',
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'product_id' => 4,
                'brand_id' => 4,
                'user_id' => 1,
                'photo' => 'default.png',
                'name' => 'S014 Dark',
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ]
        ];

        foreach($productColors as $productColor) {
            ProductColor::create([
                'product_id' => $productColor['product_id'],
                'brand_id' => $productColor['brand_id'],
                'user_id' => $productColor['user_id'],
                'photo' => $productColor['photo'],
                'name' => $productColor['name'],
                'created_at' => $productColor['created_at'],
                'updated_at' => $productColor['updated_at']
            ]);
        }
    }
}

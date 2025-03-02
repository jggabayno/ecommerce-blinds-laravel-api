<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Models\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now();

        $products = [
            [
                'user_id' => 1,
                'name' => 'Basic Soft',
                'photo' => 'default.png',
                'description' => 'Basic Soft description',
                'price_per_square_feet' => 90,
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'user_id' => 1,
                'name' => 'Woodlook',
                'photo' => 'default.png',
                'description' => 'Woodlook description',
                'price_per_square_feet' => 110,
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'user_id' => 1,
                'name' => 'Trilogy',
                'photo' => 'default.png',
                'description' => 'Trilogy description',
                'price_per_square_feet' => 112,
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'user_id' => 1,
                'photo' => 'default.png',
                'name' => 'Blackout Delux',
                'description' => 'Blackout Delux description',
                'price_per_square_feet' => 200,
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ]
        ];

        
        foreach($products as $product) {
            Product::create([
                'user_id' => $product['user_id'],
                'photo' => $product['photo'],
                'name' => $product['name'],
                'description' => $product['description'],
                'price_per_square_feet' => $product['price_per_square_feet'],
                'created_at' => $product['created_at'],
                'updated_at' => $product['updated_at']
            ]);
        }
    }
}

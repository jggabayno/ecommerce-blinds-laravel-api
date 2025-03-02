<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Models\ProductSize;


class ProductSizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now();

        $productSizes = [
            [
                'name' => '48x48',
                'user_id' => 1,
                'multiplier' => 2304,
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'name' => '36x36',
                'user_id' => 1,
                'multiplier' => 1296,
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'name' => '46x46',
                'user_id' => 1,
                'multiplier' => 2116,
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'name' => '72x48',
                'user_id' => 1,
                'multiplier' => 3456,
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
        ];

        foreach($productSizes as $productSize) {
            ProductSize::create([
                'name' => $productSize['name'],
                'user_id' => $productSize['user_id'],
                'multiplier' => $productSize['multiplier'],
                'created_at' => $productSize['created_at'],
                'updated_at' => $productSize['updated_at']
            ]);
        }
    }
}
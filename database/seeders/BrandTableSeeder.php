<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Models\Brand;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now();

        $brands = [
            [
                'name' => 'DW Dong Won Textile Blinds',
                'description' => 'DW Dong Won Textile Blinds description',
                'user_id' => 1,
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'name' => 'Losa Blinds',
                'description' => 'Losa Blinds description',
                'user_id' => 1,
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'name' => 'Window Blinds Collection',
                'description' => 'Window Blinds Collection description',
                'user_id' => 1,
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'name' => 'Lost Blinds 1983 (Royal Edition)',
                'description' => 'Lost Blinds 1983 (Royal Edition) description',
                'user_id' => 1,
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'name' => 'Window Blinds GreenGuard',
                'description' => 'Window Blinds GreenGuard description',
                'user_id' => 1,
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
        ];

        foreach($brands as $brand) {
            Brand::create([
                'name' => $brand['name'],
                'description' => $brand['description'],
                'user_id' => $brand['user_id'],
                'created_at' => $brand['created_at'],
                'updated_at' => $brand['updated_at']
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            UserTypeTableSeeder::class,
            ProductTableSeeder::class,
            ProductColorTableSeeder::class,
            ProductSizeTableSeeder::class,
            // InventoryTableSeeder::class,
            BrandTableSeeder::class,
            OrderStatusTableSeeder::class
        ]);
    }
}

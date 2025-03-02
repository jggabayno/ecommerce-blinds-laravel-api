<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Models\Inventory;

class InventoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now();

        $inventories = [
            [
                'user_id' => 1,
                'color_id' => 1,
                'quantity' => 50,
                'type' => 1,
                'remarks' => 'Add 50',
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'user_id' => 1,
                'color_id' => 2,
                'quantity' => 20,
                'type' => 1,
                'remarks' => 'Add 20',
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
        ];

        foreach($inventories as $inventory) {
            Inventory::create([
                'user_id' => $inventory['user_id'],
                'color_id' => $inventory['color_id'],
                'quantity' => $inventory['quantity'],
                'type' => $inventory['type'],
                'remarks' => $inventory['remarks'],
                'created_at' => $inventory['created_at'],
                'updated_at' => $inventory['updated_at']
            ]);
        }
    }
}

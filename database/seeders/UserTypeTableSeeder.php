<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\UserType;
use Carbon\Carbon;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now();

        $user_types = [
                    [
                        "name" => "admin",
                        "description" => "the admin",
                        'created_at' => $currentTime->toDateTimeString(),
                    ],
                    [
                        "name" => "staff",
                        "description" => "the staff",
                        'created_at' => $currentTime->toDateTimeString(),
                    ],
                    [
                        "name" => "customer",
                        "description" => "the customer",
                        'created_at' => $currentTime->toDateTimeString(),
                    ]
                ];

            foreach($user_types as $user_type) {
                UserType::create([
                    'name' => $user_type['name'],
                    'description' => $user_type['description'],
                    'created_at' => $user_type['created_at'],
                ]);
            }
    }
}

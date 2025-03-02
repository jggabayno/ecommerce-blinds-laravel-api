<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

use App\Helpers\Constant;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now();

        $users = [
            [
                'first_name' => 'Jonh Gall',
                'last_name' => 'Gabayno',
                'user_type_id' => Constant::USER_TYPE['ADMIN'],
                'mobile_number' => '09273293481',
                'gender' => 1,
                'birth_date' => '1998/09/12',
                'address' => 'Calumpang, Binangonan, Rizal',
                'email' => 'example@email.com',
                'password' => Hash::make('fswb'),
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'first_name' => 'Jinwoo',
                'last_name' => 'SUng',
                'user_type_id' => Constant::USER_TYPE['STAFF'],
                'mobile_number' => '09187024818',
                'gender' => 1,
                'birth_date' => '1999/01/18',
                'address' => 'Calumpang, Binangonan, Rizal',
                "email" => 'staff@email.com',
                'password' => Hash::make('fswb'),
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'first_name' => 'Jinha',
                'last_name' => 'Sung',
                'user_type_id' => Constant::USER_TYPE['CUSTOMER'],
                'mobile_number' => '0918424818',
                'gender' => 1,
                'birth_date' => '1999/01/18',
                'address' => 'Calumpang, Binangonan, Rizal',
                "email" => 'customer@email.com',
                'password' => Hash::make('fswb'),
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ]
        ];
        
        foreach($users as $user) {
            User::create([
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'user_type_id' => $user['user_type_id'],
                'mobile_number' => $user['mobile_number'],
                'gender' => $user['gender'],
                'birth_date' => $user['birth_date'],
                'address' => $user['address'],
                'email' => $user['email'],
                'password' => $user['password'],
                'created_at' => $user['created_at'],
                'updated_at' => $user['updated_at']
            ]);
        }
    }
}

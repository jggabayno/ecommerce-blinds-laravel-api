<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\SignUpRequest;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function index(SignUpRequest $request)
    {
        $userName = $request->first_name.substr(time(), -4);

       $query = User::create([
        'user_name' => $userName,
        'first_name' => $request->first_name,
        'gender' => $request->gender,
        'birth_date' => $request->birth_date,
        'last_name' => $request->last_name,
        'mobile_number' => $request->mobile_number,
        'user_type_id' => $request->user_type_id,
        'email' => $request->email,
        'password' => Hash::make($request->password)
     ]);

        if ($query) return response()->json($query);
    }
}

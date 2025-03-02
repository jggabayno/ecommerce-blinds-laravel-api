<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{

    public function index(LoginRequest $request)
    {

        if($request->user_type_id == 12){

            if (!auth()->attempt($request->only('email', 'password'))) {
                return response()->json(['message' => 'Invalid login credentials'], 401);
            } else { 
    
                return response()->json([ 'user' =>
                auth()->user()
                ->where('email', $request->email)
                ->select(['id','first_name', 'last_name','user_type_id'])
                ->first(),
                'token' => auth()->user()->createToken('authToken')->accessToken]);
    
            }

        } else {

            if (!auth()->attempt($request->only('email', 'password', 'user_type_id'))) {
                return response()->json(['message' => 'Invalid login credentials'], 401);
            } else { 
    
                return response()->json([ 'user' =>
                auth()->user()
                ->where('email', $request->email)
                ->select(['id','first_name', 'last_name'])
                ->first(),
                'token' => auth()->user()->createToken('authToken')->accessToken]);
    
            }

        }



    }
}

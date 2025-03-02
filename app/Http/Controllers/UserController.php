<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Constant;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $hasDateToFilter = $request->start_date != '';

        return $hasDateToFilter ? 
        User::whereNull('deleted_at')->whereBetween('created_at', [$request->start_date, $request->end_date])->latest()->get() :
        User::whereNull('deleted_at')->latest()->get();

    }

    public function customers()
    {
        return User::where('user_type_id', Constant::USER_TYPE['CUSTOMER'])->whereNull('deleted_at')->latest()->get();
    }

    public function profile() {

        return auth()->user();
 
    }

    public function store(Request $request)
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

    public function updateProfile($user_id, Request $request)
    {

       
        $selectedUser = $request->user();
        
        $selectedUser->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,   
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'user_name' => $request->user_name,
            'photo' => $request->photo
        ]);
        
        if ($selectedUser) return response()->json($selectedUser->first(),200);
    }
 

    public function destroy(User $user)
    {
        if (auth()->user()->findOrFail($user->id)) {
            $user->delete();
            return response()->json($user->id,200);
        }
    }

}

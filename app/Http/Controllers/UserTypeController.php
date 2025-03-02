<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UserTypeRequest;
use App\Models\UserType;

class UserTypeController extends Controller
{
    
    public function index()
    {
        return UserType::whereNull('deleted_at')->latest()->get();
    }

    public function store(UserTypeRequest $request)
    {
        $query = UserType::create($request->validated());

        if ($query) return response()->json($query);
    }

    public function update(UserType $user_type, UserTypeRequest $request)
    {
        $query = $user_type->update($request->only('name', 'description'));
        return response()->json($query, 200);
    }

    public function destroy(UserType $user_type)
    {
        if ($user_type) {
            $user_type->delete();
            return response()->json($user_type->id,200);
        }
    }

}

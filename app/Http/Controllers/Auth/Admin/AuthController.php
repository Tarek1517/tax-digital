<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
           'email' => 'required|email',
           'password' => 'required',
        ]);
        $admin = User::query()->where('email',$request->email)->first();
        if(!$admin || !Hash::check($request->password, $admin->password)) {
            throw validationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $admin->createToken('admin',['role:customer'])->plainTextToken;
        return response()->json([
            'user' => $admin,
            'token' => $token
        ]);
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required',
        ]);
        $user = User::query()->create([
           'name' => $request->name,
           'phone' => $request->phone,
           'email' => $request->email,
           'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('admin',['role:admin'])->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' =>$token
        ],200);
    }
}

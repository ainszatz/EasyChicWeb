<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        
        $user = User::where('email', $request->email)->first();

        if (!$user || !\Hash::check($request->password, $user->password)) {
            return response([
                'These credentials do not match our records.'
            ], 404);
        }

        $message = "Welcome back, " . $user->name . "!";

        return response()->json(['message' => $message, 'user' => $user], 200);

    }
   
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:7'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 202);
        }
        // make response when success register
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email, 
            'password' => bcrypt($request->password),
            'photo' => $request->photo ?? null,
            'phone_number' => $request->phone_number ?? null,
            'image' => $request->image ?? null,
        ]);
        $message = "Welcome, " . $user->name . "! Registration successful";

        return response()->json(['message' => $message, 'user' => $user], 200);
    }
}

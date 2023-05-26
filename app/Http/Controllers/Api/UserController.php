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
        return $user;
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
            'password' => bcrypt($request->password)
        ]);
        return response()->json(['message' => 'Registration successful', 'user' => $user], 200);

    }
}

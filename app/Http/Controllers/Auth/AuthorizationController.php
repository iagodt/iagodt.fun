<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthorizationController extends Controller{

    public function register(Request $request){
        
        
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $token = JWTAuth::attempt($credentials);
        if(!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciais invalidas'], 401);
        }
        
        return response()->json([
            'user'=>Auth::user(),
            'Token'=> $token,
        ]);
        
    }

    public function googleLogin(){
        $user = auth()->user();
        $token = auth()->refresh();

        return response()->json([
            'user'=>$user,
            'Token'=>$token
        ]);
    }
     
}
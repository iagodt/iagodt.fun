<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\carts;
use App\Models\User;
use Exception;
use Hash;
use Laravel\Socialite\Facades\Socialite;
use Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class GoogleController extends Controller{


    public function redirect(){
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback(){
        try{
            $userG = Socialite::driver('google')->stateless()->user();

            $user = User::where('email', $userG->getEmail())->first();

            if(!$user){
                $user = User::create([
                    'name' => $userG->getName(),
                    'email' => $userG->getEmail(),
                    'password' => Hash::make(Str::random(16)),
                    //add gid
                ]); 
                
                carts::create(['user_id' => $user->id]);
            }
            else{
                // adicionar att gid
            }

            $token = JWTAuth::fromUser($user);

            return redirect()->to(env('APP_URL').'/auth/google-redirect?token='.$token);
        }
        catch(Exception $error){
            return response()->json(['error' => 'falha na autenticação'], 500);
        };
    }
}
<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;
use Mailgun\Mailgun;
use Illuminate\Support\Facades\Password;
use Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class ResetPasswordController extends Controller{



    public function sendResetLinkEmail(Request $request)
    {
        // Validação do e-mail
        $request->validate(['email' => 'required|email']);

        // Enviar o e-mail de recuperação de senha
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Verificar o status da operação
        return $status === Password::RESET_LINK_SENT
                    ? response()->json(['message' => __($status)], 200)
                    : response()->json(['message' => __($status)], 400);
    }
    public function reset(Request $request)
    {
       
        // Validação dos dados
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Tenta resetar a senha
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Atualiza a senha
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                // Revoga tokens existentes
                JWTAuth::invalidate(JWTAuth::fromUser($user));
            }
        );

        // Retorna resposta
        return $status === Password::PASSWORD_RESET
                    ? response()->json(['message' => __($status)], 200)
                    : response()->json(['message' => __($status)], 400);
    }

}
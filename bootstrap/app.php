<?php

use App\Http\Middleware\authJwt;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->validateCsrfTokens([
            'auth/*',
            'password/reset',
            'api/cart/add',
            'api/cart/getItens',
            'api/usercart/add',
            'api/usercart/remove',
            'api/usercart/sync'
        ]); 
        $middleware->group('JWTAuth',[authJwt::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

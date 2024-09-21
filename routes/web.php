<?php

use App\Http\Controllers\Api\CarouselBannerController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\HighlightsController;
use App\Http\Controllers\Api\ItensController;
use App\Http\Controllers\auth\AuthorizationController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CategoryController;





Route::get('api/categories/get', [CategoryController::class, 'index']);
Route::get('api/highlights/get',[HighlightsController::class, 'index']);
Route::get('api/carousel/get', [CarouselBannerController::class, 'index']);
Route::get('api/itens/index', [ItensController::class, 'index']);
Route::get('api/itens/get', [ItensController::class, 'get']);
Route::get('api/itens/getSuggests', [ItensController::class, 'getSuggests']);
Route::get('api/category/get', [CategoryController::class, 'getItensByCategory']);
Route::get('api/cart/get', [CartController::class, 'getCart']);
Route::get('api/cart/remove', [CartController::class, 'removeOfCart']);
Route::get('api/cart/add', [CartController::class, 'addOnCart']);
Route::get('api/cart/clear', [CartController::class, 'clearCart']);
Route::get('api/cart/index', [CartController::class, 'getItensOnCart']);

Route::post('auth/register', [AuthorizationController::class, 'register']);
Route::post('auth/login', [AuthorizationController::class, 'login']);

Route::group(['middleware' => 'JWTAuth'], function (){
    //rotas com jwtAuth

    Route::get('api/notauth',[AuthorizationController::class, 'teste']);
});


Route::get('{view}', ApplicationController::class)->where('view', '(.*)');
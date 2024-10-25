<?php

use App\Http\Controllers\Api\AttributesController;
use App\Http\Controllers\Api\CarouselBannerController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\HighlightsController;
use App\Http\Controllers\Api\ItensController;
use App\Http\Controllers\Auth\AuthorizationController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Api\CategoryController;



Route::group(['middleware' => 'JWTAuth'], function () {
    //rotas com jwtAuth
    Route::get('auth/google/login', [AuthorizationController::class, 'googleLogin']);
    
    Route::post('api/usercart/add', [CartController::class, 'userAdd']);
    Route::get('api/usercart/get', [CartController::class, 'userGet']);
    Route::post('api/usercart/remove', [CartController::class, 'userRemove']);
    Route::post('api/usercart/sync', [CartController::class, 'userSync']);
});

Route::get('api/attributes/item', [AttributesController::class, 'getItem']);
Route::get('api/attributes/filter', [AttributesController::class, 'filter']);
Route::get('api/attributes/get', [AttributesController::class, 'index']);

Route::get('api/categories/get', [CategoryController::class, 'index']);
Route::get('api/category/get', [CategoryController::class, 'getItensByCategory']);

Route::get('api/highlights/get', [HighlightsController::class, 'index']);

Route::get('api/carousel/get', [CarouselBannerController::class, 'index']);

Route::get('api/itens/index', [ItensController::class, 'index']);
Route::get('api/itens/get', [ItensController::class, 'get']);
Route::get('api/itens/getSuggests', [ItensController::class, 'getSuggests']);


Route::post('api/cart/add', [CartController::class, 'addCart']);
Route::post('api/cart/getItens', [CartController::class, 'getItensCart']);


Route::post('auth/register', [AuthorizationController::class, 'register']);
Route::post('auth/login', [AuthorizationController::class, 'login']);
Route::post('auth/forgot-password', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.request');
Route::post('auth/recovery-password', [ResetPasswordController::class, 'reset'])->name('password.reset');
Route::get('auth/google/redirect', [GoogleController::class, 'redirect']);
Route::get('auth/google/callback', [GoogleController::class, 'callback']);

    

Route::get('{view}', ApplicationController::class)->where('view', '(.*)');
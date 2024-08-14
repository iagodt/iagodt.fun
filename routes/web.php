<?php

use App\Http\Controllers\Api\CarouselBannerController;
use App\Http\Controllers\Api\HighlightsController;
use App\Http\Controllers\Api\ItensController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CategoryController;


Route::get('api/categories/get', [CategoryController::class, 'index']);
Route::get('api/highlights/get',[HighlightsController::class, 'index']);
Route::get('api/carousel/get', [CarouselBannerController::class, 'index']);
Route::get('api/itens/index', [ItensController::class, 'index']);
Route::get('api/itens/get', [ItensController::class, 'get']);






Route::get('{view}', ApplicationController::class)->where('view', '(.*)');
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController; 

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/products', [ProductController::class, 'store']);

Route::get('/products/search', [ProductController::class, 'search']);

Route::get('/swagger', function () {
    return view('swagger');
});


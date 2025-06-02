<?php

use App\Http\Controllers\Api\ProductsApiController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get("/products", [ProductsApiController::class, "index"]);
Route::get("/product/{id}", [ProductsApiController::class, "show"]);
Route::post("/product", [ProductsApiController::class, "store"]);
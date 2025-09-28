<?php

use App\Http\Controllers\Api\Product\CategoriesController;
use App\Http\Controllers\Api\Product\MetaProductController;
use App\Http\Controllers\Api\Product\ProductsController;
use App\Http\Middleware\VerifyPermitTokenUserMiddleware;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    'products'=>ProductsController::class,
    'categories'=>CategoriesController::class
]);

Route::get('/products/details/{product}',[MetaProductController::class,'show'])->name('products.details');

Route::middleware(['auth:sanctum',VerifyPermitTokenUserMiddleware::class])->group(function(){
});
//3|56JWjSRYB3LZJyjBzPlwBzSlXVYpk4gUU1hkFKqH94d8d2da

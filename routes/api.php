<?php

use App\Http\Controllers\Api\Product\CategoriesController;
use App\Http\Controllers\Api\Product\ProductsController;
use App\Http\Middleware\VerifyPermitTokenUserMiddleware;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::apiResources([
    'products'=>ProductsController::class,
    'categories'=>CategoriesController::class
]);
Route::middleware(['auth:sanctum',VerifyPermitTokenUserMiddleware::class])->group(function(){
});
//3|56JWjSRYB3LZJyjBzPlwBzSlXVYpk4gUU1hkFKqH94d8d2da
Route::get('/auth/token',function(Request $request){
   $user = User::first();
   $token = $user->createToken($user->name.$user->password,['test.route']);
   dd($token);
});

Route::middleware(['auth:sanctum'])->group(function(){

   
    
});

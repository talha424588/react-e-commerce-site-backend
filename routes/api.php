<?php

use App\Http\Controllers\api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::post('add-product',[ProductController::class,'addProduct']);
Route::get('get-all-product',[ProductController::class,'getAllProducts']);
Route::delete('delete-product/{id}',[ProductController::class,'deleteProduct']);
Route::post('add-category',[ProductController::class,'addCategory']);
Route::get('get-all-category',[ProductController::class,'getAllCategories']);

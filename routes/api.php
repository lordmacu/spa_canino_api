<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('categories', App\Http\Controllers\API\CategoriesAPIController::class);

Route::resource('profiles', App\Http\Controllers\API\ProfileAPIController::class);

Route::resource('abouts', App\Http\Controllers\API\AboutAPIController::class);

Route::resource('contacts', App\Http\Controllers\API\ContactAPIController::class);

Route::resource('products', App\Http\Controllers\API\ProductsAPIController::class);

Route::resource('pets', App\Http\Controllers\API\PetsAPIController::class);

Route::resource('coupons', App\Http\Controllers\API\CouponsAPIController::class);

Route::resource('appointments', App\Http\Controllers\API\AppointmentAPIController::class);

Route::resource('pet_histories', App\Http\Controllers\API\PetHistoryAPIController::class);
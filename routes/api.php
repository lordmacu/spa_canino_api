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


Route::resource('categories',  CategoriesAPIController::class);

Route::resource('profiles', ProfileAPIController::class);

Route::resource('abouts',  AboutAPIController::class);

Route::resource('contacts', ContactAPIController::class);

Route::resource('products',  ProductsAPIController::class);

Route::resource('pets', PetsAPIController::class);

Route::resource('coupons', CouponsAPIController::class);

Route::resource('appointments',  AppointmentAPIController::class);

Route::resource('pet_histories', PetHistoryAPIController::class);

Route::resource('banners', BannerAPIController::class);

Route::resource('doctors', DoctorAPIController::class);

Route::resource('product_categories', App\Http\Controllers\API\ProductCategoryAPIController::class);

Route::resource('statuses', App\Http\Controllers\API\StatusAPIController::class);

Route::resource('populars', PopularAPIController::class);


Route::resource('carts',  CartAPIController::class);
Route::post('addCart', 'CartAPIController@addCart');
Route::post('register', 'ProfileAPIController@register');
Route::post('login', 'ProfileAPIController@login');
Route::post('getCart', 'CartAPIController@getCart');
Route::post('deleteItemCart', 'CartAPIController@deleteItemCart');

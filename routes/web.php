<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('banners', App\Http\Controllers\BannerController::class);

Route::resource('doctors', App\Http\Controllers\DoctorController::class);

Route::resource('productCategories', App\Http\Controllers\ProductCategoryController::class);

Route::resource('statuses', App\Http\Controllers\StatusController::class);

Route::resource('populars', App\Http\Controllers\PopularController::class);

Route::resource('carts', App\Http\Controllers\CartController::class);
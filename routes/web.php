<?php

use App\Http\Controllers\{AdminController, CategoryController, ColorController, TagController, ShoesSizeController, UserController, ProductController};
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
Route::get('/admin', AdminController::class);


Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin'], function(){
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('shoes', ShoesSizeController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});

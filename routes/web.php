<?php

use App\Http\Controllers\{AdminController, AdminLoginController, AuthenticityCheckController, CategoryController, CollectionController, ColorController, TagController, ShoesSizeController, UserController, ProductController};
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
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);
Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

Route::get('/admin', AdminController::class)->name('admin.dashboard');


Route::get('/', function () {
    return view('client.index');
});

Route::group(['prefix'=>'admin', 'middleware' => 'isAdmin'], function(){
    Route::resource('categories', CategoryController::class);
    Route::resource('collections', CollectionController::class);
    Route::resource('tags', TagController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::get('/authenticity-checks', [AuthenticityCheckController::class, 'index'])->name('authenticity.index');
    Route::post('/authenticity-checks/import', [AuthenticityCheckController::class, 'import'])->name('authenticity.import');
    Route::put('/authenticity/update/{id}', [AuthenticityCheckController::class, 'update'])->name('authenticity.update');
    Route::get('/authenticity/delete/{id}', [AuthenticityCheckController::class, 'destroy'])->name('authenticity.delete');
});

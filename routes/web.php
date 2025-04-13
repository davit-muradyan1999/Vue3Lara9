<?php

use App\Http\Controllers\{AboutController,
    AdminController,
    AdminLoginController,
    Auth\InertiaLoginController,
    Auth\InertiaRegisterController,
    AuthenticityCheckController,
    BlogController,
    BoutiqueController,
    CartController,
    CategoryController,
    CollectionController,
    ColorController,
    HomeController,
    OrderController,
    TagController,
    ShoesSizeController,
    UserController,
    ProductController,
    LanguageController};
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

Route::middleware('guest')->group(function () {
    Route::get('/register', [InertiaRegisterController::class, 'show'])->name('register');
    Route::post('/register', [InertiaRegisterController::class, 'store']);
    Route::get('/login', [InertiaLoginController::class, 'show'])->name('login');
    Route::post('/login', [InertiaLoginController::class, 'login']);
});

Route::post('/client/logout', [InertiaLoginController::class, 'logout'])->name('client.logout');
Route::get('/', HomeController::class)->name('home');
Route::get('/lang/{locale}', [LanguageController::class, 'changeLocale'])->name('lang.switch');
Route::get('/collections', [HomeController::class, 'collections'])->name('collections');
Route::get('/about', [HomeController::class, 'abouts'])->name('about');
Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/boutiques', [HomeController::class, 'boutiques'])->name('boutiques');
Route::get('/private-club', [HomeController::class, 'privateClub'])->name('private-club');
Route::get('/categories/{category}', [HomeController::class, 'categoriesProducts'])->name('categories.products');
Route::get('/product/{id}', [HomeController::class, 'getProduct'])->name('product');
Route::get('/auth-check/{id}', [HomeController::class, 'getAuthCheckProduct'])->name('product');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');



Route::group(['prefix'=>'admin', 'middleware' => 'isAdmin'], function(){
    Route::resource('categories', CategoryController::class);
    Route::resource('collections', CollectionController::class);
    Route::resource('tags', TagController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('abouts', AboutController::class);
    Route::resource('boutiques', BoutiqueController::class);
    Route::resource('blogs', BlogController::class);
    Route::get('/authenticity-checks', [AuthenticityCheckController::class, 'index'])->name('authenticity.index');
    Route::post('/authenticity-checks/import', [AuthenticityCheckController::class, 'import'])->name('authenticity.import');
    Route::put('/authenticity/update/{id}', [AuthenticityCheckController::class, 'update'])->name('authenticity.update');
    Route::get('/authenticity/delete/{id}', [AuthenticityCheckController::class, 'destroy'])->name('authenticity.delete');
});

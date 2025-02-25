<?php

use App\Http\Controllers\Api\AuthenticityCheckController;
use App\Http\Controllers\Api\CategoryCantroller;
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
Route::get('/categories', [CategoryCantroller::class, 'index']);
Route::get('/authenticity-check/{barcode}', [AuthenticityCheckController::class, 'check']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

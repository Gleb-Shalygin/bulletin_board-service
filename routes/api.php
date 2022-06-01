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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/bulletins', [\App\Http\Controllers\Api\V1\BulletinController::class, 'index']);

Route::get('/bulletins/price/low-high', [\App\Http\Controllers\Api\V1\BulletinController::class, 'priceLowHigh']);

Route::get('/bulletins/price/high-low', [\App\Http\Controllers\Api\V1\BulletinController::class, 'priceHighLow']);

Route::get('/bulletins/date/low-high', [\App\Http\Controllers\Api\V1\BulletinController::class, 'dateLowHigh']);

Route::get('/bulletins/date/high-low', [\App\Http\Controllers\Api\V1\BulletinController::class, 'dateHighLow']);

Route::get('/bulletins/{id}', [\App\Http\Controllers\Api\V1\BulletinController::class, 'show']);

Route::post('/bulletins', [\App\Http\Controllers\Api\V1\BulletinController::class, 'store']);

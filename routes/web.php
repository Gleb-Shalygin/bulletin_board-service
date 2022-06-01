<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BulletinController;
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

Route::get('/bulletins/{page}', [BulletinController::class,'output'])->name('bulletins');

Route::get('/bulletin-add',[BulletinController::class,'output_add'])->name('output-bulletin-add');

Route::post('/bulletin-add', [BulletinController::class, 'store'])->name('store-bulletin');

Route::get('/sort-by', [BulletinController::class,'sort'])->name(   'sort-by');

Route::get('/bulletin/show/{id}', [BulletinController::class,'show']);

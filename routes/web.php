<?php

use App\Http\Controllers\DebtController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\Settings\PrintController;
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

//default page
Route::get('/', [HomeController::class,'homePage'])->name('home');

Route::get('/login', [HomeController::class,'loginPage'])->name('login');

Route::group([
'middleware' => 'auth:api'
],function(){
    // ORDER
    Route::get('/order/list', [OrderController::class,'viewListOrder'])->name('listOrder');
    Route::get('/order/add', [OrderController::class,'add'])->name('addOrder');
    // END ORDER
    Route::get('/revenue', [RevenueController::class,'index'])->name('revenue');
    Route::get('/debt', [DebtController::class,'index'])->name('debt');
    // SETTINGS
    //IN ẤN
    Route::get('/settings/add-print', [PrintController::class,'viewCreate'])->name('addPrint');
    //END IN ẤN
    // SETTINGS
});
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\Settings\MemberController;
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
Route::get('/logout', [AuthController::class,'logout'])->name('logout');

Route::group([
'middleware' => 'auth:api'
],function(){
    // ORDER
    Route::get('/order/list', [OrderController::class,'viewListOrder'])->name('listOrder');
    Route::get('/order/add', [OrderController::class,'add'])->name('addOrder');
    Route::get('/order/download', [OrderController::class,'export'])->name('exportOrder');
    // CHI
    Route::get('/revenue', [RevenueController::class,'index'])->name('revenue');
    Route::get('/revenue/{file}', [RevenueController::class,'getFile'])->name('getFile');
    Route::get('/revenue/download/excel', [RevenueController::class,'export'])->name('exportRevenue');
    //NỢ
    Route::get('/debt', [DebtController::class,'index'])->name('debt');
    Route::get('/debt/download', [DebtController::class,'export'])->name('exportDebt');
    //LOẠI IN
    Route::get('/settings/add-print', [PrintController::class,'viewCreate'])->name('addPrint')->middleware('can:ADMIN');
    Route::get('/settings/list-print', [PrintController::class,'viewList'])->name('listPrint')->middleware('can:ADMIN');
    Route::get('/settings/print/update/{id}', [PrintController::class,'viewUpdate'])->name('updatePrint')->middleware('can:ADMIN');
    //THÀNH VIÊN
    Route::get('/settings/member', [MemberController::class,'viewList'])->name('listMember')->middleware('can:ADMIN');

});
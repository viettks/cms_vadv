<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\Settings\MemberController;
use App\Http\Controllers\Settings\PrintController;
use App\Models\Revenue;
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

Route::group([
    "middleware" => "api",
    "prefix" => "auth"

], function ($router) {
    Route::post("/login", [AuthController::class, "login"]);
    Route::get("/profile", [AuthController::class, "userProfile"]);
    Route::get("/logout", [AuthController::class, "logout"]); 
});

//SETTING PRINT
Route::group([
    "middleware" => "auth:api",
    "prefix" => "print"

], function ($router) {
    Route::get("/",    [PrintController::class, "getAll"]);
    Route::get("/info/{id}",[PrintController::class, "getInfo"]);
    Route::post("/",   [PrintController::class, "createPrint"])->middleware("can:ADMIN");
    Route::patch("/",  [PrintController::class, "updatePrint"])->middleware("can:ADMIN");
    Route::delete("/", [PrintController::class, "deletePrint"])->middleware("can:ADMIN");
    Route::get("/list/pagging",[PrintController::class, "getAllPagging"])->middleware("can:ADMIN");
});

//ORDER
Route::group([
    "middleware" => "auth:api",
    "prefix" => "order"

], function ($router) {
    Route::get("/",    [OrderController::class, "getOne"]);
    Route::get("/list", [OrderController::class, "getListOrder"]);
    Route::get("/customer", [OrderController::class, "getCustomeres"]);
    Route::get("/billcode", [OrderController::class, "getOrderCode"]);
    Route::get("/history", [OrderController::class, "getOrderHistory"]);
    Route::post("/", [OrderController::class, "createOrder"]);
    Route::patch("/", [OrderController::class, "update"]);
    Route::delete("/", [OrderController::class, "delete"])->middleware("can:ADMIN");
});

//DEBT
Route::group([
    "middleware" => "auth:api",
    "prefix" => "debt"
], function ($router) {
    Route::get("/",[DebtController::class, "getDebtes"]);
    Route::get("/info",[DebtController::class, "getInfo"]);
    Route::post("/", [DebtController::class, "createDebt"]);
    Route::patch("/complete", [DebtController::class, "completeDebt"]);
});

//REVENUES
Route::group([
    "middleware" => "auth:api",
    "prefix" => "revenue"
], function ($router) {
    Route::get("/list",[RevenueController::class, "getRevenues"]);
    Route::post("/",[RevenueController::class, "create"]);
    Route::patch("/",[RevenueController::class, "approve"])->middleware("can:ADMIN");
});

//MEMBER
Route::group([
    "middleware" => "auth:api,can:ADMIN",
    "prefix" => "member"
], function ($router) {
    Route::get("/list",[MemberController::class, "getListMember"]);
    Route::get("/info",[MemberController::class, "getInfo"]);
    Route::post("/",[MemberController::class, "createMember"]);
    Route::patch("/",[MemberController::class, "updateMember"]);
    Route::delete("/",[MemberController::class, "deleteMember"]);
});

//CHART
Route::group([
    "middleware" => "auth:api",
    "prefix" => "chart"
], function ($router) {
    Route::get("/",[ChartController::class, "getDatas"]);
});

//CHART
Route::group([
    "middleware" => "auth:api",
    "prefix" => "password"
], function ($router) {
    Route::post("/",[AuthController::class, "changePW"]);
});
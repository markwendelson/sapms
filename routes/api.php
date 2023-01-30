<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PurchaseRequestController;
use App\Http\Controllers\Api\PurchaseOrderController;

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

Route::get('/item/{item}', [ItemController::class, 'show']);

Route::get('/user/{id}', [UserController::class, 'show']);

Route::get('/purchase-request/{purchaseRequest}', [PurchaseRequestController::class, 'show']);

Route::get('/purchase-order/{purchaseOrder}', [PurchaseOrderController::class, 'show']);

Route::get('/modules', [UserController::class, 'show']);


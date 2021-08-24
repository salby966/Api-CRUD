<?php

use Illuminate\Http\Request;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\OrdersController;

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
 Route::get('/product',[ProductController::class, 'index']);
 Route::get('/product/view/{id}',[ProductController::class, 'view']);
 Route::post('/product/add',[ProductController::class, 'add']);
 Route::post('/product/edit/{id}',[ProductController::class, 'edit']);
 Route::delete('/product/{id}',[ProductController::class, 'delete']);

 Route::get('/customers',[CustomersController::class, 'index']);
 Route::get('/customers/view/{id}',[CustomersController::class, 'view']);
 Route::post('/customers/add',[CustomersController::class, 'add']);
 Route::post('/customers/edit/{id}',[CustomersController::class, 'edit']);
 Route::delete('/customers/{id}',[CustomersController::class, 'delete']);

 Route::get('/orders',[OrdersController::class, 'index']);
 Route::get('/orders/view/{id}',[OrdersController::class, 'view']);
 Route::post('/orders/add',[OrdersController::class, 'add']);
 Route::post('/orders/edit/{id}',[OrdersController::class, 'edit']);
 Route::delete('/orders/{id}',[OrdersController::class, 'delete']);
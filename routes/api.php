<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrdersController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    //return $request->user();
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/drug/search', [DrugController::class, 'search']);





Route::post('/drug', [DrugController::class, 'create']);
Route::get('/drug', [DrugController::class, 'readAlldrug']);
Route::get('/drug/{id}', [DrugController::class, 'readdrug']);
Route::post('/drug/{id}', [DrugController::class, 'update']);
Route::delete('/drug/{id}', [DrugController::class, 'delete']);






Route::get('/orders', [OrdersController::class, 'index']);
Route::post('/orders', [OrdersController::class, 'store']);
Route::get('/orders/{id}', [OrdersController::class, 'show']);
Route::put('/orders/{id}', [OrdersController::class, 'update']);
Route::delete('/orders/{id}', [OrdersController::class, 'destroy']);





Route::get('/paymentmethods', [PaymentMethodController::class, 'index']);
Route::post('/paymentmethods', [PaymentMethodController::class, 'store']);
Route::get('/paymentmethods/{id}', [PaymentMethodController::class, 'show']);
Route::put('/paymentmethods/{id}', [PaymentMethodController::class, 'update']);
Route::delete('/payment-methods/{id}', [PaymentMethodController::class, 'destroy']);



Route::get('/order_items', [OrderItemController::class, 'index']);
Route::post('/order_items', [OrderItemController::class, 'store']);
Route::get('/order_items/{id}', [OrderItemController::class, 'show']);
Route::put('/order_items/{id}', [OrderItemController::class, 'update']);
Route::delete('/order_items/{id}', [OrderItemController::class, 'destroy']);



Route::get('/transactions', [TransactionController::class, 'index']);
Route::post('/transactions', [TransactionController::class, 'store']);
Route::get('/transactions/{id}', [TransactionController::class, 'show']);
Route::put('/transactions/{id}', [TransactionController::class, 'update']);
Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);

Route::post('/successful-payment', [PaymentController::class, 'handleSuccessfulPayment']);



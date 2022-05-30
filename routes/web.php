<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\TransactionController;
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

Route::get('/', [OrderController::class, 'index']);

Route::resources([
    'order' => OrderController::class,
    'orderitems'=> OrderItemController::class,
    'transaction'=> TransactionController::class
]);

Route::get('/calc-total/{id}', [OrderController::class, 'calc_total']);
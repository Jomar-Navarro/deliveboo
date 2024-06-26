<?php

use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Api\PageController;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;



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

Route::get('/restaurants', [PageController::class, 'index']);
Route::get('/types', [PageController::class, 'type']);
Route::get('/restaurants/filter', [PageController::class, 'getFilteredRestaurants']);
Route::get('restaurants/search', [PageController::class, 'search']);
Route::get('/menu/{id}', [PageController::class, 'getDishesById']);
Route::post('/orders', [OrderController::class, 'store']);

Route::get('client_token', [PaymentController::class, 'getClientToken']);
Route::post('payment', [PaymentController::class, 'processPayment']);

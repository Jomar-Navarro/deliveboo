<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\TypeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Qua le route della CRUD protette da auth
        Route::get('/', [DashboardController::class, 'index'])->name('home');
        Route::resource('type', TypeController::class);
        Route::resource('order', OrderController::class);

        Route::resource('dish', DishController::class);
        Route::get('dishes/trashed', [DishController::class, 'trashed'])->name('dish.trashed');
        Route::post('dish/{id}/restore', [DishController::class, 'restore'])->name('dish.restore');

        Route::resource('restaurant', RestaurantController::class);
        Route::post('restaurant/{id}/restore', [RestaurantController::class, 'restore'])->name('restaurant.restore');
        Route::get('restaurants/trashed', [RestaurantController::class, 'trashed'])->name('restaurant.trashed');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';

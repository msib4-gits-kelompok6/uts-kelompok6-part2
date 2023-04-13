<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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


// auth
Route::get('/register', [AuthController::class, "register"])->name('register');
Route::get('/login', [AuthController::class, "login"])->name('login');
Route::get('/logout', [AuthController::class, "logout"])->name('logout');
Route::post('/register', [AuthController::class, "doRegister"])->name('do.register');
Route::post('/login', [AuthController::class, "doLogin"])->name('do.login');

Route::get('/', [HomeController::class, 'index'])->middleware(['auth:web']);

// product
Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/add', [ProductController::class, 'create']);
    Route::get('/{id}/edit', [ProductController::class, 'edit']);
    Route::get('/{id}/delete', [ProductController::class, 'destroy']);
    Route::post('/', [ProductController::class, 'store']);
    Route::put('/{id}', [ProductController::class, 'update']);
});

// category
Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/add', [CategoryController::class, 'create']);
    Route::get('/{id}/edit', [CategoryController::class, 'edit']);
    Route::get('/{id}/delete', [CategoryController::class, 'destroy']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::put('/{id}', [CategoryController::class, 'update']);
});

// cart
Route::post('/cart/{product}', [CartController::class, 'add_toCart'])->name('add_toCart');
Route::get('/cart', [CartController::class, 'show_cart'])->name('show_cart');
Route::patch('/cart/{cart}', [CartController::class, 'update_cart'])->name('update_cart');
Route::delete('/cart/{cart}', [CartController::class, 'delete_cart'])->name('delete_cart');

// transaction
Route::post('/checkout', [TransactionController::class, 'checkout'])->name('checkout');
Route::get('/transaction', [TransactionController::class, 'index']);
Route::get('/transaction/{transaction}', [TransactionController::class, 'show_detail'])->name('show_detail');

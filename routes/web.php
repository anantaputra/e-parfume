<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminInventoryController;
use App\Http\Controllers\ContactController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('/shop')->name('shop')->group(function() {
    Route::get('/', [ShopController::class, 'index']);
    Route::get('/{slug}', [ShopController::class, 'single'])->name('.single');
});
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Auth::routes();

Route::prefix('/cart')->name('cart')->group(function(){
    Route::get('/', [CartController::class, 'index']);
    Route::post('/add', [CartController::class, 'add'])->name('.add');
    Route::get('/delete/{id}', [CartController::class, 'delete'])->name('.delete');
});

Route::prefix('/checkout')->name('checkout')->group(function(){
    Route::get('/cart', [CheckoutController::class, 'index']);
    Route::post('/store', [CheckoutController::class, 'store'])->name('.store');
    Route::get('/product/{slug}', [CheckoutController::class, 'product'])->name('.product');
    Route::get('/province/{id}', [CheckoutController::class, 'city'])->name('.city');
    Route::get('/shipping/{city}/{courier}', [CheckoutController::class, 'shipping'])->name('.shipping');
});

Route::prefix('/transaction')->name('transaction')->group(function(){
    Route::post('/store', [TransactionController::class, 'store'])->name('.store');
});

Route::prefix('/admin')->name('admin')->group(function() {
    Route::prefix('/dashboard')->name('.dashboard')->group(function() {
        Route::get('/', [AdminDashboardController::class, 'index']);
    });
    
    Route::prefix('/order')->name('.order')->group(function() {
        Route::get('/', [AdminOrderController::class, 'index']);
        Route::get('/processing', [AdminOrderController::class, 'processing'])->name('.processing');
        Route::get('/history', [AdminOrderController::class, 'history'])->name('.history');
        Route::get('/view/{id}', [AdminOrderController::class, 'view'])->name('.view');
        Route::get('/tracking/{id}', [AdminOrderController::class, 'tracking'])->name('.tracking');
        Route::post('/store-tracking', [AdminOrderController::class, 'store_tracking'])->name('.store-tracking');
        Route::get('/edit/{slug}', [AdminProductController::class, 'edit'])->name('.edit');
        Route::post('/store-edit', [AdminProductController::class, 'store_edit'])->name('.store-edit');
        Route::get('/delete/{slug}', [AdminProductController::class, 'delete'])->name('.delete');
    });
    
    Route::prefix('/product')->name('.product')->group(function() {
        Route::get('/', [AdminProductController::class, 'index']);
        Route::get('/add', [AdminProductController::class, 'add'])->name('.add');
        Route::post('/store', [AdminProductController::class, 'store'])->name('.store');
        Route::get('/edit/{slug}', [AdminProductController::class, 'edit'])->name('.edit');
        Route::post('/store-edit', [AdminProductController::class, 'store_edit'])->name('.store-edit');
        Route::get('/delete/{slug}', [AdminProductController::class, 'delete'])->name('.delete');

        Route::prefix('/inventory')->name('.inventory')->group(function() {
            Route::get('/', [AdminInventoryController::class, 'index']);
            Route::get('/history/{id}', [AdminInventoryController::class, 'history'])->name('.history');
            Route::get('/add/{id}', [AdminInventoryController::class, 'add'])->name('.add');
            Route::post('/store', [AdminInventoryController::class, 'store'])->name('.store');
            Route::get('/edit/{id}', [AdminInventoryController::class, 'edit'])->name('.edit');
            Route::post('/store-edit', [AdminInventoryController::class, 'store_edit'])->name('.store-edit');
            Route::get('/delete/{id}', [AdminInventoryController::class, 'delete'])->name('.delete');
        });
    });

    Route::prefix('/customer')->name('.customer')->group(function() {
        Route::get('/', [AdminCustomerController::class, 'index']);
    });
});

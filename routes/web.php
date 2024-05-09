<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [PageController::class, 'index'])->name('index');

Route::name('cart.')->prefix('cart')->controller(CartController::class)->group(callback: function (): void {
    Route::get('/', 'index')->name('index');
    Route::get('add/{productId}', 'add')->name('add');
    Route::patch('update', 'update')->name('update');
    Route::get('drop', 'drop')->name('drop');
    Route::get('destroy', 'destroy')->name('destroy');
    Route::get('checkout', 'checkout')->name('checkout');
    Route::get('success/{orderId}', 'success')->name('success');
});

Route::resource('catalog', CatalogController::class)->parameters([
    'catalog' => 'slug'
]);

Route::resource('order', OrderController::class)->only(['store', 'update', 'destroy', 'show']);

Route::middleware(['auth', 'admin-panel'])->prefix('admin-panel')->group(callback: function (): void {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    //Users
    Route::resource('users', UserController::class)->except(['show', 'create', 'store'])->names('admin.users');

    //Products
    Route::name('admin.products.')->prefix('products')->controller(ProductController::class)->group(callback: function (): void {
        Route::get('/', 'index')->name('index');
        Route::get('edit/{product}', 'edit')->name('edit');
        Route::put('edit/{product}', 'update')->name('update');
        Route::get('create', 'create')->name('create');
        Route::post('create', 'store')->name('store');
        Route::get('delete/{product}', 'delete')->name('delete');
        Route::get('drop/{id}', 'destroy')->name('destroy');
        Route::get('restore/{id}', 'restore')->name('restore');
    });

    //Orders
    Route::name('admin.orders.')->prefix('orders')->controller(OrderController::class)->group(callback: function (): void {
        Route::get('/', 'index')->name('index');
        Route::get('show/{order}', 'show')->name('show');
        Route::get('delete/{order}', 'delete')->name('delete');
        Route::get('drop/{id}', 'destroy')->name('destroy');
        Route::get('restore/{id}', 'restore')->name('restore');
    });
});

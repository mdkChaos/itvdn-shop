<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [PageController::class, 'index'])->name('index');

Route::prefix('cart')->group(function () {
    Route::controller(CartController::class)->group(function () {
        Route::get('/', 'index')->name('cart.index');
        Route::get('add/{productId}', 'add')->name('cart.add');
        Route::patch('update', 'update')->name('cart.update');
        Route::get('drop', 'drop')->name('cart.drop');
        Route::get('destroy', 'destroy')->name('cart.destroy');
        Route::get('checkout', 'checkout')->name('cart.checkout');
        Route::get('success/{orderId}', 'success')->name('cart.success');
    });
});

Route::resource('catalog', CatalogController::class)->parameters([
    'catalog' => 'slug'
]);

Route::resource('order', OrderController::class)->only(['store', 'update', 'destroy', 'show']);

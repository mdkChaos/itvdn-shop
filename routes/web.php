<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [PageController::class, 'index'])->name('index');

Route::resource('catalog', CatalogController::class)->parameters([
    'catalog' => 'slug'
]);

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('update', [CartController::class, 'update'])->name('cart.update');
    Route::get('drop', [CartController::class, 'drop'])->name('cart.drop');
    Route::get('destroy', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('success/{orderId}', [CartController::class, 'success'])->name('cart.success');
});

Route::resource('order', OrderController::class, ['only' => ['store', 'update', 'destroy', 'show']]);

<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [PageController::class, 'index'])->name('index');

Route::resource('catalog', CatalogController::class)->parameters([
    'catalog' => 'slug'
]);


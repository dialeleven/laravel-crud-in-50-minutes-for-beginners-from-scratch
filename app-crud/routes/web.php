<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product', [ProductController::class, 'index'])->name('product.index');

// ********** testing *************/
Route::get('/product2', [ProductController::class, 'index2'])->name('product.index2');
Route::get('/test', [ProductController::class, 'test'])->name('product.test');
Route::get('/test2', [ProductController::class, 'test2'])->name('product.test2');
// ********** /end testing *************/

Route::get('/product/exportcsv', [ProductController::class, 'indexExportCsv'])->name('product.index.exportcsv');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/{product}/update', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{product}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
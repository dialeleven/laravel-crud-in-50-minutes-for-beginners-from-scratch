<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController; // namespace for our "Products" Controller
use App\Http\Controllers\Admin\AdminUsersController; // namespace for our "Adminusers" Controller
use App\Http\Controllers\Admin\LoginController; // namespace for our "Login" Controller to handle /login, /forgotpassword, etc

Route::get('/', function () {
    return view('welcome');
});


/*************************************************************
 ******************** Product routes *************************
 *************************************************************/

// Product index - no middleware
Route::get('/product', [ProductController::class, 'index'])->name('product.index');

// Product index - 'auth' middleware added which will redirect to a 'login' route by default
//Route::get('/product', [ProductController::class, 'index'])->name('product.index')->middleware('auth');



Route::group(['middleware' => ['auth', 'web']], function() {
    // * Routes that require authentication
    // Route::get('/product', [ProductController::class, 'index'])->name('product.index');
});


Route::get('/product/exportcsv', [ProductController::class, 'indexExportCsv'])->name('product.index.exportcsv');

Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');

Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/{product}/update', [ProductController::class, 'update'])->name('product.update');

Route::delete('/product/{product}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
    // ********** testing *************/
    Route::get('/product2', [ProductController::class, 'index2'])->name('product.index2');
    Route::get('/test', [ProductController::class, 'test'])->name('product.test');
    Route::get('/test2', [ProductController::class, 'test2'])->name('product.test2');
    // ********** /end testing *************/


/*************************************************************
 ******************** Admin users routes *********************
 *************************************************************/
Route::get('/adminusers', [AdminusersController::class, 'index'])->name('adminusers.index');

Route::get('/adminusers/create', [AdminusersController::class, 'create'])->name('adminusers.create');
Route::post('/adminusers', [AdminusersController::class, 'store'])->name('adminusers.store');

Route::get('/adminusers/{adminuser}/edit', [AdminusersController::class, 'edit'])->name('adminusers.edit');
Route::put('/adminusers/{adminuser}/update', [AdminusersController::class, 'update'])->name('adminusers.update');

Route::delete('/adminusers/{adminuser}/destroy', [AdminusersController::class, 'destroy'])->name('adminusers.destroy');


/*************************************************************
 ********************** Login routes *************************
 *************************************************************/
Route::get('/adminlogin', [LoginController::class, 'adminloginLoginForm'])->name('adminlogin');
Route::post('/adminlogin-process', [LoginController::class, 'adminloginProcess'])->name('adminlogin.process');
Route::post('/adminlogin-logout', [LoginController::class, 'adminloginLogout'])->name('adminlogin.logout');

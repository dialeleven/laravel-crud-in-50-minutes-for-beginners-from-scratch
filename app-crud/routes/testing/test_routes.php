<?php
use App\Http\Controllers\TestApiResourceController;
use App\Http\Controllers\WidgetController;
use App\Http\Controllers\Admin\ProductController; // namespace for our "Products" Controller


// Resource controller will automatically create routes for 'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
// for you to use and help keep your routes file cleaner! Run `php artisan route:list` to see all routes.
Route::resource('widgets', WidgetController::class)->except(['show']);
Route::resource('xyztest', WidgetController::class)->only(['index', 'edit', 'update']);


// API resource controller (excludes 'create' and 'edit' routes which don't exist in an API)
Route::apiResource('apitest', TestApiResourceController::class);


Route::get('/', function () {
    return view('welcome');
});


Route::get('/test-route/{user_id?}', function($user_id = 'default_id') {
   return view('test-view', ['user_id' => $user_id]);
});


// another way to do the same thing as in our '/test-route' route above; a bit less code
Route::view('/test-route-alt/{user_id?}', 'test-view', ['user_id' => 'default_id']);

Route::get('/test2', [ProductController::class, 'test2'])->name('product.test2');
<?php
use Illuminate\Support\Facades\Route;

//--------- ADMIN SITE CONTROLLERS ------------//
use App\Http\Controllers\Admin\ProductController; // namespace for our "Products" Controller
use App\Http\Controllers\Admin\AdminUsersController; // namespace for our "Adminusers" Controller
use App\Http\Controllers\Admin\LoginController; // namespace for our "Login" Controller to handle /login

//---------- PUBLIC SITE CONTROLLERS ---------------//
use App\Http\Controllers\Public\PublicpageController; // test public page
use App\Http\Controllers\Public\PublicProductController; // test public page

use Illuminate\Http\Request; // use in conjunction with 'Password' Facade
use Illuminate\Support\Facades\Password; // lost password/reset password

use Illuminate\Support\Facades\Mail; // email functionality
use App\Mail\TestMail;               // email functionality

Route::get('/', function () {
    return view('welcome');
});


Route::get('/send-test-email', function () {
    Mail::to('to@demomailtrap.com')->send(new TestMail());
    return 'Email sent! ' . date('Y-m-d H:i:s');
});


/*---------------------------------------------------
|                                                   |
|               ADMIN SITE ROUTES                   |
|                                                   |
-----------------------------------------------------*/

// Product index - no middleware
//Route::get('/product', [ProductController::class, 'index'])->name('product.index');

// Product index - 'auth' middleware added which will redirect to a 'login' route by default
//Route::get('/product', [ProductController::class, 'index'])->name('product.index')->middleware('auth');

// * Group routes that require authentication
Route::group(['middleware' => ['auth', 'web']], function()
{
    /*************************************************************
     ******************** Product routes *************************
    *************************************************************/
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/exportcsv', [ProductController::class, 'indexExportCsv'])->name('product.index.exportcsv');
    
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{product}/update', [ProductController::class, 'update'])->name('product.update');
    
    Route::delete('/product/{product}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');


    /*************************************************************
     ******************** Admin users routes *********************
     *************************************************************/
    Route::get('/adminusers', [AdminusersController::class, 'index'])->name('adminusers.index');
    
    Route::get('/adminusers/create', [AdminusersController::class, 'create'])->name('adminusers.create');
    Route::post('/adminusers', [AdminusersController::class, 'store'])->name('adminusers.store');
    
    Route::get('/adminusers/{adminuser}/edit', [AdminusersController::class, 'edit'])->name('adminusers.edit');
    Route::put('/adminusers/{adminuser}/update', [AdminusersController::class, 'update'])->name('adminusers.update');
    
    Route::delete('/adminusers/{adminuser}/destroy', [AdminusersController::class, 'destroy'])->name('adminusers.destroy');
});

// ********** testing *************/
Route::get('/product2', [ProductController::class, 'index2'])->name('product.index2');
Route::get('/test', [ProductController::class, 'test'])->name('product.test');
Route::get('/test2', [ProductController::class, 'test2'])->name('product.test2');
// ********** /end testing *************/


/*************************************************************
 ********************** Login routes *************************
 *************************************************************/
Route::get('/adminlogin', [LoginController::class, 'adminloginLoginForm'])->name('login'); // named 'login' b/c Laravel expects 'login' route by default
Route::post('/adminlogin-process', [LoginController::class, 'adminloginProcess'])->name('adminlogin.process');
Route::post('/adminlogin-logout', [LoginController::class, 'adminloginLogout'])->name('adminlogin.logout');

// ! TEMPORARY ROUTE: reset password request 
Route::get('/admin-forgot-password2', [LoginController::class, 'adminForgotPasswordTemp'])->name('password.request2');


// ??? THIS IS NOT WORKING FOR SOME REASON -  reset password request
Route::get('/admin-forgot-password', function() {
    dd('hi');
    return view('admin.login.forgot_password');
})->middleware('guest')->name('password.request');


// forgot password - POST request
Route::post('/admin-forgot_password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');


// Route for handling password reset form display
Route::get('/admin-reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');


// Route for handling password reset form submission
Route::post('/admin-reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();

            $user->setRememberToken(Str::random(60));

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');


/*---------------------------------------------------
|                                                   |
|               PUBLIC SITE ROUTES                  |
|                                                   |
-----------------------------------------------------*/
Route::get('/products', [PublicProductController::class, 'index'])->name('public_products.index');
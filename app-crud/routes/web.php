<?php
//---------- LARAVEL CLASSES/FACADES --------------//
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // use in conjunction with 'Password' Facade. (maybe not needed since password reset is in a controller now)


//--------- ADMIN SITE CONTROLLERS ------------//
use App\Http\Controllers\Admin\ProductController; // namespace for our "Products" Controller
use App\Http\Controllers\Admin\AdminUsersController; // namespace for our "Adminusers" Controller
use App\Http\Controllers\Admin\LoginController; // namespace for our "Login" Controller to handle /login
use App\Http\Controllers\Admin\PasswordResetController;
use App\Http\Controllers\Admin\EmailController;

//---------- PUBLIC SITE CONTROLLERS ---------------//
use App\Http\Controllers\Public\PublicpageController; // test public page
use App\Http\Controllers\Public\PublicProductController; // public product page
use App\Http\Controllers\Public\WeatherApiController; // weatherapi.com controller

//--------- App Models ---------------//
use App\Models\Common\Product;
use App\Models\AdminSite\Admin;


// ********** testing routes *************/\
Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-route/{user_id?}', function($user_id = 'default_id') {
   return view('test-view', ['user_id' => $user_id]);
});

// another way to do the same thing as in our '/test-route' route above; a bit less code
Route::view('/test-route-alt/{user_id?}', 'test-view', ['user_id' => 'default_id']);

Route::get('/test2', [ProductController::class, 'test2'])->name('product.test2');
// ********** /end testing *************/


/*************************************************************
 **************** SECTION: Utility routes ********************
 *************************************************************/

// lost the 'storage' link in /public? Call this route to fix it.
Route::get('/linkstorage', function () {
   Artisan::call('storage:link');
});


/*---------------------------------------------------
|                                                   |
|               ADMIN SITE ROUTES                   |
|                                                   |
-----------------------------------------------------*/

// Product index - 'auth' middleware added which will redirect to a 'login' route by default
//Route::get('/product', [ProductController::class, 'index'])->name('product.index')->middleware('auth:adminsite.user');

// * Group routes that require authentication
Route::group(['middleware' => ['auth', 'auth.adminsite.user']], function()
{
   // Admin dashboard index
   Route::get('/admin-index', function () {
      #dd(auth()->user());
      #dd(Auth::user);
      
      // get total products
      $total_products = Product::count();

      // get total adminusers
      $total_adminusers = Admin::count();

      //return view('admin.index', ['total_products' => $total_products, 'total_admins' => $total_admins]);
      return view('admin.index', compact('total_products', 'total_adminusers'));
   })->name('admin.index');
   

   /************************************************************
   ************ SECTION: Product routes ************************
   *************************************************************/
   Route::get('/product', [ProductController::class, 'index'])->name('product.index');
   Route::get('/product/exportcsv', [ProductController::class, 'indexExportCsv'])->name('product.index.exportcsv');
   
   Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
   Route::post('/product', [ProductController::class, 'store'])->name('product.store');
   
   Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
   Route::put('/product/{product}/update', [ProductController::class, 'update'])->name('product.update');
   
   Route::delete('/product/{product}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');


   /*********************************************************************
   ************* SECTION: Admin users routes (for admin and superadmin) *
   *********************************************************************/
   Route::middleware(['auth', 'auth.adminsite.admin', 'auth.adminsite.superadmin'])->group(function () {
      Route::get('/adminusers', [AdminusersController::class, 'index'])->name('adminusers.index');
      
      Route::get('/adminusers/create', [AdminusersController::class, 'create'])->name('adminusers.create');
      Route::post('/adminusers', [AdminusersController::class, 'store'])->name('adminusers.store');
      
      Route::get('/adminusers/{adminuser}/edit', [AdminusersController::class, 'edit'])->name('adminusers.edit');
      Route::put('/adminusers/{adminuser}/update', [AdminusersController::class, 'update'])->name('adminusers.update');
   });

   Route::middleware(['auth', 'auth.adminsite.superadmin'])->group(function () {
      Route::delete('/adminusers/{adminuser}/destroy', [AdminusersController::class, 'destroy'])->name('adminusers.destroy');
   });


   Route::get('/misc', function () {
      return view('admin.misc');
   })->name('admin-misc');
});


/*************************************************************
**************** SECTION: Login routes ***********************
*************************************************************/
Route::get('/adminlogin', [LoginController::class, 'adminloginLoginForm'])->name('login'); // named 'login' b/c Laravel expects 'login' route by default?
Route::post('/adminlogin-process', [LoginController::class, 'adminloginProcess'])->name('adminlogin.process');
Route::post('/adminlogin-logout', [LoginController::class, 'adminloginLogout'])->name('adminlogin.logout');


/*************************************************************
*********** SECTION: Forgot/reset password routes ************
*************************************************************/

// * test route to see if an 'admin' is logged in
Route::get('/admin-check', function () {
   if (Auth::guard('admin')->check()) {
       return 'Admin is logged in';
   } else {
       #dd(Auth::guard('admin'));
       return 'Admin is not logged in';
   }
});


// forgot password - VIEW
Route::get('/admin-forgot-password', function() {
   #dd('hi');
   return view('admin.login.forgot_password');
})->name('password.request');

// forgot password - POST request
Route::post('/admin-forgot-password/send-reset-link', [PasswordResetController::class, 'sendResetLink'])
    ->name('password.send-reset-link');

// reset password (passing token and email) - VIEW
Route::get('/admin-reset-password/{token}/{email}', function ($token, $email) {
   return view('admin.login.reset_password', ['token' => $token, 'email' => $email]);
})->name('password.reset');

// reset password form submission - POST request
Route::post('/admin-reset-password', [PasswordResetController::class, 'passwordUpdate'])
    ->name('password.update');


/*************************************************************
 **************** SECTION: Email routes **********************
 *************************************************************/

// Send email using Laravel and Gmail SMTP (https://bit.ly/3yMjum0)
Route::get('/email', [EmailController::class, 'sendEmail'])->name('send.email');

// send email with attachment
Route::get('/email-with-attachment', [EmailController::class, 'sendEmailWithAttachment'])->name('send.email.with.attachment');

// send email with cc/bcc (// ! CC/BCC list is visible in email!!!)
Route::get('/email-with-cc-bcc', [EmailController::class, 'sendEmailWithCcBcc'])->name('send.email.with.cc.bcc');


/*---------------------------------------------------
|                                                   |
|               PUBLIC SITE ROUTES                  |
|                                                   |
-----------------------------------------------------*/
Route::get('/products', [PublicProductController::class, 'index'])->name('public_products.index');


/************************************************************
**************** SECTION: API routes ************************
*************************************************************/
Route::get('weatherapi', [WeatherApiController::class, 'index'])->name('weatherapi.index');
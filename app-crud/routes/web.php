<?php
//---------- LARAVEL CLASSES/FACADES --------------//
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // use in conjunction with 'Password' Facade
use Illuminate\Support\Facades\Password; // lost password/reset password

#use App\Http\Controllers\EmailController; // ! FOR EMAIL???
use Illuminate\Support\Facades\Mail; // email functionality
//use App\Mail\TestMail;               // ? don't need it I think - email functionality


//--------- ADMIN SITE CONTROLLERS ------------//
use App\Http\Controllers\Admin\ProductController; // namespace for our "Products" Controller
use App\Http\Controllers\Admin\AdminUsersController; // namespace for our "Adminusers" Controller
use App\Http\Controllers\Admin\LoginController; // namespace for our "Login" Controller to handle /login


//---------- PUBLIC SITE CONTROLLERS ---------------//
use App\Http\Controllers\Public\PublicpageController; // test public page
use App\Http\Controllers\Public\PublicProductController; // test public page
use App\Http\Controllers\Public\WeatherApiController; // test public page

use App\Mail\MyTestEmail;


Route::get('/', function () {
    return view('welcome');
});

/*
Route::get('/send-test-email', function () {
    Mail::to('username@gmail.com')->send(new TestMail());
    return 'Email sent! ' . date('Y-m-d H:i:s');
});
*/


/*************************************************************
 **************** SECTION: Email routes **********************
 *************************************************************/

/*
Send email using Laravel and Gmail SMTP
https://mailtrap.io/blog/laravel-send-email-gmail/#How-to-send-emails-using-Laravel-and-Gmail-SMTP
*/
Route::get('/email', function() {
   $name = "Funny Coder";

   $to_email = 'username@gmail.com';

   // The email sending is done using the to method on the Mail facade
   $val = Mail::to($to_email)->send(new MyTestEmail($name = 'Jon Doe'));

   return "<b>Email sent to $to_email!</b><h1>" . date('Y-m-d H:i:s') . '</h1>';
});

Route::get('/email-with-attachment', function() {
   $name = "Funny Coder";
   $filePath = [
                  'images/20240507_023639000000_twice_between1&2.jpg', 
                  'images/20240507_025420000000_twice_group.jpg'
               ];

   $to_email = 'username@gmail.com';

   // The email sending is done using the to method on the Mail facade
   // Mail::to($to_email)->send(new MyTestEmail($name));
   Mail::to($to_email)->send(new MyTestEmail($name, $filePath));

   return "<b>Email sent to <span style='color: blue'>$to_email</span>!</b><h1>" . date('Y-m-d H:i:s') . '</h1>';
});

// send email with cc/bcc (// ! CC/BCC list is visible in email!!!)
Route::get('/email-with-cc-bcc', function() {
   $mainRecipients = ['main1@example.com', 'main2@example.com'];
   #$ccRecipients = ['cc1@example.com', 'cc2@example.com'];
   $ccRecipients = '';
   $bccRecipients = ['username@gmail.com', 'username@gmail.com'];
   $name = "Funny Coder"; // Dynamic content
   /*
   Mail::to($mainRecipients)
      ->cc($ccRecipients)
      ->bcc($bccRecipients)
      ->send(new MyTestEmail($name));
   */
   Mail::bcc($bccRecipients)
      ->send(new MyTestEmail());
   
   print_r($bccRecipients);
   return "<b>Email sent!</b><h1>" . date('Y-m-d H:i:s') . '</h1>';
});


// lost the 'storage' link in /public? Call this method to fix it.
Route::get('/linkstorage', function () {
   Artisan::call('storage:link');
});


/*************************************************************
 **************** SECTION: API routes **********************
 *************************************************************/
Route::get('weatherapi', [WeatherApiController::class, 'index'])->name('weatherapi.index');

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
    ************ SECTION: Product routes ************************
   *************************************************************/
   Route::get('/product', [ProductController::class, 'index'])->name('product.index');
   Route::get('/product/exportcsv', [ProductController::class, 'indexExportCsv'])->name('product.index.exportcsv');
   
   Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
   Route::post('/product', [ProductController::class, 'store'])->name('product.store');
   
   Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
   Route::put('/product/{product}/update', [ProductController::class, 'update'])->name('product.update');
   
   Route::delete('/product/{product}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');


   /*************************************************************
    ************ SECTION: Admin users routes ********************
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
 **************** SECTION: Login routes **********************
 *************************************************************/
Route::get('/adminlogin', [LoginController::class, 'adminloginLoginForm'])->name('login'); // named 'login' b/c Laravel expects 'login' route by default
Route::post('/adminlogin-process', [LoginController::class, 'adminloginProcess'])->name('adminlogin.process');
Route::post('/adminlogin-logout', [LoginController::class, 'adminloginLogout'])->name('adminlogin.logout');

// ! TEMPORARY ROUTE: reset password request since 'password.request' WAS redirecting to the default Laravel page
Route::get('/admin-forgot-password2', [LoginController::class, 'adminForgotPasswordTemp'])->name('password.request2');


// reset password request
Route::get('/admin-forgot-password', function() {
   #dd('hi');
   return view('admin.login.forgot_password');
})->name('password.request');


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
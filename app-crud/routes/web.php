<?php
//---------- LARAVEL CLASSES/FACADES --------------//
use App\Http\Controllers\Admin\AdminsiteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // use in conjunction with 'Password' Facade. (maybe not needed since password reset is in a controller now)
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\RedirectResponse;

//--------- ADMIN SITE CONTROLLERS ------------//
use App\Http\Controllers\Admin\ProductController; // namespace for our "Product" Controller
use App\Http\Controllers\Admin\AdminUserController; // namespace for our "Adminusers" Controller
use App\Http\Controllers\Admin\LoginController; // namespace for our "Login" Controller to handle /adminsite/login
use App\Http\Controllers\Admin\PasswordResetController;
use App\Http\Controllers\Admin\EmailController;

//---------- PUBLIC SITE CONTROLLERS ---------------//
use App\Http\Controllers\Public\PublicProductController; // public product page
use App\Http\Controllers\Public\WeatherApiController; // weatherapi.com controller
use App\Http\Controllers\Public\PublicLoginController; // namespace for our "Login" Controller to handle /login

//--------- App Models ---------------//
#use App\Models\Common\Product;
#use App\Models\AdminSite\Admin;


// SECTION: Test routes ---------------------------------------
require_once 'testing/test_routes.php';


/*---------------------------------------------------
|                                                   |
|               ADMIN SITE ROUTES                   |
|                                                   |
-----------------------------------------------------*/

// Product index - 'auth' middleware added which will redirect to a 'login' route by default
//Route::get('/product', [ProductController::class, 'index'])->name('products.index')->middleware('auth:adminsite.user');


// Admin site routes
Route::prefix('adminsite')->group(function()
{
   // Login routes
   Route::controller(LoginController::class)->group(function () {
      Route::get('/login', 'adminsiteLoginForm')->name('login'); // Named 'login' b/c default Laravel authentication middleware 
                                                                 // expects 'login' route to be defined.
      Route::post('/login-process', 'adminsiteLoginProcess')->name('adminsite.login-process');
      Route::post('/logout', 'adminsiteLogout')->name('adminsite.logout');
   });


   // Routes that require authentication to access admin site
   Route::group(['middleware' => ['auth', 'auth.adminsite.user']], function()
   {
      // admin site index
      Route::get('/', [AdminsiteController::class, 'index'])->name('adminsite.index');

      
      // SECTION: Product routes ---------------------------------------
      Route::resource('/products', ProductController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
      Route::get('/products/exportcsv', [ProductController::class, 'indexExportCsv'])->name('products.index.exportcsv');


      // SECTION: Admin users routes (for admin and superadmin)  ---------------------------------------
      Route::group(['middleware' => ['auth', 'auth.adminsite.admin', 'auth.adminsite.superadmin']], function() {
         Route::resource('/adminusers', AdminUserController::class)->only(['index', 'create', 'store', 'edit', 'update']);
      });

      Route::group(['middleware' => ['auth', 'auth.adminsite.superadmin']], function() {
         Route::resource('/adminusers', AdminUserController::class)->only(['destroy']);
      });


      // SECTION: Misc routes ---------------------------------------
      Route::view('/misc', 'admin.misc', ['title' => 'Miscellaneous'])->name('admin_misc');
   }); // end auth middleware for adminsite 'users'

});



// SECTION: Forgot/reset password routes ---------------------------------------

// forgot password - VIEW
Route::get('/admin-forgot-password', function() {
   #dd('hi');
   return view('admin.login.forgot_password');
})->name('password.request');

// forgot password - POST request
Route::post('/admin-forgot-password/send-reset-link', [PasswordResetController::class, 'sendResetLink'])
    ->name('password.send_reset_link');

// reset password (passing token and email) - VIEW
Route::get('/admin-reset-password/{token}/{email}', function ($token, $email) {
   return view('admin.login.reset_password', ['token' => $token, 'email' => $email]);
})->name('password.reset');

// reset password form submission - POST request
Route::post('/admin-reset-password', [PasswordResetController::class, 'passwordUpdate'])
    ->name('password.update');

// * test route to see if an 'admin' is logged in
Route::get('/admin-check', function () {
   if (Auth::guard('admin')->check()) {
       return 'Admin is logged in';
   } else {
       #dd(Auth::guard('admin'));
       return 'Admin is not logged in';
   }
});


// SECTION: Email routes  ---------------------------------------

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


// SECTION: API routes ---------------------------------------
Route::get('weatherapi', [WeatherApiController::class, 'index'])->name('weatherapi.index');


// SECTION: Login routes ---------------------------------------
Route::controller(PublicLoginController::class)->group(function () {
   Route::get('/login', 'publicsiteLoginForm')->name('publicsite.login'); // Named 'login' b/c default Laravel authentication middleware 
                                                              // expects 'login' route to be defined.
   Route::post('/login-process', 'publicsiteLoginProcess')->name('publicsite.login-process');
   Route::post('/logout', 'publicsiteLogout')->name('publicsite.logout');
});


// SECTION: Stripe routes ---------------------------------------
Route::get('/checkout-simple', function (Request $request) {
   $stripePriceId = 'price_deluxe_album';

   $quantity = 1;

   return $request->user()->checkout([$stripePriceId => $quantity], [
       'success_url' => route('checkout-success'),
       'cancel_url' => route('checkout-cancel'),
   ]);
})->name('checkout.simple');

Route::middleware('auth')->get('/checkout2', function (Request $request) {
   $stripePriceId = 'price_deluxe_album';
   $quantity = 1;
   return $request->user()->checkout([$stripePriceId => $quantity], [
       'success_url' => route('checkout-success'),
       'cancel_url' => route('checkout-cancel'),
   ]);
})->name('checkout2');


#Route::middleware('auth:web')->get('/checkout', function (Request $request) {
Route::get('/checkout', function (Request $request) {
      $stripePriceId = '9.99';
      $quantity = 1;
  
      Stripe::setApiKey(env('STRIPE_SECRET'));
  
      try {
          $session = Session::create([
              'payment_method_types' => ['card'],
              'line_items' => [[
                  //'price' => $stripePriceId,
                  'price_data' => [
                      'currency' => 'usd',
                      'unit_amount' => $quantity * 1000,
                      'product_data' => [
                          'name' => 'Deluxe Album',
                      ],
                  ],
                  'quantity' => $quantity,
              ]],
              'mode' => 'payment',
              'success_url' => route('checkout-success'),
              'cancel_url' => route('checkout-cancel'),
          ]);
  
          return new RedirectResponse($session->url);
      } catch (\Exception $e) {
          return back()->withErrors(['error' => $e->getMessage()]);
      }
  })->name('checkout');

Route::view('/checkout/success', 'public.stripe_checkout.success')->name('checkout-success');
Route::view('/checkout/cancel', 'public.stripe_checkout.cancel')->name('checkout-cancel');
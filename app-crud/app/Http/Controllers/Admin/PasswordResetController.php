<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Support\Facades\Password; // lost password/reset password
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str; // for password update

use App\Models\AdminSite\Admin; // import our Admin model (MySQL table: admins)


class PasswordResetController extends Controller
{
   // forgot password - POST request
   public function sendResetLink(Request $request)
   {
      #dd('test');
      #dd($request);
      
      $request->validate(['email' => 'required|email']);

      $status = Password::broker('admins')->sendResetLink(
         $request->only('email')
      );

      // Log the status and check if notification is being sent
      #Log::info('status: ' . $status);

      return $status === Password::RESET_LINK_SENT
         ? back()->with(['status' => __($status)])
         : back()->withErrors(['email' => __($status)]);
   }


   // reset password form submission - POST request
   public function passwordUpdate(Request $request)
   {
      $request->validate([
         'token' => 'required',
         'email' => 'nullable|email',
         #'password' => 'required|min:8',
         'password' => [
               'required', 
               //PasswordRule::defaults()
               PasswordRule::min(8)->mixedCase()->numbers()->symbols()->uncompromised()
           ],
      ]);

      $status = Password::broker('admins')->reset(
         $request->only('email', 'password', 'token'),
         function ($user, $password) {
            $user->forceFill([
                  'password' => Hash::make($password)
            ])->save();
   
            $user->setRememberToken(Str::random(60));
   
            event(new PasswordReset($user));
         }
      );
      #dd($status);
   
      return $status === Password::PASSWORD_RESET
         ? redirect()->route('login')->with('status', __($status))
         : back()->withErrors(['email' => [__($status)]]);
   }
}

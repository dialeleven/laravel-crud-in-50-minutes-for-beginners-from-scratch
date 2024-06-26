<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Import the base Controller class
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import Hash facade to bcrypt hash password
use Illuminate\Support\Facades\Auth;
use App\Models\AdminSite\Admin; // import our Admin model (MySQL table: admins)

use Illuminate\Support\Facades\Response; // ? still needed


class LoginController extends Controller
{
    // admin site - show login form
    public function adminsiteLoginForm() {
        //return view('login.index', ['products' => $products]);
        return view('admin.login.index');
    }

    // admin site - process admin login user/pass
    public function adminsiteLoginProcess(Request $request)
    {
        // dd($request);

        // validate form input
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // verify user/pass match in db
        if ( Auth::attempt([ 'email' => $data['email'], 'password' => $data['password'] ], $request->remember) )
        // if ( Auth::attempt([ $data ]) )
        {
            // regenerate session token after successful login to prevent session fixation attack
            request()->session()->regenerate();
            
            // redirect to admin dashboard
            return redirect()->route('adminsite.index')->with('success', 'Welcome back!');
        }

        // authentication failed, redirect back with errors
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records',
        ]);
    }


    // log user out of admin site
    public function adminsiteLogout(Request $request) {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('adminsite.login')->with('success', 'You have successfully signed out');
    }


    public function adminForgotPasswordTemp () {
        return view('admin.login.forgot_password');
    }
    
    /**
     * * FOR TEST PURPOSES
     */
    public function test() {
        //return view('products.index2', ['products' => $products]);
        #$products = Product::all();
        #$products = Product::paginate(5); // get paginated records

        return view('products.test');
    }
}
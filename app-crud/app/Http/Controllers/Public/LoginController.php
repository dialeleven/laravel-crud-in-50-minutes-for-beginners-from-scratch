<?php
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller; // Import the base Controller class
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import Hash facade to bcrypt hash password
use Illuminate\Support\Facades\Auth;
use App\Models\User; // import our User model (MySQL table: users)

use Illuminate\Support\Facades\Response; // ? still needed


class LoginController extends Controller
{
    // admin site - show login form
    public function publicsiteLoginForm() {
        //return view('login.index', ['products' => $products]);
        return view('publicsite.login.index');
    }

    // admin site - process publicsite login user/pass
    public function publicsiteLoginProcess(Request $request)
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
            
            // redirect to public homepage
            return redirect()->route('publicsite.index')->with('success', 'Welcome back!');
        }

        // authentication failed, redirect back with errors
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records',
        ]);
    }


    // log user out of public site
    public function publicsiteLogout(Request $request) {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'You have successfully signed out');
    }


    public function publicsiteForgotPasswordTemp () {
        return view('publicsite.login.forgot_password');
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
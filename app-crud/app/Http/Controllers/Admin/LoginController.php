<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Import the base Controller class
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import Hash facade to bcrypt hash password
use Illuminate\Support\Facades\Auth;
use App\Models\Admin; // import our Admin model (MySQL table: admins)

use Illuminate\Support\Facades\Response; // ? still needed

#use Illuminate\Support\Facades\DB;      // DB facade for traditional style SQL queries
#use Illuminate\Database\Eloquent\Model; // Eloquent ORM DB model

#use App\Models\Login;


class LoginController extends Controller
{
    // admin site - show login form
    public function adminloginLoginForm() {
        //return view('login.index', ['products' => $products]);
        return view('admin.login.index');
    }

    // admin site - process admin login user/pass
    public function adminloginProcess(Request $request)
    {
        // dd($request);

        // validate form input
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // verify user/pass match in db
        if ( Auth::attempt([ 'email' => $data['email'], 'password' => $data['password'] ]) )
        // if ( Auth::attempt([ $data ]) )
        {
            // regenerate session token after successful login to prevent session fixation attack
            request()->session()->regenerate();
            
            // redirect to admin dashboard
            return redirect()->route('product.index')->with('success', 'Welcome back!');
        }

        // authentication failed, redirect back with errors
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records',
        ]);
    }


    public function adminloginLogout() {

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
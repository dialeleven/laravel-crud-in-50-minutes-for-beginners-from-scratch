<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Import the base Controller class
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;

#use Illuminate\Support\Facades\DB;      // DB facade for traditional style SQL queries
#use Illuminate\Database\Eloquent\Model; // Eloquent ORM DB model

#use App\Models\Login;
//use App\Models\User;


class LoginController extends Controller
{
    /**
     * login index
     */
    public function adminlogin() {
        //return view('login.index', ['products' => $products]);
        return view('admin.login.index');
    }

    public function adminloginProcess(Request $request) {
        dd($request);
        //return view('login.index');
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
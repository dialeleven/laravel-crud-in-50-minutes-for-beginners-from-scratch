<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Import the base Controller class
use Illuminate\Http\Request;

//--------- App Models ---------------//
use App\Models\Common\Product;
use App\Models\AdminSite\Admin;

class AdminsiteController extends Controller
{
    // adminsite dashboard (home page)
    public function index() {
        $total_products = Product::count(); // get total products
        $total_adminusers = Admin::count(); // get total adminusers

        //return view('adminsite.index', ['total_products' => $total_products, 'total_admins' => $total_admins]);
        return view('admin.index', compact('total_products', 'total_adminusers'));
    }
}

<?php
namespace App\Http\Controllers\Public; // ! ensure the namespace reflects the directory structure

use App\Http\Controllers\Controller; // ! Import the base Controller class
use Illuminate\Http\Request;

use App\Models\Common\Product;

class PublicProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        $total_products = Product::count();
        return view('public.products.index', ['products' => $products, 'total_products' => $total_products]);
    }
}

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
        return view('public.products.index', ['products' => $products]);
    }
}

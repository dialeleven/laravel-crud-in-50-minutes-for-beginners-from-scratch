<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        // dump and die function to dump the $request data to the browser
        //dd('description: ' . $request->description);
        //dd($request);
        
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|decimal:0,2', // min 0, max 2 decimal places
            'description' => 'required',
        ]);

        // save request data to database
        $newProduct = Product::create($data);

        // redirect to product index page after
        return redirect(route('product.index'));
    }

    public function edit(Product $product) {
        
    }
}

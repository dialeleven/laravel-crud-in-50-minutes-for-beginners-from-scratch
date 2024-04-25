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
        //dd(\Route::getRoutes());
        //dd($product);

        /*
        Return the view with the $product data. Note that 'products.edit' follows the naming convention
        of our directory structure:

        If edit.blade.php is in resources/views/products/, then we have 'products' to reflect the 
        /products/ directory and 'edit' represents the name of the specific view file.
        */
        return view('products.edit', ['product' => $product]);
    }

    public function update(Product $product, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|decimal:0,2', // min 0, max 2 decimal places
            'description' => 'required',
        ]);

        $product->update($data);

        return redirect(route('product.index'))->with('success', 'Product updated successfully');
    }
}

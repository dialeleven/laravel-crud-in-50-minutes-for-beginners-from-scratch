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

    // hyperlink to create product
    public function create() {
        return view('products.create');
    }

    /**
     * Store the product
     */
    public function store(Request $request) {
        // dump and die function to dump the $request data to the browser
        //dd('description: ' . $request->description);
        //dd($request);
        
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|decimal:0,2', // min 0, max 2 decimal places
            'description' => 'required',
            'image' => 'nullable|image|max:2048', // Image field is now optional with maximum size of 2MB
        ]);

        // If an image is provided, handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        // save request data to database
        $newProduct = Product::create($data);

        // redirect to product index page after
        //return redirect(route('product.index'));
        return redirect(route('product.index'))->with('success', 'Product added successfully');
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

    public function destroy(Product $product) {
        $product->delete();

        return redirect(route('product.index'))->with('success', 'Product deleted successfully');
    }
}

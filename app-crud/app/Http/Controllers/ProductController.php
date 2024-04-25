<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    public function index() {
        return view('products.index');
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
            'price' => 'required|decimal:2', // 2 decimal places
            'description' => 'required',
        ]);

        // save request data to database
        $newProduct = Product::create($data);

        // redirect to product index page after
        return redirect(route('product.index'));

    }
}

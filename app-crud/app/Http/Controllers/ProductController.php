<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

// need the following two "use" keywords for Intervention Image library
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
//-----------------

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
            'description' => 'nullable',
            'image' => 'nullable|image|max:2048', // Image field is now optional with maximum size of 2MB
        ]);

        // If an image is provided, handle the image upload
        if ($request->hasFile('image'))
        {
            /*
            # This will save the file using a unique ID as the filename (e.g. eDPjdMKbPCT0gvbpSnCJBKz15Ua8JQfJ8ExY5WZX.jpg)
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
            */

            // Retrieve the uploaded file
            $image = $request->file('image');
            
            // Get the original file name
            $original_filename = $image->getClientOriginalName();

            // Current timestamp
            $timestamp = date('Ymd_Hisu', time());

            // convert to lowercase with spaces replaced with underscore
            $filename = $timestamp . '_' . str_replace(' ', '_', strtolower($original_filename));
            
            // Store the uploaded file with the original file name
            $image->storeAs('images', $filename, 'public'); // Adjust storage path as needed


            // Check if file exists and resize image using Intervention Image (https://image.intervention.io/v2)
            if ($image && File::exists($image->getRealPath())) {
                // create Intervention Image - image manager with desired driver
                $manager = new ImageManager(new Driver());

                // read image from file system
                $thumbnail = $manager->read($image->getRealPath());

                // resize image proportionally to [N]px width
                #$thumbnail->scale(width: 100);

                // crop the best fitting 1:1 ratio (100x200) and resize to 200x200 pixel
                $thumbnail->cover(100, 100);
            }

            $thumbnail_path = 'app\public\thumbnails\\' . $filename;    // thumbnail path
            $thumbnail->save(storage_path($thumbnail_path));            // Save the thumbnail

            
            // Set the image path and filename in the request data
            $data['image'] = 'images/' . $filename;

            // set the thumbnail path and filename
            $data['thumbnail'] = 'thumbnails/' . $filename;
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
            'description' => 'nullable',
        ]);

        $product->update($data);

        return redirect(route('product.index'))->with('success', 'Product updated successfully');
    }


    public function destroy(Product $product)
    {
        // Delete the product's image if it exists
        if ($product->image)
        {
            // Get the full path to the image file
            $imagePath = public_path('storage/' . $product->image);

            // Check if the file exists
            if (file_exists($imagePath)) {
                try {
                    // Attempt to delete the image file
                    unlink($imagePath);
                } catch (\Exception $e) {
                    // Log deletion error
                    Log::error('Error deleting image: ' . $e->getMessage());
                }
            } else {
                // Log case where the file doesn't exist
                Log::warning('Image file not found: ' . $imagePath);
            }
        }

        // Delete the product
        $product->delete();

        return redirect(route('product.index'))->with('success', 'Product deleted successfully');
    }
}

<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Import the base Controller class

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;      // DB facade for traditional style SQL queries
use Illuminate\Database\Eloquent\Model; // Eloquent ORM DB model


// Import Intervention Image library for image functions (e.g. resizing fullsize img to thumbnail, crop, etc)
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


use App\Models\Common\Product; // ? Import 'Product' class from /app/Models to reference our Product model like Product::all() instead of
                                    // ? the fully qualified name '\App\Models\Product::all()'


class ProductController extends Controller
{
    // READ product list - view
    public function index(Request $request) {
        //$products = Product::all(); // get all DB records

        #dd($request->get);
        #dd($request);

        #$products = Product::paginate(5); // get paginated records

        $sort_column = $request->get('sort_by', 'id'); // default to sorting by ID
        $sort_direction = $request->get('sort_dir', 'asc'); // default to asc order

        $recs_per_page = config('app.pagination.recs_per_page');

        $products = Product::orderBy($sort_column, $sort_direction)->paginate($recs_per_page);

        
        return view('admin.products.index', ['products' => $products, 'sort_column' => $sort_column, 'sort_direction' => $sort_direction]);
    }


    // Products - export products to CSV file
    // Ref: https://stackoverflow.com/a/27596496/23343222
    public function indexExportCsv()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=export.csv',
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];

        $list = Product::all()->toArray();

        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));

        $callback = function() use ($list) 
        {
            $fh = fopen('php://output', 'w');
            foreach ($list as $row) { 
                fputcsv($fh, $row);
            }
            fclose($fh);
        };

        return response()->stream($callback, 200, $headers);
    }


    // CREATE product - view
    public function create() {
        return view('admin.products.create');
    }


    // CREATE product - POST request
    public function store(Request $request)
    {
        // dump and die function to dump the $request data to the browser
        //dd($request);
        #dd($request->input('datetime_in_stock'));

        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|decimal:0,2', // min 0, max 2 decimal places
            'description' => 'nullable',
            'datetime_in_stock' => 'nullable|date_format:Y-m-d\TH:i',
            'image' => 'nullable|image|max:2048', // Image field is now optional with maximum size of 2MB
        ]);

        if ($request->input('datetime_in_stock'))
            $data['datetime_in_stock'] = date('Y-m-d H:i:s', strtotime($request->input('datetime_in_stock')));

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

            // convert to lowercase with spaces replaced with underscore
            $filename = str_replace('.', '', microtime(true)) . '_' . str_replace(' ', '_', strtolower($original_filename));
            
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

                // crop the best fitting 1:1 ratio (100x100) and resize to 200x200 pixel
                $thumbnail->cover(100, 100);
            }

            $thumbnail_path = 'app\public\thumbnails\\' . $filename;    // thumbnail path
            $thumbnail->save(storage_path($thumbnail_path), quality: 80);            // Save the thumbnail

            
            // Set the image path and filename in the request data
            $data['image'] = 'images/' . $filename;

            // set the thumbnail path and filename
            $data['thumbnail'] = 'thumbnails/' . $filename;
        }

        // save request data to database
        $newProduct = Product::create($data);

        // redirect to product index page after
        //return redirect(route('products.index'));
        return redirect(route('products.index'))->with('success', 'Product added successfully');
    }

    
    // EDIT product - view
    public function edit(Product $product, Request $request) {
        //dd(\Route::getRoutes());
        //dd($product);
        #dd($request);

        $referer = request()->headers->get('referer');
        $page = null;
     
        // Extract the page number from the referer URL to store in hidden input 
        // to redirect user to pagination page they were on originally.
        if ($referer) {
           $url_parts = parse_url($referer);
        
           if (isset($url_parts['query'])) {
              
              parse_str($url_parts['query'], $query);
              //dd($query); // Debugging: Check the parsed query parameters
              $page = $query['page'] ?? null;
           }
        }

        /*
        Return the view with the $product data. Note that 'products.edit' follows the naming convention
        of our directory structure:

        If edit.blade.php is in resources/views/products/, then we have 'products' to reflect the 
        /products/ directory and 'edit' represents the name of the specific view file.
        */
        return view('admin.products.edit', ['product' => $product, 'page' => $page]);
    }

    
    // UPDATE product - POST request
    public function update(Product $product, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|decimal:0,2', // min 0, max 2 decimal places
            'description' => 'nullable',
            'datetime_in_stock' => 'nullable|date_format:Y-m-d\TH:i',
            'image' => 'nullable|image|max:2048', // Image field is now optional with maximum size of 2MB
        ]);

        #dd($product->image);

        // If an image is provided, handle the image upload
        if ($request->hasFile('image'))
        {
            // Retrieve the uploaded file
            $image = $request->file('image');
            
            // Get the original file name
            $original_filename = $image->getClientOriginalName();

            // convert to lowercase with spaces replaced with underscore
            $filename = str_replace('.', '', microtime(true)) . '_' . str_replace(' ', '_', strtolower($original_filename));
            
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

                // crop the best fitting 1:1 ratio (100x100) and resize to 200x200 pixel
                $thumbnail->cover(100, 100);
            }

            $thumbnail_path = 'app\public\thumbnails\\' . $filename;    // thumbnail path
            $thumbnail->save(storage_path($thumbnail_path), quality: 80);            // Save the thumbnail

            
            // Set the image path and filename in the request data
            $data['image'] = 'images/' . $filename;

            // set the thumbnail path and filename
            $data['thumbnail'] = 'thumbnails/' . $filename;

            
            // old image/thumb full paths for cleanup
            $old_image_path = 'public/' . $product->image;
            $old_thumbnail_path = 'public/' . $product->thumbnail;

            // delete old image
            try {
                if (Storage::exists($old_image_path))
                {
                    Storage::delete($old_image_path);
                    //echo "File deleted successfully using Storage::delete().";
                }
                else {
                    echo "File $old_image_path does not exist.";
                }
            } catch (\Exception $e) {
                echo "Error deleting file: " . $e->getMessage();
            }

            // delete old thumbnail
            try {
                if (Storage::exists($old_thumbnail_path))
                {
                    Storage::delete($old_thumbnail_path);
                    //echo "File deleted successfully using Storage::delete().";
                } else {
                    echo "File $old_image_path does not exist.";
                }
            } catch (\Exception $e) {
                echo "Error deleting file: " . $e->getMessage();
            }
        }
        

        // update request data to database
        $product->update($data);

        // get the current page number from the query parameters
        $current_page = $request->input('page', 1);

        return redirect(route('products.index', ['page' => $current_page]))->with('success', 'Product updated successfully');
    }


    // DELETE product - POST request
    public function destroy(Product $product, Request $request)
    {
        // Function to delete an image file
        function deleteImage($path)
        {
            if (file_exists($path)) {
                try {
                    unlink($path);
                } catch (\Exception $e) {
                    Log::error('Error deleting image: ' . $e->getMessage());
                }
            } else {
                Log::warning('Image file not found: ' . $path);
            }
        }


        // Delete the product's image if it exists
        if ($product->image)
        {
            // Get the full path to the image file
            $image_path = public_path('storage/' . $product->image);

            deleteImage($image_path);
        }

        // Delete the product's thumbnail if it exists
        if ($product->thumbnail)
        {
            // Get the full path to the thumbnail file
            $image_path = public_path('storage/' . $product->thumbnail);

            deleteImage($image_path);
        }

        // get the current page number from the query parameters
        $current_page = $request->input('page', 1);

        // get the total number of products before deletion
        $total_products = Product::count();

        // records per page
        $recs_per_page = config('app.pagination.recs_per_page');

        // get the total number of pages before deletion
        $total_pages = ceil($total_products / $recs_per_page);

        #dd($request);
        #dd($request->input('page'));

        // delete the product
        $product->delete();

        // get the total number of products after deletion
        $total_products = Product::count();

        // get the total number of pages after deletion
        $total_pages = ceil($total_products / $recs_per_page);

        // adjust the current page number if it exceeds the total number of pages
        if ($current_page > $total_pages) {
            $current_page = $total_pages;
        }

        return redirect(route('products.index', ['page' => $current_page]))->with('success', 'Product deleted successfully');
    }

    
    /**
     * * FOR TEST PURPOSES
     */
    public function test2() {
        //return view('products.index2', ['products' => $products]);
        #$products = Product::all();
        $products = Product::paginate(5); // get paginated records

        return view('admin.products.test2', ['products' => $products]);
    }
}
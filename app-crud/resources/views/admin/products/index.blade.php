{{-- FILE: resources/views/index.blade.php --}}


{{-- ******* The layout template to use (/resources/views/layouts/master.blade.php) *******--}}
{{-- @extends are the reusable components in a master template like your header/nav - e.g. master.blade.php  --}}
{{-- Here we specify to use /resources/views/master.blade.php as our master/app HTML layout template --}}
@extends('admin.site.layouts.master')


{{-- Define section of content in child view to be injected using `@yield` to 
     a layout or master template (e.g. master.blade.php). This is done using `@yield('section_name')`.
     Here we define a section of content called 'meta_title' to be used in the <title> tag only. --}}
@section('meta_title', 'Home Page')
@section('meta_description', 'My home page')
@section('meta_keywords', 'CRUD app, products page, create, read, update, delete')

@section('h1', 'Products')

{{-- `@section` & `@endsection` marks where your unique page content goes --}}
@section('content')
   <!--
    <div class="jumbotron">
        <h1>Welcome to Your Application</h1>
        <p>This is the home page content.</p>
    </div>
   -->

   <!-- create/export csv buttons -->
   <div class="mt-3 mb-4">
      <a href="{{ route('products.create') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mr-2 text-xs uppercase font-bold">Create Product</a>
      <a href="{{ route('products.index.exportcsv') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded text-xs uppercase font-bold">Export CSV</a>
   </div>
 
   <!-- pagination links - make sure controller is calling "Classname::paginate(X);"" -->
   {{ $products->links() }}

   {{-- output status message(s) if any --}}
   @include('admin.site.partials.form_status_output')
   
   {{-- form submission error output --}}
   @include('admin.site.partials.form_error_output')
   
 
   <!-- products table -->
   <div class="mt-2 mb-3">
      <table class="w-full border-collapse rounded-md overflow-hidden text-sm">
         <thead>
            <tr class="bg-gray-200">
               <th class="py-2 px-3 font-bold border-b border-gray-400 items-center">
                  <a href="{{ route('products.index', ['sort_by' => 'id', 'sort_dir' => ($sort_column == 'id' && $sort_direction == 'asc') ? 'desc' : 'asc']) }}" 
                     class="flex items-center">
                     ID
                     @if ($sort_column == 'id')
                        @if($sort_direction == 'asc')
                           &#9650; <!-- Upward arrow -->
                        @else
                           &#9660; <!-- Downward arrow -->
                        @endif
                     @else
                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-4 h-4 ml-1"><title>Sort</title><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41zm255-105L177 64c-9.4-9.4-24.6-9.4-33.9 0L24 183c-15.1 15.1-4.4 41 17 41h238c21.4 0 32.1-25.9 17-41z"/></svg>
                     @endif
                 </a>
               </th>
               <th class="py-2 px-3 font-bold border-b border-gray-400 items-center">
                  <a href="{{ route('products.index', ['sort_by' => 'name', 'sort_dir' => ($sort_column == 'name' && $sort_direction == 'asc') ? 'desc' : 'asc']) }}" 
                     class="flex items-center">
                     Name
                     @if ($sort_column == 'name')
                        @if($sort_direction == 'asc')
                           &#9650; <!-- Upward arrow -->
                        @else
                           &#9660; <!-- Downward arrow -->
                        @endif
                     @else
                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-4 h-4 ml-1"><title>Sort</title><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41zm255-105L177 64c-9.4-9.4-24.6-9.4-33.9 0L24 183c-15.1 15.1-4.4 41 17 41h238c21.4 0 32.1-25.9 17-41z"/></svg>
                     @endif
                 </a>
               </th>
               <th class="py-2 px-3 font-bold border-b border-gray-400 items-center">
                  <a href="{{ route('products.index', ['sort_by' => 'qty', 'sort_dir' => ($sort_column == 'qty' && $sort_direction == 'asc') ? 'desc' : 'asc']) }}" 
                     class="flex items-center">
                     Qty
                     @if ($sort_column == 'qty')
                        @if($sort_direction == 'asc')
                           &#9650; <!-- Upward arrow -->
                        @else
                           &#9660; <!-- Downward arrow -->
                        @endif
                     @else
                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-4 h-4 ml-1"><title>Sort</title><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41zm255-105L177 64c-9.4-9.4-24.6-9.4-33.9 0L24 183c-15.1 15.1-4.4 41 17 41h238c21.4 0 32.1-25.9 17-41z"/></svg>
                     @endif
                 </a>
               </th>
               <th class="py-2 px-3 font-bold border-b border-gray-400">Price</th>
               <th class="py-2 px-3 font-bold border-b border-gray-400 items-center">
                  <a href="{{ route('products.index', ['sort_by' => 'description', 'sort_dir' => ($sort_column == 'description' && $sort_direction == 'asc') ? 'desc' : 'asc']) }}" 
                     class="flex items-center">
                     Description
                     @if ($sort_column == 'description')
                        @if($sort_direction == 'asc')
                           &#9650; <!-- Upward arrow -->
                        @else
                           &#9660; <!-- Downward arrow -->
                        @endif
                     @else
                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-4 h-4 ml-1"><title>Sort</title><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41zm255-105L177 64c-9.4-9.4-24.6-9.4-33.9 0L24 183c-15.1 15.1-4.4 41 17 41h238c21.4 0 32.1-25.9 17-41z"/></svg>
                     @endif
                 </a>
               </th>
               <th class="py-2 px-3 font-bold border-b border-gray-400">Image</th>
               <th class="py-2 px-3 font-bold border-b border-gray-400">Edit</th>
               <th class="py-2 px-3 font-bold border-b border-gray-400">Delete</th>
            </tr>
         </thead>
         <tbody id="table-body">
         @foreach ($products as $index => $product)
            <tr class="odd:bg-white even:bg-gray-100 hover:bg-slate-200">
               <td class="py-2 px-3 border-b border-gray-400">{{ $product->id }}</td>
               <td class="py-2 px-3 border-b border-gray-400">{{ $product->name }}</td>
               <td class="py-2 px-3 border-b border-gray-400">{{ $product->qty }}</td>
               <td class="py-2 px-3 border-b border-gray-400">{{ $product->price }}</td>
               <td class="py-2 px-3 border-b border-gray-400">{{ $product->description }}</td>
               <td class="py-2 px-3 border-b border-gray-400 text-center">
               {{-- check if thumbnail file exists in /storage folder --}}
               @if ($product->thumbnail AND Storage::exists('/public/' . $product->thumbnail))
                  <a href="/storage/{{ $product->image }}" target="_blank">
                     <img src="{{ asset("/storage/{$product->thumbnail}") }}" width="50" height="50" alt="{{ $product->name }}">
                  </a>
               @endif
               </td>
               <td class="py-2 px-3 border-b border-gray-400 text-center">
                  <a href="{{ route('products.edit', ['product' => $product]) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded transition duration-300">Edit</a>
               </td>
               <td class="py-2 px-3 border-b border-gray-400 text-center">
                  <form method="POST" action="{{ route('products.destroy', ['product' => $product]) }}">
                  @csrf
                  @method('delete')
                  <button type="submit" class="inline-block bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded transition duration-300" onclick="return confirm('Delete {{ $product->name }}?')">Delete</button>
                  <input type="hidden" name="page" value="{{request()->query('page')}}">
                  </form>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
 
    {{-- output pagination below table if needed (e.g. current page rows > N) --}}
    @if ($products->count() >= 5)
       {{ $products->links() }}
    @endif
@endsection


{{-- `@push` and JavaScript above </body> tag needed for this page to the layout or master template referenced by @stack('stack_name_here') --}}
@push('scripts_body')
<script type="text/javascript">
   // Function to remove the status message after a timeout
   function removeSuccessMessage() {
     var successMessage = document.getElementById('successMessage');
     if (successMessage) {
       successMessage.style.opacity = '0';
       setTimeout(function() {
         successMessage.remove();
       }, 500); // Adjust timeout duration (in milliseconds) as needed
     }
   }

   // Call the function after a certain period (e.g., 3 seconds)
   setTimeout(removeSuccessMessage, 3000);
</script>
@endpush
{{-- FILE: resources/views/index.blade.php --}}


{{-- ******* The layout template to use (/resources/views/layouts/master.blade.php) *******--}}
{{-- @extends are the reusable components in a master template like your header/nav - e.g. master.blade.php  --}}
{{-- Here we specify to use /resources/views/master.blade.php as our master/app HTML layout template --}}
@extends('layouts.master')


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
   <div class="mt-3 mb-4 mt-0">
      <a href="{{ route('product.create') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mr-2 text-xs uppercase font-bold">Create Product</a>
      <a href="{{ route('product.index.exportcsv') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded text-xs uppercase font-bold">Export CSV</a>
   </div>
 
   <!-- pagination links - make sure controller is calling "Classname::paginate(X);"" -->
   {{ $products->links() }}

   {{-- output status message(s) if any --}}
   @if (@session()->has('success'))
   <div id="statusMessage" class="bg-green-300 py-1 px-4 rounded-md mt-2 mb-0">
      {{session('success')}}
   </div>
   @endif
 
   <!-- products table -->
   <div class="mt-2 mb-3">
      <table class="w-full border-collapse rounded-md overflow-hidden text-sm">
         <thead>
            <tr class="bg-gray-200">
               <th class="py-2 px-3 font-bold border-b border-gray-400">ID</th>
               <th class="py-2 px-3 font-bold border-b border-gray-400">Name</th>
               <th class="py-2 px-3 font-bold border-b border-gray-400">Qty</th>
               <th class="py-2 px-3 font-bold border-b border-gray-400">Price</th>
               <th class="py-2 px-3 font-bold border-b border-gray-400">Description</th>
               <th class="py-2 px-3 font-bold border-b border-gray-400">Image</th>
               <th class="py-2 px-3 font-bold border-b border-gray-400">Edit</th>
               <th class="py-2 px-3 font-bold border-b border-gray-400">Delete</th>
            </tr>
         </thead>
         <tbody id="table-body">
         @foreach ($products as $index => $product)
            <tr class="{{ $index % 2 === 0 ? 'bg-gray-100' : 'bg-white' }}">
               <td class="py-2 px-3 border-b border-gray-400">{{ $product->id }}</td>
               <td class="py-2 px-3 border-b border-gray-400">{{ $product->name }}</td>
               <td class="py-2 px-3 border-b border-gray-400">{{ $product->qty }}</td>
               <td class="py-2 px-3 border-b border-gray-400">{{ $product->price }}</td>
               <td class="py-2 px-3 border-b border-gray-400">{{ $product->description }}</td>
               <td class="py-2 px-3 border-b border-gray-400 text-center">
               @if ($product->thumbnail)
                  <a href="/storage/{{ $product->image }}" target="_blank">
                  <img src="/storage/{{ $product->thumbnail }}" width="50" height="50" alt="{{ $product->name }}">
                  </a>
               @else
                  <!--<a href="/storage/{{ $product->image }}" target="_blank"><i class="fa-solid fa-image" aria-label="display image" title="Image opens in new tab/window"></i></a>-->
               @endif
               </td>
               <td class="py-2 px-3 border-b border-gray-400 text-center">
                  <a href="{{ route('product.edit', ['product' => $product]) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded transition duration-300">Edit</a>
               </td>
               <td class="py-2 px-3 border-b border-gray-400 text-center">
                  <form method="POST" action="{{ route('product.destroy', ['product' => $product]) }}">
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
   function removeStatusMessage() {
     var statusMessage = document.getElementById('statusMessage');
     if (statusMessage) {
       statusMessage.style.opacity = '0';
       setTimeout(function() {
         statusMessage.remove();
       }, 500); // Adjust timeout duration (in milliseconds) as needed
     }
   }

   // Call the function after a certain period (e.g., 3 seconds)
   setTimeout(removeStatusMessage, 3000);
</script>
@endpush
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>CRUD App - Product Index</title>
   @vite('resources/css/app.css')
   <script>
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
</head>

<body class="p-5">

<div class="mx-auto max-w-4xl">

   <!-- header/logo -->
   @include('site.partials.header')

   <h1 class="text-3xl">Products</h1>

   <!-- create/export csv buttons -->
   <p class="mt-3 mb-4">
      <a href="{{ route('products.create') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mr-2 text-xs uppercase font-bold">Create Product</a>
      <a href="{{ route('products.index.exportcsv') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded text-xs uppercase font-bold">Export CSV</a>
   </p>

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
                  <a href="{{ route('products.edit', ['product' => $product]) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded transition duration-300">Edit</a>
               </td>
               <td class="py-2 px-3 border-b border-gray-400 text-center">
                  <form method="POST" action="{{ route('products.destroy', ['product' => $product]) }}">
                  @csrf
                  @method('delete')
                  <button type="submit" class="inline-block bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded transition duration-300" onclick="return confirm('Delete {{ $product->name }}?')">Delete</button>
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

   <div class="mt-4 text-xs text-gray-500">
      Current date/time: {{ date('Y-m-d H:i:s', time()) }}
   </div>
</div>

<!-- footer - style info -->
@include('site.partials.footer')

</body>
</html>
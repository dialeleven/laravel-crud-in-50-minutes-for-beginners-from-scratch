<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product Index</title>
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
   <div class="flex items-center p-2 mb-3 bg-gray-100 rounded-lg">
      <img src="{{asset('assets/images/crud_create_read_update_delete-1024.webp')}}" alt="CRUD App" class="w-10 h-auto mr-2 rounded">
      <span class="text-lg font-semibold text-gray-800">
         <span style="color: #3490dc">C</span><span style="color: #38a169">R</span><span style="color: #6d28d9">U</span><span style="color: #e53e3e">D</span>
         App
      </span>
   </div>

   <h1 class="text-3xl">Products</h1>

   <p class="mt-4 mb-4">
      <a href="{{ route('product.create') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mr-3 text-xs uppercase font-bold">Create Product</a>
      <a href="{{ route('product.index.exportcsv') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded text-xs uppercase font-bold">Export CSV</a>
   </p>

   <!-- pagination links - make sure controller is calling "Classname::paginate(X);"" -->
   {{ $products->links() }}

   {{-- output status message(s) if any --}}
   @if (@session()->has('success'))
   <div id="statusMessage" class="bg-green-300 py-1 px-4 rounded-md mt-2 mb-0">
      {{session('success')}}
   </div>
   @endif

   <div class="mt-4">
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
                  <a href="/storage/{{ $product->image }}" target="_blank"><i class="fa-solid fa-image" aria-label="display image" title="Image opens in new tab/window"></i></a>
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
                  </form>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>

   <div class="mt-4 text-xs text-gray-500">
      Current date/time: {{ date('Y-m-d H:i:s', time()) }}
   </div>
</div>

<div class="flex flex-col items-center justify-center mt-5">
   <div class="text-center text-xs uppercase text-gray-300">
      Page Styled Using
   </div>
   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 54 33" class="w-10 h-10 mt-1">
      <title>Tailwind CSS</title>
      <g clip-path="url(#prefix__clip0)">
         <path fill="#38bdf8" fill-rule="evenodd" d="M27 0c-7.2 0-11.7 3.6-13.5 10.8 2.7-3.6 5.85-4.95 9.45-4.05 2.054.513 3.522 2.004 5.147 3.653C30.744 13.09 33.808 16.2 40.5 16.2c7.2 0 11.7-3.6 13.5-10.8-2.7 3.6-5.85 4.95-9.45 4.05-2.054-.513-3.522-2.004-5.147-3.653C36.756 3.11 33.692 0 27 0zM13.5 16.2C6.3 16.2 1.8 19.8 0 27c2.7-3.6 5.85-4.95 9.45-4.05 2.054.514 3.522 2.004 5.147 3.653C17.244 29.29 20.308 32.4 27 32.4c7.2 0 11.7-3.6 13.5-10.8-2.7 3.6-5.85 4.95-9.45 4.05-2.054-.513-3.522-2.004-5.147-3.653C23.256 19.31 20.192 16.2 13.5 16.2z" clip-rule="evenodd"/>
      </g>
      <defs>
         <clipPath id="prefix__clip0">
            <path fill="#fff" d="M0 0h54v32.4H0z"/>
         </clipPath>
      </defs>
   </svg>
</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Product</title>
   @vite('resources/css/app.css')
</head>

<body class="p-5">
   
   <form method="post" action="{{route('product.update', ['product' => $product])}}" enctype="multipart/form-data" class="max-w-md mx-auto text-sm border p-4 rounded-lg shadow-md">
   @csrf
   @method('put')
   <h1 class="text-3xl mb-4">Edit Product</h1>

   <div class="mb-3">
      @if ($errors->any())
      <ul class="error-list">
         @foreach($errors->all() as $error)
            @php
            // extract input name/id from error message
            preg_match('/^The (.*?) field/i', $error, $matches);
            $inputNameOrId = $matches[1] ?? '';
            @endphp
            <li class="error-list-item flex items-center bg-red-100 rounded-sm p-1">
               <span class="text-red-500 font-bold mr-2">X</span>
               <a href="#{{ $inputNameOrId }}" class="underline">{{$error}}</a>
            </li>
         @endforeach
      </ul>
      @endif
   </div>
   <div class="mb-4">
      <label class="block mb-1">Name</label>
      <input type="text" id="name" name="name" value="{{old('name')}}" class="w-full border border-gray-300 rounded px-3 py-2">
   </div>
   <div class="mb-4">
      <label class="block mb-1">Quantity</label>
      <input type="text" id="qty" name="qty" value="{{old('qty')}}" class="w-full border border-gray-300 rounded px-3 py-2">
   </div>
   <div class="mb-4">
      <label class="block mb-1">Price</label>
      <input type="text" id="price" name="price" value="{{old('price')}}" class="w-full border border-gray-300 rounded px-3 py-2">
   </div>
   <div class="mb-4">
      <label class="block mb-1">Description</label>
      <input type="text" id="description" name="description" value="{{old('description')}}" class="w-full border border-gray-300 rounded px-3 py-2">
   </div>
   <div class="mb-4">
      <label class="block mb-1">Image</label>
      <input type="file" name="image" class="w-full">
   </div>
   <div class="mb-4">
      <input type="submit" value="Update" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded transition duration-300 cursor-pointer">
      <input type="button" value="Cancel" class="inline-block bg-gray-500 hover:bg-gray-600 text-white py-1 px-3 rounded transition duration-300 cursor-pointer" onclick="location.href='{{route('product.index')}}';">
   </div>
</form>

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
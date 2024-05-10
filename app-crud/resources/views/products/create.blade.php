<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Create Product</title>
   @vite('resources/css/app.css')
</head>

<body class="p-5">
   
<form method="post" action="{{route('product.store')}}" enctype="multipart/form-data" class="max-w-md mx-auto text-sm border p-4 rounded-lg shadow-md">
   @csrf
   @method('post')
   
   <!-- header/logo -->
   @include('site.partials.header')

   <h1 class="text-3xl mb-4">Create Product</h1>
   
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
         <input type="submit" value="Save" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded transition duration-300 cursor-pointer">
         <input type="button" value="Cancel" class="inline-block bg-gray-500 hover:bg-gray-600 text-white py-1 px-3 rounded transition duration-300 cursor-pointer" onclick="location.href='{{route('product.index')}}';">
   </div>
</form>


<!-- footer - style info -->
@include('site.partials.footer')

</body>
</html>
{{-- FILE: resources/views/edit.blade.php --}}


{{-- ******* The layout template to use (/resources/views/layouts/master.blade.php) *******--}}
{{-- @extends are the reusable components in a master template like your header/nav - e.g. master.blade.php  --}}
{{-- Here we specify to use /resources/views/master.blade.php as our master/app HTML layout template --}}
@extends('admin.site.layouts.master')


{{-- Define section of content in child view to be injected using `@yield` to 
     a layout or master template (e.g. master.blade.php). This is done using `@yield('section_name')`.
     Here we define a section of content called 'meta_title' to be used in the <title> tag only. --}}
@section('meta_title', 'Edit Product')
@section('meta_description', '')
@section('meta_keywords', '')

@section('h1', 'Edit Product')


{{-- `@section` & `@endsection` marks where your unique page content goes --}}
@section('content')
<form method="post" action="{{route('products.update', ['product' => $product])}}" enctype="multipart/form-data" class="max-w-xl text-sm border p-4 rounded-md shadow">
   @csrf
   @method('put')

   {{-- form submission error output --}}
   @include('admin.site.partials.form_error_output')

   <div class="mb-4">
      <label class="block mb-1">Name</label>
      <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="w-full border border-gray-300 rounded px-3 py-2">
   </div>
   <div class="mb-4">
      <label class="block mb-1">Quantity</label>
      <input type="text" id="qty" name="qty" value="{{ old('qty', $product->qty) }}" class="w-full border border-gray-300 rounded px-3 py-2">
   </div>
   <div class="mb-4">
      <label class="block mb-1">Price</label>
      <input type="text" id="price" name="price" value="{{ old('price', $product->price) }}" class="w-full border border-gray-300 rounded px-3 py-2">
   </div>
   <div class="mb-4">
      <label class="block mb-1">Description</label>
      <input type="text" id="description" name="description" value="{{ old('description', $product->description) }}" class="w-full border border-gray-300 rounded px-3 py-2">
   </div>
   <div class="mb-4">
      <label class="block mb-1">Date - In Stock</label>
      <input type="datetime-local" id="datetime_in_stock" name="datetime_in_stock" min="" max="" value="{{old('datetime_in_stock', $product->datetime_in_stock)}}" class="border border-gray-300 rounded px-3 py-2">
   </div>
   <div class="mb-4">
      <label class="block mb-1">Image</label>
      <input type="file" name="image" class="w-full">
   </div>
   <div class="mb-4">
      <input type="hidden" name="page" value="{{ old('page', $page ) }}">
      <input type="submit" value="Update" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded transition duration-300 cursor-pointer">
      <input type="button" value="Cancel" class="inline-block bg-gray-500 hover:bg-gray-600 text-white py-1 px-3 rounded transition duration-300 cursor-pointer" onclick="location.href='{{route('products.index')}}';">
   </div>
</form>
@endsection
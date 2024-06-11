{{-- ******* The layout template to use (/resources/views/layouts/master.blade.php) *******--}}
{{-- @extends are the reusable components in a master template like your header/nav - e.g. master.blade.php  --}}
{{-- Here we specify to use /resources/views/master.blade.php as our master/app HTML layout template --}}
@extends('admin.site.layouts.master')


{{-- Define section of content in child view to be injected using `@yield` to 
     a layout or master template (e.g. master.blade.php). This is done using `@yield('section_name')`.
     Here we define a section of content called 'meta_title' to be used in the <title> tag only. --}}
@section('meta_title', 'Admin Dashboard')
{{--
@section('meta_description', '')
@section('meta_keywords', '')
--}}

@section('h1', 'Admin Dashboard')


{{-- `@section` alone or `@section`+`@endsection` marks where your unique page content goes --}}
@section('content')

{{-- form submission error output --}}
@include('admin.site.partials.form_error_output')

Welcome to the Admin Dashboard, <b>{{ Auth::user()->name }}</b>! {{-- (role_id: {{ Auth::user()->role_id }}) --}}

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-5">

   <div class="bg-blue-100 to-white p-6 rounded-lg shadow-md border border-gray-300">
      <h2 class="text-xl font-semibold mb-2">Products</h2>
      <p class="text-gray-700 mb-4">
         {{ $total_products }} Product{{ $total_products > 1 ? 's' : '' }}
      </p>
      <a href="{{ route('products.index') }}" class="text-blue-500 hover:underline">View Products</a>
   </div>

   <div class="bg-purple-100 p-6 rounded-lg shadow-md border border-gray-300">
      <h2 class="text-xl font-semibold mb-2">Admin Users</h2>
      <p class="text-gray-700 mb-4">{{ $total_adminusers }} Admin User{{ $total_adminusers > 1 ? 's' : '' }}</p>
      <a href="{{ route('adminusers.index') }}" class="text-blue-500 hover:underline">View Admin Users</a>
   </div>

   <div class="bg-green-100 p-6 rounded-lg shadow-md border border-gray-300">
      <h2 class="text-xl font-semibold mb-2">Future Module</h2>
      <p class="text-gray-700 mb-4">X Widgets</p>
      <a href="#" class="text-blue-500 hover:underline">View Widgets</a>
   </div>

   <div class="bg-orange-100 p-6 rounded-lg shadow-md border border-gray-300">
      <h2 class="text-xl font-semibold mb-2">Future Module</h2>
      <p class="text-gray-700 mb-4">X Widgets</p>
      <a href="#" class="text-blue-500 hover:underline">View Widgets</a>
   </div>

   <div class="bg-red-100 p-6 rounded-lg shadow-md border border-gray-300">
      <h2 class="text-xl font-semibold mb-2">Future Module</h2>
      <p class="text-gray-700 mb-4">X Widgets</p>
      <a href="#" class="text-blue-500 hover:underline">View Widgets</a>
   </div>

   <div class="bg-yellow-100 p-6 rounded-lg shadow-md border border-gray-300">
      <h2 class="text-xl font-semibold mb-2">Future Module</h2>
      <p class="text-gray-700 mb-4">X Widgets</p>
      <a href="#" class="text-blue-500 hover:underline">View Widgets</a>
   </div>
 
 </div>
@endsection

@push('scripts_body')
@endpush
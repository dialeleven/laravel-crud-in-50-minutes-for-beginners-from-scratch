{{-- FILE: resources/views/create.blade.php --}}


{{-- ******* The layout template to use (/resources/views/layouts/master.blade.php) *******--}}
{{-- @extends are the reusable components in a master template like your header/nav - e.g. master.blade.php  --}}
{{-- Here we specify to use /resources/views/master.blade.php as our master/app HTML layout template --}}
@extends('admin.site.layouts.master')


{{-- Define section of content in child view to be injected using `@yield` to 
     a layout or master template (e.g. master.blade.php). This is done using `@yield('section_name')`.
     Here we define a section of content called 'meta_title' to be used in the <title> tag only. --}}
@section('meta_title', 'Add User')
{{--
@section('meta_description', '')
@section('meta_keywords', '')
--}}

@section('h1', 'Add User')


{{-- `@section` alone or `@section`+`@endsection` marks where your unique page content goes --}}
@section('content')
   
<form method="post" action="{{ route('adminusers.store') }}" enctype="multipart/form-data" class="max-w-xl text-sm border p-4 rounded-md shadow">
   @csrf
   @method('post')
   
   {{-- form submission error output --}}
   @include('admin.site.partials.form_error_output')

   <div class="mb-4">
      <label class="block mb-1">Username</label>
      <input type="text" id="username" name="username" value="{{old('username')}}" class="w-full border border-gray-300 rounded px-3 py-2">
   </div>
   <div class="mb-4">
      <label class="block mb-1">Name</label>
      <input type="text" id="name" name="name" value="{{old('name')}}" class="w-full border border-gray-300 rounded px-3 py-2">
   </div>
   <div class="mb-4">
      <label class="block mb-1">Email</label>
      <input type="text" id="email" name="email" value="{{old('email')}}" class="w-full border border-gray-300 rounded px-3 py-2">
   </div>
   <div class="mb-4">
      <label class="block mb-1">Role</label>
      <input type="radio" id="role_superadmin" name="role" value="superadmin" @if(old('role', 'superadmin') == 'superadmin') checked @endif class="mr-1 border border-gray-300 rounded px-3 py-2">
      <label for="role_superadmin" class="mr-4">Superadmin</label>

      <input type="radio" id="role_admin" name="role" value="admin" @if(old('accountstatus') == 'admin') checked @endif class="mr-1 border border-gray-300 rounded px-3 py-2">
      <label for="role_admin" class="mr-4">Admin</label>

      <input type="radio" id="role_user" name="role" value="user" @if(old('accountstatus') == 'user') checked @endif class="border border-gray-300 rounded px-3 py-2">
      <label for="role_user" class="mr-4">User</label>
   </div>
   <div class="mb-4">
      <label class="block mb-1">Account Status</label>
      <div class="flex items-center">
         <input type="radio" id="accountstatus_active" name="accountstatus" value="active" @if(old('accountstatus', 'active') == 'active') checked @endif class="mr-1">
         <label for="active" class="mr-4">Active</label>
         
         <input type="radio" id="accountstatus_inactive" name="accountstatus" value="inactive" @if(old('accountstatus') == 'inactive') checked @endif class="mr-1">
         <label for="inactive">Inactive</label>
      </div>
   </div>
   <div class="mb-4">
      <input type="submit" value="Save" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded transition duration-300 cursor-pointer">
      <input type="button" value="Cancel" class="inline-block bg-gray-500 hover:bg-gray-600 text-white py-1 px-3 rounded transition duration-300 cursor-pointer" onclick="location.href='{{route('adminusers.index')}}';">
   </div>
</form>
@endsection
{{-- FILE: resources/views/create.blade.php --}}


{{-- ******* The layout template to use (/resources/views/layouts/master.blade.php) *******--}}
{{-- @extends are the reusable components in a master template like your header/nav - e.g. master.blade.php  --}}
{{-- Here we specify to use /resources/views/master.blade.php as our master/app HTML layout template --}}
@extends('admin.site.layouts.master')


{{-- Define section of content in child view to be injected using `@yield` to 
     a layout or master template (e.g. master.blade.php). This is done using `@yield('section_name')`.
     Here we define a section of content called 'meta_title' to be used in the <title> tag only. --}}
@section('meta_title', 'Edit User')
{{--
@section('meta_description', '')
@section('meta_keywords', '')
--}}

@section('h1', 'Edit User')


{{-- `@section` alone or `@section`+`@endsection` marks where your unique page content goes --}}
@section('content')
   
<form method="post" action="{{ route('adminusers.store') }}" enctype="multipart/form-data" class="max-w-xl text-sm border p-4 rounded-md shadow">
   @csrf
   @method('post')
   
   {{-- form submission error output --}}
   @include('admin.site.partials.form_error_output')

   <div class="mb-4">
      <label class="block mb-1">Username</label>
      <input type="text" id="username" name="username" value="{{old('username', $adminuser->username)}}" class="w-full border border-gray-300 rounded px-3 py-2">
   </div>
   <div class="mb-4">
      <label class="block mb-1">Password</label>
      <input type="password" id="password" name="password" value="{{old('password')}}" class="w-full border border-gray-300 rounded px-3 py-2">
   </div>
   <div class="mb-4">
      <label class="block mb-1">Name</label>
      <input type="text" id="name" name="name" value="{{old('name', $adminuser->name)}}" class="w-full border border-gray-300 rounded px-3 py-2">
   </div>
   <div class="mb-4">
      <label class="block mb-1">Email</label>
      <input type="email" id="email" name="email" required value="{{old('email', $adminuser->email)}}" class="w-full border border-gray-300 rounded px-3 py-2">
   </div>
   <div class="mb-4">
      <label class="block mb-1">Role</label>
      <input type="radio" id="role_user" name="role_id" value="3" @if(old('role_id', $adminuser->role_id == 3)) checked @endif class="border border-gray-300 rounded px-3 py-2 cursor-pointer">
      <label for="role_user" class="mr-4 cursor-pointer">User</label>

      <input type="radio" id="role_admin" name="role_id" value="2" @if(old('role_id', $adminuser->role_id == 2)) checked @endif class="mr-1 border border-gray-300 rounded px-3 py-2 cursor-pointer">
      <label for="role_admin" class="mr-4 cursor-pointer">Admin</label>

      <input type="radio" id="role_superadmin" name="role_id" value="1" @if(old('role_id', $adminuser->role_id == 1)) checked @endif class="mr-1 border border-gray-300 rounded px-3 py-2 cursor-pointer">
      <label for="role_superadmin" class="mr-4 cursor-pointer">Superadmin</label>
   </div>
   <div class="mb-4">
      <label class="block mb-1">Account Status</label>
      <div class="flex items-center">
         <input type="radio" id="account_active_active" name="account_active" value="1" @if(old('account_active', $adminuser->account_active == 1)) checked @endif class="mr-1 cursor-pointer">
         <label for="account_active_active" class="mr-4 cursor-pointer">Active</label>
         
         <input type="radio" id="account_active_inactive" name="account_active" value="0" @if(old('account_active', $adminuser->account_active === 0)) checked @endif class="mr-1 cursor-pointer">
         <label for="account_active_inactive" class="cursor-pointer">Inactive</label>
      </div>
   </div>
   <div class="mb-4">
      <input type="submit" value="Save" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded transition duration-300 cursor-pointer">
      <input type="button" value="Cancel" class="inline-block bg-gray-500 hover:bg-gray-600 text-white py-1 px-3 rounded transition duration-300 cursor-pointer" onclick="location.href='{{route('adminusers.index')}}';">
   </div>
</form>
@endsection
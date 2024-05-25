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
      <label class="block mb-1">Password</label>
      <div class="relative">
         <input
           id="password"
           name="password"
           type="password"
           required
           class="w-full rounded-md p-4 pe-12 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300  focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
         />
 
         <span id="togglePassword" class="absolute inset-y-0 end-0 grid place-content-center px-4 cursor-pointer">
           <svg
             xmlns="http://www.w3.org/2000/svg"
             class="size-4 text-gray-400"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor"
             
           >
             <title>Show/hide password</title>
             <path
               stroke-linecap="round"
               stroke-linejoin="round"
               stroke-width="2"
               d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
             />
             <path
               stroke-linecap="round"
               stroke-linejoin="round"
               stroke-width="2"
               d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
             />
           </svg>
         </span>
      </div>
   </div>
   <div class="mb-4">
      <label class="block mb-1">Name</label>
      <input type="text" id="name" name="name" value="{{old('name')}}" class="w-full border border-gray-300 rounded px-3 py-2">
   </div>
   <div class="mb-4">
      <label class="block mb-1">Email</label>
      <input type="email" id="email" name="email" required value="{{old('email')}}" class="w-full border border-gray-300 rounded px-3 py-2">
   </div>
   <div class="mb-4">
      <label class="block mb-1">Role</label>
      <input type="radio" id="role_user" name="role_id" value="3" @if(old('role_id', '3') == '3') checked @endif class="border border-gray-300 rounded px-3 py-2 cursor-pointer">
      <label for="role_user" class="mr-4 cursor-pointer">User</label>

      <input type="radio" id="role_admin" name="role_id" value="2" @if(old('role_id') == '2') checked @endif class="mr-1 border border-gray-300 rounded px-3 py-2 cursor-pointer">
      <label for="role_admin" class="mr-4 cursor-pointer">Admin</label>

      <input type="radio" id="role_superadmin" name="role_id" value="1" @if(old('role_id') == '1') checked @endif class="mr-1 border border-gray-300 rounded px-3 py-2 cursor-pointer">
      <label for="role_superadmin" class="mr-4 cursor-pointer">Superadmin</label>
   </div>
   <div class="mb-4">
      <label class="block mb-1">Account Status</label>
      <div class="flex items-center">
         <input type="radio" id="account_active_active" name="account_active" value="1" @if(old('account_active', '1') == 1) checked @endif class="mr-1 cursor-pointer">
         <label for="account_active_active" class="mr-4 cursor-pointer">Active</label>
         
         <input type="radio" id="account_active_inactive" name="account_active" value="0" @if(old('account_active') === 0) checked @endif class="mr-1 cursor-pointer">
         <label for="account_active_inactive" class="cursor-pointer">Inactive</label>
      </div>
   </div>
   <div class="mb-4">
      <input type="submit" value="Save" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded transition duration-300 cursor-pointer">
      <input type="button" value="Cancel" class="inline-block bg-gray-500 hover:bg-gray-600 text-white py-1 px-3 rounded transition duration-300 cursor-pointer" onclick="location.href='{{route('adminusers.index')}}';">
   </div>
</form>
@endsection

@push('scripts_body')
<script>
   const togglePassword = document.getElementById('togglePassword');
   const passwordInput = document.getElementById('password');
 
   togglePassword.addEventListener('click', function() {
     const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
     passwordInput.setAttribute('type', type);
     // Change eye icon color on toggle
     this.querySelector('svg').classList.toggle('text-gray-400');
     this.querySelector('svg').classList.toggle('text-gray-600');
   });
 </script>
@endpush
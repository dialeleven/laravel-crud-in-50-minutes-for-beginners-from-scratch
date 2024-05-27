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
Welcome to the Admin Dashboard, <b>{{ Auth::user()->name }}</b> (role_id: {{ Auth::user()->role_id }})!
{{Auth::user()->role_name}}
@endsection
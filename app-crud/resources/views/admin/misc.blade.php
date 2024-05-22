{{-- ******* The layout template to use (/resources/views/layouts/master.blade.php) *******--}}
{{-- @extends are the reusable components in a master template like your header/nav - e.g. master.blade.php  --}}
{{-- Here we specify to use /resources/views/master.blade.php as our master/app HTML layout template --}}
@extends('admin.site.layouts.master')


{{-- Define section of content in child view to be injected using `@yield` to 
     a layout or master template (e.g. master.blade.php). This is done using `@yield('section_name')`.
     Here we define a section of content called 'meta_title' to be used in the <title> tag only. --}}
@section('meta_title', 'Miscellaneous')
{{--
@section('meta_description', '')
@section('meta_keywords', '')
--}}

@section('h1', 'Miscellaneous')


{{-- `@section` alone or `@section`+`@endsection` marks where your unique page content goes --}}
@section('content')
   
<h2 class="text-lg font-semibold">Other Functionality Developed</h2>
<ul class="list-disc pl-5">
    <li class="flex items-center">
        <span class="inline-block w-1 h-1 rounded-full bg-black mr-2"></span>
        <a href="/email-with-attachment" target="_blank" class="text-blue-500 hover:underline">/email-with-attachment</a>&nbsp;
        (requires editing web.php)
    </li>
    <li class="flex items-center">
        <span class="inline-block w-1 h-1 rounded-full bg-black mr-2"></span>
        <a href="/email-with-attachment" target="_blank" class="text-blue-500 hover:underline">/email-with-cc-bcc</a>&nbsp;(CC/BCC bugged)
    </li>
</ul>

@endsection
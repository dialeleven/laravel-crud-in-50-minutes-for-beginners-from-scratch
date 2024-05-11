<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>CRUD APP - @yield('title', 'INSERT PAGE NAME using @section(\'title\', \'Home Page\')')</title>
   @vite('resources/css/app.css')
   {{-- leave a blank line for HTML source formatting (Laravel comment is fine) --}}
</head>

<body class="p-5">

<div class="mx-auto max-w-4xl">

   <!-- header/logo -->
   <div class="flex items-center p-2 mb-3 bg-gray-100 rounded-lg shadow-md">
      <!--<img src="{{asset('assets/images/crud_create_read_update_delete-1024.webp')}}" alt="CRUD App" class="w-10 h-auto mr-2 rounded">-->
      <img src="{{asset('assets/images/android-chrome-512x512.png')}}" alt="CRUD App" class="w-10 h-auto mr-2 shadow">
      
      <span class="text-lg font-semibold text-gray-400">
         <span class="text-green-600">C</span><span class="text-green-600">R</span><span class="text-green-600">U</span><span class="text-green-600">D</span>
         <span class="">APP</span>
      </span>
   </div>
   

   {{-- ! @yield('content') - content goes below (@yield is the unique content that is not meant to be reusable. --}}
   @yield('content')


   <div class="mt-4 text-xs text-gray-500">
      Current date/time: {{ date('Y-m-d H:i:s', time()) }}
   </div>
</div>

<!-- footer - style info -->
<div class="flex flex-col items-center justify-center mt-5">
   <div class="text-center text-xs uppercase text-gray-300">
      UI Styled Using
   </div>
   <a href="https://tailwindcss.com/docs/installation" target="_blank" rel="noopener noreferrer" class="">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 54 33" class="w-10 h-10">
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
   </a>
</div>


{{-- any non-essential JavaScript code to load using `@push` (used in child view) and `@stack (used in layout or master template) --}}
@stack('scripts_body')

</body>
</html>
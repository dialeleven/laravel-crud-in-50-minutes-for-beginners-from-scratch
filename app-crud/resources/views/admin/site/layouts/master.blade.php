<!DOCTYPE html>
<html lang="en">
<head>
   <title>CRUD APP - @yield('meta_title', 'INSERT PAGE NAME using @section(\'meta_title\', \'Home Page\')')</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="@yield('meta_description', 'default meta description')">
   <meta name="keywords" content="@yield('meta_keywords', 'default, meta, keywords')">
   {{-- * @vite directive is for Vite.js to build Tailwind CSS/JS. Run 'npm run build' to build Tailwind CSS/JS --}}
   @vite('resources/css/app.css')
   {{-- leave a blank line for HTML source formatting (Laravel comment is fine) --}}
</head>

<body>

<!-- mobile burger icon -->
<div class="w-full md:w-1/6 bg-slate-400 md:hidden block pt-2">
   <a href="#" id="burgerIcon" class="inline-block p-1 ml-1 rounded-md hover:bg-slate-200 transition duration-300">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
         <path fill="currentColor" d="M21 10H3a1 1 0 0 1 0-2h18a1 1 0 0 1 0 2zm0-5H3a1 1 0 0 1 0-2h18a1 1 0 0 1 0 2zm0 10H3a1 1 0 0 1 0-2h18a1 1 0 0 1 0 2z"/>
      </svg>
   </a>
</div>

<div class="flex flex-col md:flex-row">
   
   <!-- Left column sidebar - Merakiui.com - "Search With Bottom Card" (https://merakiui.com/components/application-ui/sidebar) -->
   <!-- <div id="sidebar" class="w-full md:w-1/6 md:block hidden text-center py-4">
   bg-gradient-to-b from-slate-300 from-5% via-slate-200 via-15% to-slate-100 to-90% 
   -->
   <div id="sidebar" class="w-full md:w-1/6 md:block hidden bg-gradient-to-b from-gray-600 from-60% via-gray-500 via-80% to-gray-500 text-center rounded-b-lg">

      <aside class="flex flex-col px-5 py-3 overflow-y-auto rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700">
         
         <!-- logo -->
         <a href="#" style="display: flex; align-items: center; text-decoration: none;">
            <img class="w-auto h-7" src="{{asset('assets/images/android-chrome-512x512.png')}}" alt="Logo" title="" style="margin-right: 8px;">
            <span class="font-bold text-blue-100">CRUD APP</span>
         </a>

         <div class="flex flex-col justify-between flex-1 mt-6">
            <nav class="flex-1 -mx-3 space-y-3 ">
               <!-- search box -->
               <!--<form action="#" method="post">-->
               <div class="relative mx-3">
                  <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                     <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                        <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                     </svg>
                  </span>
                  <input type="text" class="w-full py-1.5 pl-10 pr-4 text-gray-700 bg-white border rounded-md dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring" placeholder="Search" />
               </div>
               <!--</form>-->

               <a href="#" onclick="return false;" class="flex items-center px-3 py-2 text-blue-100 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-600
                hover:border-gray-500 dark:hover:border-gray-200 border border-transparent">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                  </svg>
                  <span class="mx-2 text-sm font-medium">Home</span>
               </a>

               <a href="{{ route('product.index') }}" class="flex items-center px-3 py-2 text-blue-100 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-600
                hover:border-gray-500 dark:hover:border-gray-200 border border-transparent">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z" />
                  </svg>
                  <span class="mx-2 text-sm font-medium">Products</span>
               </a>
               
               <ul>
                  <li>
                     <a href="{{ route('product.create') }}" class="flex items-center px-5 py-2 text-blue-100 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700
                     hover:border-gray-500 dark:hover:border-gray-200 border border-transparent">
                        <span class="mx-2 text-sm font-medium">Create Product</span>
                     </a>
                  </li>
                  <li>
                     <a href="#" class="flex items-center px-5 py-2 text-blue-100 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700
                     hover:border-gray-500 dark:hover:border-gray-200 border border-transparent">
                        <span class="mx-2 text-sm font-medium">Sub menu 2</span>
                     </a>
                  </li>
               </ul>

               <a href="{{ route('adminusers.index') }}" class="flex items-center px-3 py-2 text-blue-100 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700
                hover:border-gray-500 dark:hover:border-gray-200 border border-transparent">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                  </svg>
                  <span class="mx-2 text-sm font-medium">Admin Users</span>
               </a>

               <!--
               <a href="#" class="flex items-center px-3 py-2 text-blue-100 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700
               hover:border-gray-500 dark:hover:border-gray-200 border border-transparent">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
                  </svg>
                  <span class="mx-2 text-sm font-medium">Dashboard</span>
               </a>

               <a href="#" class="flex items-center px-3 py-2 text-blue-100 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700
               hover:border-gray-500 dark:hover:border-gray-200 border border-transparent">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                  </svg>
                  <span class="mx-2 text-sm font-medium">Projects</span>
               </a>

               <a href="#" class="flex items-center px-3 py-2 text-blue-100 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700
               hover:border-gray-500 dark:hover:border-gray-200 border border-transparent">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                  </svg>
                  <span class="mx-2 text-sm font-medium">Tasks</span>
               </a>

               <a class="flex items-center px-3 py-2 text-blue-100 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700
                hover:border-gray-500 dark:hover:border-gray-200 border border-transparent
                hover:border-gray-500 dark:hover:border-gray-200 border border-transparent" href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                     <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                  </svg>
                  <span class="mx-2 text-sm font-medium">Reporting</span>
               </a>

               <a href="#" class="flex items-center px-3 py-2 text-blue-100 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700
               hover:border-gray-500 dark:hover:border-gray-200 border border-transparent">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                     <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  <span class="mx-2 text-sm font-medium">Settings</span>
               </a>

               -->
               <a href="{{route('weatherapi.index')}}" target="_blank" class="flex items-center px-3 py-2 text-blue-100 transition-colors duration-300 transform rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700
               hover:border-gray-500 dark:hover:border-gray-200 border border-transparent">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                     <title>Weather</title>
                     <circle cx="12" cy="12" r="5"></circle>
                     <line x1="12" y1="1" x2="12" y2="3"></line>
                     <line x1="12" y1="21" x2="12" y2="23"></line>
                     <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                     <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                     <line x1="1" y1="12" x2="3" y2="12"></line>
                     <line x1="21" y1="12" x2="23" y2="12"></line>
                     <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                     <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                  </svg>
                  <span class="mx-2 text-sm font-medium">Weather</span>
               </a>
            </nav>

            <!-- logged in user info, logout -->
            <div class="mt-6">
               <div class="flex items-center justify-between mt-6">
                  <a href="#" class="flex items-center gap-x-2">
                     <img class="object-cover rounded-full h-7 w-7" src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=634&h=634&q=80" alt="avatar" />
                     <span class="text-sm font-medium text-blue-100 dark:text-gray-200">@yield('username', 'Jon Doe')</span>
                  </a>
                  
                  <a href="javascript:void" onclick="document.getElementById('logout-form').submit();" class="text-white transition-colors duration-200 rotate-180 dark:text-gray-400 rtl:rotate-0 hover:text-blue-300 dark:hover:text-blue-400">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <title>Log out</title>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                     </svg>
                  </a>

                  <form id="logout-form" action="{{ route('adminlogin.logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
               </div>
            </div>
         </div>
      </aside>
   </div>

   <!-- Right column -->
   <div class="flex-1">

      <!-- right column - heading -->
      <div class="">
         <header class="">
            <div class="mx-auto max-w-7xl px-4 pt-5 pb-2 sm:px-6 lg:px-6">
               <h1 class="text-3xl font-bold tracking-tight">@yield('h1', 'Insert H1 Text')</h1>
            </div>
         </header>
      </div>
      <!-- right column - subnav -->
      {{--
      ??? This subnav looks weird right?
      <div class="">
         <div class="bg-gray-400 text-white pl-2 pt-2 pr-2 text-xs shadow-lg rounded-bl">
            <span class="inline-block bg-slate-600  text-white py-2 px-4 rounded mr-2 text-xs uppercase font-bold">Section Index</span>
            <a href="#" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mr-2 mb-2 text-xs uppercase font-bold">Link 1</a>
            <a href="#" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mr-2 mb-2 text-xs uppercase font-bold">Link 2</a>
            <a href="#" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mr-2 mb-2 text-xs uppercase font-bold">Link 3</a>
         </div>
      </div>
      --}}

      <main>
         <div class="mx-auto max-w-7xl py-1 sm:px-4 lg:px-5">
            <!-- Place your content here -->
   

            {{-- *** @yield('yield_name_here') - @yield is unique content not meant to be reusable. 
                  * Use the following to output content in master layout/template (master.blade.php):
                  *    @section('yield_name_here') - For a declared 'yield' replacement much like a variable.
                  *                                    
                  *                                   e.g. `master.blade.php` contains `<title>@yield('meta_title')</title>`
                  *                                        
                  *                                         The child view (e.g. create.blade.php) contains
                  *                                         `@section('meta_title', 'Home Page')` and passes the
                  *                                         declared @section 'meta_title' to `@yield('meta_title')`
                  *    OR
                  *    @section('multi_line_yield_name')
                  *    <div>
                  *       <!-- Your HTML/Blade code here -->
                  *       @if ($foo == true)
                  *          <div>Conditional HTML here</div>
                  *       @endif
                  *    </div>
                  *    @endsection
                  *--}}
            @yield('content')
      </main>
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

   <div class="my-4 text-xs text-gray-400">
      Current date/time: {{ date('Y-m-d H:i:s', time()) }}
   </div>
</div>


{{-- any non-essential JavaScript code to load using `@push` (child view) and `@stack (layout or master-template) --}}
@stack('scripts_body')
<script>
// mobile hamburger icon show/hide sidebar
document.getElementById("burgerIcon").addEventListener("click", function() {
   var sidebar = document.getElementById("sidebar");
   var burgerIcon = document.getElementById("burgerIcon");
   if (sidebar.classList.contains("hidden")) {
      sidebar.classList.remove("hidden");
      burgerIcon.classList.add("border"); // Add border to burger icon when clicked
   } else {
      sidebar.classList.add("hidden");
      burgerIcon.classList.remove("border"); // Remove border from burger icon when clicked
   }
});
</script>

</body>
</html>
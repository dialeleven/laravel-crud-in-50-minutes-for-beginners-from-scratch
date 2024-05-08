<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <style>
      /* Pagination Navigation */
nav[role="navigation"] {
  margin-bottom: 0.2rem; /* Add some bottom margin */
}

/* Pagination Navigation */
nav[role="navigation"][aria-label="Pagination Navigation"] {
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 0.7rem;
  /*
  border: 5px solid #000;
  */
}

span[aria-disabled="true"] .relative {
  width: 2.5rem; /* Adjust the width as needed */
}

/* Pagination Links */
nav[role="navigation"] a {
  display: inline-flex;
  align-items: center;
  padding: 0.5rem 0.5rem;
  font-size: 0.7rem;
  font-weight: 500;
  text-decoration: none;
  color: #4a5568;
  border: 1px solid #cbd5e0;
  border-radius: 0.25rem;
  transition: all 0.3s ease;
}

nav[role="navigation"] a:hover {
  color: #2d3748;
  background-color: #edf2f7;
  border-color: #a0aec0;
}




/* Pagination Links - Disabled */
nav[role="navigation"] a[aria-disabled="true"][aria-current="page"] span {
  width: auto !important; /* Allow width to adjust based on content */
  padding: 0.5rem 1rem !important; /* Adjust padding as needed */
}




/* Adjust the width of disabled navigation button */
nav[role="navigation"] a[aria-disabled="true"] span.relative {
  width: 2.5rem; /* Adjust the width as needed */
  border: 10px solid #000;
}

/* Pagination Links - Active */
nav[role="navigation"] a[aria-current="page"] {
  color: #1a202c;
  background-color: #e2e8f0;
  border-color: #a0aec0;
  border: 10px solid #00cc00;
}

/* Pagination Navigation Text - Showing X to Y of Z results" */
nav[role="navigation"] p {
  margin: 0;
  font-size: 0.7rem;
  color: #4a5568;
}

/* Pagination Navigation Arrow Icon */
nav[role="navigation"] svg {
  width: 1rem;
  height: 1rem;
  fill: currentColor;
  margin-right: 0.5rem;
}

nav[role="navigation"] .inline-flex > span,
nav[role="navigation"] a {
  display: inline-flex; /* Ensure the text container behaves as an inline-flex container */
  vertical-align: middle; /* Align items vertically within the container */
}

   </style>
</head>
<body>
   

<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
   <div class="flex justify-between flex-1 sm:hidden">
      <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
         &laquo; Previous
      </span>
      <a href="https://laravelcrud.test/product?page=2" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
         Next &raquo;
      </a>
   </div>

   <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
      <div>
         <p class="text-sm text-gray-700 leading-5 dark:text-gray-400">
            Showing <span class="font-medium">1</span>
               to
               <span class="font-medium">3</span>
               of
            <span class="font-medium">5</span>
            results
         </p>
      </div>

      <div>
         <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md">
            <span aria-disabled="true" aria-label="&amp;laquo; Previous">
               <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5 dark:bg-gray-800 dark:border-gray-600" aria-hidden="true">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 1000 1000">
                     <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                  </svg>
               </span>
            </span>
                                       
            <span aria-current="page" style="border: 5px solid #000000;">
               <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">1</span>
            </span>
            <a href="https://laravelcrud.test/product?page=2" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 2">
               2
            </a>                                                                                    
               
            <a href="https://laravelcrud.test/product?page=2" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Next &amp;raquo;">
               <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
               </svg>
            </a>
         </span>
      </div>
   </div>
</nav>

<?php
#phpinfo();

</body>
</html>

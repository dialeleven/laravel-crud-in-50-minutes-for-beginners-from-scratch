<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
   @vite('resources/css/app.css')
</head>
<body>


   
   <!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Document</title>
      <link rel="stylesheet" href="resources/css/app.css">
   </head>
   <body>
   
   <div class="flex flex-col md:flex-row">
      <div id="sidebar" class="w-full md:w-1/6 md:block hidden bg-blue-500 text-white text-center py-4">
         <div>
            <a href="#">Link 1</a>
         </div>
         <div>
            <a href="#">Link 2</a>
         </div>
         <div>
            <a href="#">Link 3</a>
         </div>
       </div>
       <div class="flex-1 bg-gray-200 text-center py-4">
   
         <!-- mobile burger icon -->
         <div class="w-full md:w-1/6 md:hidden block text-center p-3">
            <a href="#" id="burgerIcon" class="inline-block p-2 rounded-md hover:bg-gray-300 transition duration-300">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                  <path fill="currentColor" d="M21 10H3a1 1 0 0 1 0-2h18a1 1 0 0 1 0 2zm0-5H3a1 1 0 0 1 0-2h18a1 1 0 0 1 0 2zm0 10H3a1 1 0 0 1 0-2h18a1 1 0 0 1 0 2z"/>
               </svg>
            </a>
         </div>
   
           Content Content Content Content Content Content Content Content Content Content
           Content Content Content Content Content Content Content Content Content Content
           Content Content Content Content Content Content Content Content Content Content
           Content Content Content Content Content Content Content Content Content Content
           Content Content Content Content Content Content Content Content Content Content
           Content Content Content Content Content Content Content Content Content Content
           Content Content Content Content Content Content Content Content Content Content
           Content Content Content Content Content Content Content Content Content Content
           Content Content Content Content Content Content Content Content
   html
   Copy code
           Content Content Content Content Content Content Content Content Content Content
           Content Content Content Content Content Content Content Content Content Content
           Content Content Content Content Content Content Content Content Content Content
       </div>
   </div>

<script>
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
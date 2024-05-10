<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product Index2</title>
   @vite('resources/css/app.css')
</head>

<body>

   <div class="pagination-container">
      <!-- pagination links - make sure controller is calling "Classname::paginate(X);"" -->
      {{ $products->links() }}
   </div>

</body>
</html>
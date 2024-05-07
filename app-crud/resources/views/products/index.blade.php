<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product Index</title>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
   <!-- Include Font Awesome CSS --> 
   <link href="{{asset('assets/fontawesome/css/all.min.css')}}" rel="stylesheet" />
   <link rel="stylesheet" href="{{asset('assets/css/product_index.css')}}">
   <script>
      // Function to remove the status message after a timeout
      function removeStatusMessage() {
        var statusMessage = document.getElementById('statusMessage');
        if (statusMessage) {
          statusMessage.style.opacity = '0';
          setTimeout(function() {
            statusMessage.remove();
          }, 100); // Adjust timeout duration (in milliseconds) as needed
        }
      }
  
      // Call the function after a certain period (e.g., 3 seconds)
      setTimeout(removeStatusMessage, 3000);
    </script>
</head>
<body>
   <h1>Products</h1>

   <p><a href="{{route('product.create')}}" class="create-product-link">Create a Product</a></p>
      @if(@session()->has('success'))
      <div id="statusMessage" class="status-message success">
         {{session('success')}}
      </div>
      @endif
   <div>
      <table border="0">
         <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
            <th>Edit</th>
            <th>Delete</th>
         </tr>
         @foreach ($products as $product)
         <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->qty}}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->description}}</td>
            <td align="center">
               @if ($product->thumbnail)
               <a href="/storage/{{$product->image}}" target="_blank">
                  <img src="/storage/{{$product->thumbnail}}" width="50" height="50" alt="{{$product->name}}">
               </a>
               @else
               <a href="/storage/{{$product->image}}" target="_blank"><i class="fa-solid fa-image" aria-label="display image" title="Image opens in new tab/window"></i></a>
               @endif
            </td>
            <td align="center"><a href="{{route('product.edit', ['product' => $product])}}" class="button-like">Edit</a></td>
            <td align="center">
               <form method="POST" action="{{route('product.destroy', ['product' => $product])}}">
                  @csrf
                  @method('delete')
                  <input type="submit" value="Delete" class="delete-button" onclick="return confirm('Delete {{$product->name}}?')">
               </form>
            </td>
         </tr>
         @endforeach
      </table>
   </div>

   <p>
      Today is {{ date('Y-m-d H:i:s', time()) }}
   </p>
</body>
</html>
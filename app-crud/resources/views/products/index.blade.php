<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product Index</title>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="{{asset('assets/css/product_index.css')}}">
</head>
<body>
   <h1>Products</h1>

   <p><a href="{{route('product.create')}}" class="create-product-link">Create a Product</a></p>
      @if(@session()->has('success'))
      <div class="status-message success">
         {{session('success')}}
      </div>
      @endif
   <div>
      <table>
         <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Description</th>
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
               <td><a href="{{route('product.edit', ['product' => $product])}}" class="button-like">Edit</a></td>
               <td>
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
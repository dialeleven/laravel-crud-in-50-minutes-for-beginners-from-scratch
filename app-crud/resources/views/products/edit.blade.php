<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Product</title>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="{{asset('assets/css/product_create.css')}}">
</head>
<body>
   
   <form method="post" action="{{route('product.update', ['product' => $product])}}">
      @csrf
      @method('put')
      <h1>Edit a Product</h1>
   
      <div>
         @if ($errors->any())
         <ul>
            @foreach($errors->all() as $error)
               <li>{{$error}}</li>
            @endforeach
         </ul>
         @endif
      </div>
      <div>
         <label">Name</label>
         <input type="text" name="name" placeholder="Name" value="{{$product->name}}" />
      </div>
      <div>
         <label>Qty</label>
         <input type="text" name="qty" placeholder="Qty" value="{{$product->qty}}" />
      </div>
      <div>
         <label>Price</label>
         <input type="text" name="price" placeholder="Price" value="{{$product->price}}" />
      </div>
      <div>
         <label>Description</label>
         <input type="text" name="description" placeholder="Description" value="{{$product->description}}" />
      </div>
      <div>
         <input type="submit" value="Update" />
         <input type="button" value="Cancel" class="cancel-button" onclick="window.history.back();">
      </div>
   </form>
</body>
</html>
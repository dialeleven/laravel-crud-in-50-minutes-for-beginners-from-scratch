<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product Create</title>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="{{asset('assets/css/product_create.css')}}">

</head>
<body>
   
   <form method="post" action="{{route('product.store')}}">
      @csrf
      @method('post')
      <h1>Create a Product</h1>
      <div>
         @if ($errors->any())
         <ul class="error-list">
            @foreach($errors->all() as $error)
               <li class="error-list-item">{{$error}}</li>
            @endforeach
         </ul>
         @endif
      </div>
      <div>
         <label">Name</label>
         <input type="text" id="name" name="name" placeholder="Name" value="{{old('name')}}" />
      </div>
      <div>
         <label>Qty</label>
         <input type="text" id="qty" name="qty" placeholder="Qty" value="{{old('qty')}}" />
      </div>
      <div>
         <label>Price</label>
         <input type="text" id="price" name="price" placeholder="Price" value="{{old('price')}}" />
      </div>
      <div>
         <label>Description</label>
         <input type="text" id="description" name="description" placeholder="Description" value="{{old('description')}}" />
      </div>
      <div>
         <label>Image</label>
         <input type="file" name="image">
      </div>
      <p>
         <input type="submit" value="Save" />
         <input type="button" value="Cancel" class="cancel-button" onclick="window.history.back();">
      </p>
   </form>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product Create</title>
</head>
<body>
   <h1>Create a Product</h1>
   <form method="post" action="{{route('product.store')}}">
      @csrf
      @method('post')
      <div>
         <label for="">Name</label>
         <input type="text" name="name" placeholder="Name" />
      </div>
      <div>
         <label for="">Qty</label>
         <input type="text" name="qty" placeholder="Qty" />
      </div>
      <div>
         <label for="">Price</label>
         <input type="text" name="price" placeholder="Price" />
      </div>
      <div>
         <label for="">Description</label>
         <input type="text" name="description" placeholder="Description" />
      </div>
      <div>
         <input type="submit" value="Save a New Product" />
      </div>
   </form>
</body>
</html>
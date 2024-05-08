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
   
   <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
      @csrf
      @method('post')
      <h1>Create a Product</h1>
      <div>
         @if ($errors->any())
         <ul class="error-list">
            @foreach($errors->all() as $error)
               @php
               // extract input name/id from error message
               preg_match('/^The (.*?) field/i', $error, $matches);
               $inputNameOrId = $matches[1] ?? '';
               @endphp
               <li class="error-list-item"><a href="#{{ $inputNameOrId }}">{{$error}}</a></li>
            @endforeach
         </ul>
         @endif
      </div>
      <div>
         <label">Name</label>
         <input type="text" id="name" name="name" value="{{old('name')}}" />
      </div>
      <div>
         <label>Quantity</label>
         <input type="text" id="qty" name="qty" value="{{old('qty')}}" />
      </div>
      <div>
         <label>Price</label>
         <input type="text" id="price" name="price" value="{{old('price')}}" />
      </div>
      <div>
         <label>Description</label>
         <input type="text" id="description" name="description" value="{{old('description')}}" />
      </div>
      <div>
         <label>Image</label>
         <input type="file" name="image">
      </div>
      <p>
         <input type="submit" value="Save" />
         <input type="button" value="Cancel" class="cancel-button" onclick="location.href='{{route('product.index')}}';">
      </p>
   </form>
</body>
</html>
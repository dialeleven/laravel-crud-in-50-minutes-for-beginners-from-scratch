<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product Create</title>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
   <!--<link rel="stylesheet" href="/assets/css/style_product.css">-->
   <style type="text/css">
      body {
         font: 14px Roboto;
      }

      form {
         max-width: 400px;
         margin: 0 auto;
         padding: 20px;
         border: 1px solid #ccc;
         border-radius: 5px;
      }

      label {
         display: block;
         margin-bottom: 10px;
      }

      input[type="text"],
      input[type="email"] {
         width: 95%;
         padding: 10px;
         margin-bottom: 20px;
         border: 1px solid #ccc;
         border-radius: 5px;
      }

      input[type='submit'] {
         background-color: #0056b3;
         border: 1px solid #000000;
         color: #eee;
         padding: 5px;
         border-radius: 5px;
         transition: background-color 0.2s ease; /* Smooth transition */
      }

      input[type="submit"]:hover {
         background-color: #2189f8; /* New background color on hover */
      }


      /* Cancel button styles */
      .cancel-button {
            background-color: #b3b3b3; /* Red background color */
            color: #000000; /* Default text color */
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #000000;
            transition: background-color 0.2s ease; /* Smooth transition */
        }

        /* Hover effect for cancel button */
        .cancel-button:hover {
            background-color: #dc5361; /* Darker red on hover */
        }
   </style>
</head>
<body>

   <div>
      @if ($errors->any())
      <ul>
         @foreach($errors->all() as $error)
            <li>{{$error}}</li>
         @endforeach
      </ul>
      @endif
   </div>
   
   <form method="post" action="{{route('product.store')}}">
      @csrf
      @method('post')
      <h1>Create a Product</h1>
      <div>
         <label">Name</label>
         <input type="text" name="name" placeholder="Name" value="{{old('name')}}" />
      </div>
      <div>
         <label>Qty</label>
         <input type="text" name="qty" placeholder="Qty" value="{{old('qty')}}" />
      </div>
      <div>
         <label>Price</label>
         <input type="text" name="price" placeholder="Price" value="{{old('price')}}" />
      </div>
      <div>
         <label>Description</label>
         <input type="text" name="description" placeholder="Description" value="{{old('description')}}" />
      </div>
      <div>
         <label>Image</label>
         <input type="file" name="image">
      </div>
      <p>
         <input type="submit" value="Save a New Product" />
         <input type="button" value="Cancel" class="cancel-button" onclick="window.history.back();">
      </p>
   </form>
</body>
</html>
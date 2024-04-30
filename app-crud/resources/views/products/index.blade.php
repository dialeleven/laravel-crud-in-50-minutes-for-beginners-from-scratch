<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product Index</title>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
   <style type="text/css">
      body, th, td {
         font: 14px Roboto;
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

      
      /* delete button styles */
      .delete-button {
            background-color: #e17a7a; /* Red background color */
            color: #000000; /* Default text color */
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #000000;
            transition: background-color 0.2s ease; /* Smooth transition */
        }

        /* Hover effect for cancel button */
        .delete-button:hover {
            background-color: #dc5361; /* Darker red on hover */
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
   <h1>Products</h1>
   
   <p><a href="{{route('product.create')}}">Add a Product</a></p>
   <div>
      @if(@session()->has('success'))
         <p style="color: green; font-weight: bold;">
            {{session('success')}}
         </p>
      @endif
   </div>
   <div>
      <table border="1" cellspacing="0" cellpadding="5">
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
               <td><a href="{{route('product.edit', ['product' => $product])}}">Edit</a></td>
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
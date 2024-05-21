<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Products index</title>
</head>
<body>

<h1>Products index</h1>

@foreach ($products as $index => $product)
{{ $product->id }} | 
{{ $product->name }} | 
{{ $product->qty }} | 
{{ $product->price }} | 
{{ $product->description }}<br>
@endforeach

</body>
</html>
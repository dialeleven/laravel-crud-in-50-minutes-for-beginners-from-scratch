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
{{ $product->description }} |
   @if ($product->thumbnail)
   <a href="/storage/{{ $product->image }}" target="_blank"><img src="/storage/{{ $product->thumbnail }}" alt="" width="50" height="50"></a>
   @endif
   <hr>
@endforeach

</body>
</html>
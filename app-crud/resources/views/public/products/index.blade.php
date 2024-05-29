<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Public Products index</title>
   {{-- @vite directive is for Vite.js to build Tailwind CSS/JS --}}
   @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Products Index</h1>

    @foreach ($products as $product)
        <div class="bg-white shadow-md rounded-lg p-4 mb-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    @if ($product->thumbnail AND Storage::exists('/public/' . $product->thumbnail))
                        <a href="/storage/{{ $product->image }}" target="_blank" class="mr-4">
                            <img src="/storage/{{ $product->thumbnail }}" alt="Thumbnail" class="w-12 h-12 rounded-full">
                        </a>
                    @endif
                    <div>
                        <p class="text-gray-800 font-semibold">{{ $product->name }}</p>
                        <p class="text-gray-600">ID: {{ $product->id }}</p>
                    </div>
                </div>
                <div>
                    <p class="text-gray-600">Qty: {{ $product->qty }}</p>
                    <p class="text-gray-600">Price: ${{ $product->price }}</p>
                </div>
            </div>
            <p class="text-gray-600 mt-2">Description: {{ $product->description }}</p>
        </div>
    @endforeach

    @if ($products->isEmpty())
        <p class="text-gray-600">No products found.</p>
    @endif
</div>

</body>
</html>

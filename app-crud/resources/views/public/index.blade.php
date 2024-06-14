<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Stripe Products</title>
   @vite('resources/css/app.css')
   <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
   <header class="bg-white">
      <div class="mx-auto flex h-16 max-w-screen-xl items-center gap-8 px-4 sm:px-6 lg:px-8">
         <a class="block text-green-600" href="#">
            <span class="sr-only">Home</span>
            <img class="mx-auto h-8 w-auto" src="https://laravelcrud.test/assets/images/android-chrome-512x512.png" alt="CRUD App">CRUD App
         </a>
         <div class="flex flex-1 items-center justify-end md:justify-between">
            <input type="checkbox" id="menu-toggle" class="peer hidden">
            <nav aria-label="Global" class="hidden peer-checked:block md:block" id="mobile-menu">
               <ul class="flex flex-col md:flex-row items-center gap-6 text-sm">
                  <li>
                     <a class="text-gray-500 transition hover:text-gray-500/75" href="#">About</a>
                  </li>
                  <li>
                     <a class="text-gray-500 transition hover:text-gray-500/75" href="{{ route('public_products.index') }}">Products</a>
                  </li>
                  <li>
                     <a class="text-gray-500 transition hover:text-gray-500/75" href="#">History</a>
                  </li>
                  <li>
                     <a class="text-gray-500 transition hover:text-gray-500/75" href="#">Services</a>
                  </li>
                  <li>
                     <a class="text-gray-500 transition hover:text-gray-500/75" href="#">Projects</a>
                  </li>
                  <li>
                     <a class="text-gray-500 transition hover:text-gray-500/75" href="#">Blog</a>
                  </li>
               </ul>
            </nav>
            <div class="flex items-center gap-4">
               <div class="sm:flex sm:gap-4">
                  <a class="block rounded-md bg-teal-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-teal-700" href="#">Login</a>
                  <a class="hidden rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-teal-600 transition hover:text-teal-600/75 sm:block" href="#">Register</a>
               </div>
               <button class="block rounded-md bg-gray-100 p-2.5 text-gray-600 transition hover:text-gray-600/75 md:hidden" id="menu-button">
                  <label for="menu-toggle">
                     <span class="sr-only">Toggle menu</span>
                     <svg aria-hidden="true" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                     </svg>
                  </label>
               </button>
            </div>
         </div>
      </div>
   </header>
   <main>
      <div class="relative px-6 lg:px-8 pt-5">
         <h1 class="text-3xl font-bold mb-1">Stripe Products</h1>
         <p>Our current product catalog coming directly from Stripe!</p>
         <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
            @foreach($data as $item)
               <div class="bg-white rounded-lg shadow-md overflow-hidden">
                  @if(isset($item['product']->images[0]))
                     <img src="{{ $item['product']->images[0] }}" alt="{{ $item['product']->name }}" class="w-full h-48 object-cover">
                  @else
                     <div class="w-full h-48 bg-gray-200"></div>
                  @endif
                  <div class="p-4">
                     <h2 class="text-lg font-semibold">{{ $item['product']->name }}</h2>
                     <p class="text-gray-600">{{ $item['product']->description ?? 'No description available' }}</p>
                     <ul class="mt-2">
                        @foreach($item['product']->features as $feature)
                           <li class="text-sm text-gray-700">{{ $feature->name }}</li>
                        @endforeach
                     </ul>
                     <div class="mt-4">
                        <h3 class="text-md font-medium">Prices:</h3>
                        <ul>
                           @foreach($item['prices'] as $price)
                              @if ($price->active)
                              <li class="text-sm text-gray-700">
                                 {{ number_format($price->unit_amount / 100, 2) }} {{ strtoupper($price->currency) }}
                                 @if(isset($price->recurring))
                                    / {{ $price->recurring->interval }}
                                 @endif
                              </li>
                              @endif
                           @endforeach
                        </ul>
                     </div>
                     <div class="mt-4 flex justify-between items-center">
                        <span class="text-gray-500">Created: {{ date('Y-m-d', $item['product']->created) }}</span>
                        <a href="{{ route('checkout', ['stripe_price_id' => $item['product']->default_price]) }}" class="text-indigo-600 hover:text-indigo-700">Purchase</a>
                     </div>
                  </div>
               </div>
            @endforeach
         </div>
         <div class="mx-auto max-w-3xl pt-50 sm:pt-20 lg:pt-26 pb-10">
            <div class="hidden sm:mb-8 sm:flex sm:justify-center">
               <div class="relative overflow-hidden rounded-full py-1.5 px-4 text-sm leading-6 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                  <span class="text-gray-600">
                     <a href="{{ route('public_products.index') }}" class="font-semibold text-indigo-600">
                        <span class="absolute inset-0" aria-hidden="true"></span>New products available
                        <span aria-hidden="true">&rarr;</span>
                     </a>
                  </span>
               </div>
            </div>
            <div class="text-center">
               <h1 class="text-4xl font-bold tracking-tight sm:text-center sm:text-6xl">
                  Your Product Title Here
               </h1>
               <p class="mt-6 text-lg leading-8 text-gray-600 sm:text-center">
                  A brief description about your product and what it does.
               </p>
               <div class="mt-8 flex gap-x-4 sm:justify-center">
                  <a href="#" class="inline-block rounded-lg bg-indigo-600 px-4 py-1.5 text-base font-semibold leading-7 text-white shadow-sm ring-1 ring-indigo-600 hover:bg-indigo-700 hover:ring-indigo-700">Get started</a>
                  <a href="#" class="inline-block rounded-lg px-4 py-1.5 text-base font-semibold leading-7 text-gray-900 ring-1 ring-gray-900/10 hover:ring-gray-900/20">Learn more <span class="text-gray-400" aria-hidden="true">→</span></a>
               </div>
            </div>
         </div>
      </div>
   </main>
</body>
</html>

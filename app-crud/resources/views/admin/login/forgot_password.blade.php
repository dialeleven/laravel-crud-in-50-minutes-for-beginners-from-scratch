<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Forgot Password</title>
   {{-- * @vite directive is for Vite.js to build Tailwind CSS/JS --}}
   @vite('resources/css/app.css')
</head>
<body>


<!-- www.hyperui.dev --> 
<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">

  <div class="mx-auto max-w-lg text-center">
    
    <div class="mb-5">
      <img class="mx-auto h-10 w-auto" src="{{asset('assets/images/android-chrome-512x512.png')}}" alt="CRUD App">CRUD App
    </div>

    <h1 class="text-2xl font-bold sm:text-3xl">Forgot Password</h1>

    <p class="mt-4 text-gray-500">
      <!-- content here -->
    </p>
  </div>

  <div class="mx-auto max-w-md">
    {{-- output status message(s) if any --}}
    @if (@session()->has('status'))
    <div id="statusMessage" class="bg-green-300 py-1 px-4 rounded-md mt-2 mb-2">
      {{session('status')}}
    </div>
    @endif
    
    {{-- output form submission errors if any exist --}}
    @if ($errors->any())
    <div class="mb-3">
        <ul class="error-list">
          @foreach($errors->all() as $index => $error)
          @php
          // extract input name/id from error message
          preg_match('/^The (.*?) field/i', $error, $matches);
          preg_match('/^We can\'t find a user with that (.*?) address/i', $error, $matches);
          $inputNameOrId = $matches[1] ?? '';
          @endphp
          <li class="error-list-item flex items-center bg-red-100 rounded-md p-1 mb-2">
              <span class="text-red-500 font-bold mr-2">X</span>
              {{-- <a href="#{{ $inputNameOrId }}" class="underline"> --}}
                {{$error}}
              {{-- </a> --}}
          </li>
          @endforeach
        </ul>
    </div>
    @endif
  </div>

  <div class="mx-auto border-2 shadow rounded-md max-w-md">
    <form action="{{route('password.send_reset_link')}}" method="POST" class="mx-auto mb-0 mt-3 max-w-md space-y-4 p-5">
      @csrf
      @method('post')
      <div class="">
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
  
        <div class="relative">
          <input id="email" name="email" type="email" autocomplete="email" value="{{old('email')}}"
             class="w-full rounded-md p-4 pe-12 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300  focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </span>
        </div>
      </div>
  
      <div class="flex items-center justify-between">
        <button
          type="submit"
          class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white"
        >
          Submit
        </button>

        <p class="text-sm text-gray-500">
          {{-- New user? --}}
          <a class="underline" href="{{route('login')}}">Back to login</a>
        </p>
      </div>
    </form>
  </div>
</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Sign In</title>
   {{-- * @vite directive is for Vite.js to build Tailwind CSS/JS --}}
   @vite('resources/css/app.css')
</head>
<body>


<!-- www.hyperui.dev --> 
<div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">

  <div class="mx-auto max-w-lg text-center">
    
    <div class="mb-5">
      <img class="mx-auto h-10 w-auto" src="{{asset('assets/images/android-chrome-512x512.png')}}" alt="CRUD App">CRUD Public Site
    </div>

    <h1 class="text-2xl font-bold sm:text-3xl">CRUD Public Site - Sign in to your account</h1>

    <p class="mt-4 text-gray-500">
      <!-- content here -->
    </p>
  </div>

  <div class="mx-auto max-w-md">
    {{-- output status message(s) if any --}}
    @if (@session()->has('success') OR @session()->has('status'))
    <div id="statusMessage" class="bg-green-300 py-1 px-4 rounded-md mt-2 mb-2">
      {{session('success')}}{{session('status')}}
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
          $inputNameOrId = $matches[1] ?? '';
          @endphp
          <li class="error-list-item flex items-center bg-red-100 rounded-md p-1 mb-2">
              <span class="text-red-500 font-bold mr-2">X</span>
              <a href="#{{ $inputNameOrId }}" class="underline">{{$error}}</a>
          </li>
          @endforeach
        </ul>
    </div>
    @endif
  </div>

  <div class="mx-auto border-2 shadow rounded-md max-w-md">
    <form action="{{route('publicsite.login-process')}}" method="POST" class="mx-auto mb-0 mt-3 max-w-md space-y-4 p-5">
      @csrf
      @method('post')
      <div class="">
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
  
        <div class="relative">
          <input id="email" name="email" type="email" autocomplete="email" required 
             class="w-full rounded-md p-4 pe-12 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300  focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </span>
        </div>
      </div>
  
      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
          <div class="text-sm">
            <a href="{{ route('password.request') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
            {{-- <a href="{{ route('password.request2') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password TEMP</a> --}}
          </div>
        </div>
  
        <div class="relative">
          <input
            id="password"
            name="password"
            type="password"
            required
            class="w-full rounded-md p-4 pe-12 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300  focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
          />
  
          <span id="togglePassword" class="absolute inset-y-0 end-0 grid place-content-center px-4 cursor-pointer">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="size-4 text-gray-400"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              
            >
              <title>Show/hide password</title>
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
              />
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
              />
            </svg>
          </span>
        </div>
      </div>

      <!-- Remember Me checkbox -->
      <div class="flex items-center">
        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
        <label for="remember" class="ml-1 block text-sm text-gray-900">Remember Me</label>
    </div>
  
      <div class="flex items-center justify-between">
        <button
          type="submit"
          class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white"
        >
          Sign in
        </button>

        <p class="text-sm text-gray-500">
          New user?
          <a href="#" onclick="return false" class="underline cursor-not-allowed line-through">Sign up</a>
        </p>
      </div>
    </form>
  </div>
</div>
    

<script>
  const togglePassword = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('password');

  togglePassword.addEventListener('click', function() {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    // Change eye icon color on toggle
    this.querySelector('svg').classList.toggle('text-gray-400');
    this.querySelector('svg').classList.toggle('text-gray-600');
  });
</script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Reset Password</title>
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

    <h1 class="text-2xl font-bold sm:text-3xl">Reset Password</h1>

    <p class="mt-4 text-gray-500">
      <!-- content here -->
    </p>
  </div>

  <div class="mx-auto max-w-md">
    {{-- output status message(s) if any --}}
    @include('admin.site.partials.form_success_output')

    {{-- output form submission errors if any exist --}}
    @include('admin.site.partials.form_error_output')
  </div>

  <div class="mx-auto border-2 shadow rounded-md max-w-md">
    <form action="{{route('password.update')}}" method="POST" class="mx-auto mb-0 mt-3 max-w-md space-y-4 p-5">
      @csrf
      @method('post')  
      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">New Password</label>
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
  
      <div class="flex items-center justify-between">
        <button
          type="submit"
          class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white"
        >
          Reset Password
        </button>

        <p class="text-sm text-gray-500">
          <a class="underline" href="{{route('adminsite.login')}}">Back to login</a>
        </p>
      </div>
      <input type="hidden" name="email" value="{{ $email }}">
      <input type="hidden" name="token" value="{{$token}}">
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
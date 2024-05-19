   {{-- output form submission errors if any exist --}}
   @if ($errors->any())
   <div class="mb-3">
      <ul class="error-list">
         @foreach($errors->all() as $error)
         @php
         $i = 0;

         // extract input name/id from error message
         preg_match('/^The (.*?) field/i', $error, $matches);
         $inputNameOrId = $matches[1] ?? '';
         
         // extract input name/id from error message for "the password field" as it can output
         // multiple errors (e.g. password too short, one upper/lowercase letter, etc)
         if (preg_match('/^The password field/i', $error, $matches))
         {
            // no password error yet, so consolidate all other possible password errors
            if (empty($password_error))
            {
               $error = 'The password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.';
               $password_error = true; // password error found flag
            }
            // password error exists, so skip output of <li> error below
            else {
               continue;
            }
         }
         @endphp
         <li class="error-list-item flex items-center bg-red-100 rounded-md p-1 mb-2">
            <span class="text-red-500 font-bold mr-2">X</span>
            <a href="#{{ $inputNameOrId }}" class="underline">{{$error}}</a>
         </li>
         @endforeach
      </ul>
   </div>
   @endif
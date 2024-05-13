   {{-- output form submission errors if any exist --}}
   @if ($errors->any())
   <div class="mb-3">
      <ul class="error-list">
         @foreach($errors->all() as $error)
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
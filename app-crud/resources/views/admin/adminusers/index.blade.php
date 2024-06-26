{{-- FILE: resources/views/index.blade.php --}}


{{-- ******* The layout template to use (/resources/views/layouts/master.blade.php) *******--}}
{{-- @extends are the reusable components in a master template like your header/nav - e.g. master.blade.php  --}}
{{-- Here we specify to use /resources/views/master.blade.php as our master/app HTML layout template --}}
@extends('admin.site.layouts.master')


{{-- Define section of content in child view to be injected using `@yield` to 
     a layout or master template (e.g. master.blade.php). This is done using `@yield('section_name')`.
     Here we define a section of content called 'meta_title' to be used in the <title> tag only. --}}
@section('meta_title', 'Admin Users')
@section('meta_description', '')
@section('meta_keywords', 'CRUD app, products page, create, read, update, delete')

@section('h1', 'Admin Users')

{{-- `@section` & `@endsection` marks where your unique page content goes --}}
@section('content')
   <!--
    <div class="jumbotron">
        <h1>Welcome to Your Application</h1>
        <p>This is the home page content.</p>
    </div>
   -->



   <!-- create/export csv buttons -->
   <div class="mt-3 mb-4">
      <a href="{{ route('adminusers.create') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mr-2 text-xs uppercase font-bold">
         Add User
      </a>
   </div>
 
   <!-- pagination links - make sure controller is calling "Classname::paginate(X);"" -->
   {{-- $adminusers->links() --}}

   {{-- output status message(s) if any --}}
   @include('admin.site.partials.form_success_output')
 
   <!-- data table -->
   <div class="mt-2 mb-3">
      <table class="w-full border-collapse rounded-md overflow-hidden text-sm">
         <thead>
            <tr class="bg-gray-200">
               <th class="py-2 px-3 font-bold border-b border-gray-400 text-left">ID</th>
               <th class="py-2 px-3 font-bold border-b border-gray-400 text-left">Username</th>
               <th class="py-2 px-3 font-bold border-b border-gray-400 text-left">Name</th>
               <th class="py-2 px-3 font-bold border-b border-gray-400 text-left">Email</th>
               <th class="py-2 px-3 font-bold border-b border-gray-400 text-left">Role</th>
               <th class="py-2 px-3 font-bold border-b border-gray-400 text-center">Acct Active</th>
               <th class="py-2 px-3 font-bold border-b border-gray-400">Edit</th>
               <th class="py-2 px-3 font-bold border-b border-gray-400">Delete</th>
            </tr>
         </thead>
         <tbody id="table-body">
         @foreach ($adminusers as $index => $adminuser)
            <tr class="odd:bg-white even:bg-gray-100 hover:bg-slate-200">
               <td class="py-2 px-3 border-b border-gray-400">{{ $adminuser->id }}</td>
               <td class="py-2 px-3 border-b border-gray-400">{{ $adminuser->username }}</td>
               <td class="py-2 px-3 border-b border-gray-400">{{ $adminuser->name }}</td>
               <td class="py-2 px-3 border-b border-gray-400">{{ $adminuser->email }}</td>
               <td class="py-2 px-3 border-b border-gray-400">{{ $adminuser->role_name }}</td>
               <td class="py-2 px-3 border-b border-gray-400 text-center">{{ $adminuser->account_active }}</td>
               <td class="py-2 px-3 border-b border-gray-400 text-center">
                  <a href="{{ route('adminusers.edit', ['adminuser' => $adminuser]) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded transition duration-300">Edit</a>
               </td>
               <td class="py-2 px-3 border-b border-gray-400 text-center">
                  <form method="POST" action="{{ route('adminusers.destroy', ['adminuser' => $adminuser]) }}">
                  @csrf
                  @method('delete')
                  <button type="submit" class="inline-block bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded transition duration-300" 
                     onclick="return confirm('Delete {{ $adminuser->username }}?')">Delete</button>
                  <input type="hidden" name="page" value="{{request()->query('page')}}">
                  </form>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
 
    {{-- output pagination below table if needed (e.g. current page rows > N) --}}
    {{-- @if ($products->count() >= 5)
       {{ $products->links() }}
    @endif --}}
@endsection


{{-- `@push` and JavaScript above </body> tag needed for this page to the layout or master template referenced by @stack('stack_name_here') --}}
@push('scripts_body')
<script type="text/javascript">
   // Function to remove the status message after a timeout
   function removeSuccessMessage() {
     var successMessage = document.getElementById('successMessage');
     if (successMessage) {
       successMessage.style.opacity = '0';
       setTimeout(function() {
         successMessage.remove();
       }, 500); // Adjust timeout duration (in milliseconds) as needed
     }
   }

   // Call the function after a certain period (e.g., 3 seconds)
   setTimeout(removeSuccessMessage, 3000);
</script>
@endpush
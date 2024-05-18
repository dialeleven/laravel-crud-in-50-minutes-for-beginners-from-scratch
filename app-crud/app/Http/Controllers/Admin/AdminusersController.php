<?php
namespace App\Http\Controllers\Admin; // reference our directory structure "app\Http\Controllers\Admin

use App\Http\Controllers\Controller; // Import the base Controller class
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import Hash facade to bcrypt hash password
use Illuminate\Validation\Rules\Password;

use App\Models\AdminModels\Admin; // import 'Admin' model


class AdminusersController extends Controller
{
    // READ adminuser list - view
    public function index() {
        #$adminusers = Admin::all();
        $adminusers = Admin::paginate(5); // get paginated records

        return view('admin.adminusers.index', ['adminusers' => $adminusers]);
    }


    // CREATE (add) user - view
    public function create() {
        return view('admin.adminusers.create');
    }


    // CREATE (add) user - POST request
    public function store(Request $request) {
        $data = $request->validate([
            'username' => 'required|unique:admins',
            'name' => 'nullable',
            'email' => 'required|unique:admins',
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
            'account_active' => 'required',
            'role_id' => 'nullable',
        ]);

        // hash the password (bcrypt default)
        $data['password'] = Hash::make($request->input('password'));

        // create new admin user
        $new_adminuser = Admin::create($data);

        return redirect(route('adminusers.index'))->with('success', 'Successfully added user');
    }
    

    // UPDATE (edit) adminuser (VIEW)
    public function edit(Admin $adminuser, Request $request) {
        #dd('edit adminuser');
        #dd($request);
        
        return view('admin.adminusers.edit', ['adminuser' => $adminuser]);
    }


    // UPDATE (edit) adminuser - POST request
    public function update(Admin $adminuser, Request $request) 
    {
        #dd('update POST');
        $data = $request->validate([
            'username' => "required|unique:admins,username,$adminuser->id",
            'name' => 'nullable',
            
            /*
            Ensure unique email but ignore current user's email.

            * The 'unique' validation rule follows 'unique:table,column,id'
                - table: The name of the database table.
                - column: The column in the table to check for uniqueness.
                - id: The primary key of the record to ignore during the uniqueness check.
            */
            'email' => "required|unique:admins,email,$adminuser->id", 
            'password' => ['nullable', 'string', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
            'account_active' => 'required',
            'role_id' => 'nullable',
        ]);

        // hash the password (bcrypt default) if entered
        if (!empty($data['password']))
            $data['password'] = Hash::make($request->input('password'));
        // remove password from data array to avoid updating it with null value
        else
            unset($data['password']);

        // db update record
        $adminuser->update($data);
        
        // get the current page number from the query parameters
        $current_page = $request->input('page', 1);

        return redirect( route('adminusers.index', ['page' => $current_page]))->with('success', 'Successfully updated record' );
    }


    // DELETE adminuser - POST request
    public function destroy(Admin $adminuser, Request $request)
    {
        // get the current page number from the query parameters
        $current_page = $request->input('page', 1);

        // delete current adminuser
        $adminuser->delete();

        // redirect to our route for the Adminusers index view ( see web.php - `name('adminusers.index')` )
        return redirect( route('adminusers.index', ['page' => $current_page]) )->with('success', 'Successfully deleted record');
    }
}

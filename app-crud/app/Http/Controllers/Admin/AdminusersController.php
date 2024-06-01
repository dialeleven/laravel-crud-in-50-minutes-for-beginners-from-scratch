<?php
namespace App\Http\Controllers\Admin; // reference our directory structure "app\Http\Controllers\Admin

use App\Http\Controllers\Controller; // Import the base Controller class
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import Hash facade to bcrypt hash password
use Illuminate\Validation\Rules\Password; // import Password validation class

use App\Models\AdminSite\Admin; // import 'Admin' model
use App\Models\AdminSite\AdminRole;

use Illuminate\Support\Facades\Auth;

class AdminusersController extends Controller
{
    // READ adminuser list - view
    public function index() {
    
        // Get the authenticated user
        $user = Auth::user();

        #dd($user->role_id);
        #$adminusers = Admin::all();
        //$adminusers = Admin::paginate(5); // get paginated records

        // Get list of admiusers and INNER JOIN the admin_roles table to get the admin_roles.name column value.
        // ? https://laravel.com/docs/11.x/queries#joins
        $adminusers = Admin::join('admin_roles', 'admins.role_id', '=', 'admin_roles.id')
            ->select('admins.*', 'admin_roles.name AS role_name')
            ->paginate(5); // get paginated records

        return view('admin.adminusers.index', ['adminusers' => $adminusers]);
    }


    // CREATE (add) user - view
    public function create() {
        // $admin_roles = AdminRole::all();

        // get list of admin_roles from table admin_roles
        $admin_roles = AdminRole::orderBy('id', 'desc')->get();

        return view('admin.adminusers.create', ['admin_roles' => $admin_roles]);
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
        // get list of admin_roles
        $admin_roles = AdminRole::orderBy('id', 'desc')->get();
        
        return view('admin.adminusers.edit', ['adminuser' => $adminuser, 'admin_roles' => $admin_roles]);
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

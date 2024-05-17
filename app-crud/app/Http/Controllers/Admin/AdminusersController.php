<?php
namespace App\Http\Controllers\Admin; // reference our directory structure "app\Http\Controllers\Admin

use App\Http\Controllers\Controller; // Import the base Controller class
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import Hash facade to bcrypt hash password

use App\Models\AdminModels\Admin; // import 'Admin' model


class AdminusersController extends Controller
{
    public function index() {
        #$adminusers = Admin::all();
        $adminusers = Admin::paginate(5); // get paginated records

        return view('admin.adminusers.index', ['adminusers' => $adminusers]);
    }

    public function create() {
        return view('admin.adminusers.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'username' => 'required',
            'name' => 'nullable',
            'email' => 'required|unique:admins',
            'password' => 'required',
            'account_active' => 'required',
            'role_id' => 'nullable',
        ]);

        // hash the password (bcrypt default)
        $data['password'] = Hash::make($request->input('password'));

        // create new admin user
        $new_adminuser = Admin::create($data);

        return redirect(route('adminusers.index'))->with('success', 'Successfully added user');
    }

    public function destroy() {
        return view('admin.adminusers.index');
    }
    
    public function edit(Admin $adminuser, Request $request) {
        #dd('edit adminuser');
        #dd($request);
        
        return view('admin.adminusers.edit', ['adminuser' => $adminuser]);
    }
}

<?php
namespace App\Http\Controllers\Admin; // reference our directory structure "app\Http\Controllers\Admin

use App\Http\Controllers\Controller; // Import the base Controller class
use Illuminate\Http\Request;


class AdminusersController extends Controller
{
    public function index() {
        return view('admin.adminusers.index');
    }

    public function create() {
        return view('admin.adminusers.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'accountstatus' => 'required',
        ]);

        // ? 'Adminuser::' needs to be adjusted below
        //new_adminuser = Adminuser::create($data);

        return redirect(route('adminusers.index'))->with('success', 'Successfully added user');
    }
}

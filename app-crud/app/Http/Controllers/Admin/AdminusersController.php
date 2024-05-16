<?php
namespace App\Http\Controllers\Admin; // reference our directory structure "app\Http\Controllers\Admin

use App\Http\Controllers\Controller; // Import the base Controller class
use Illuminate\Http\Request;

class AdminusersController extends Controller
{
    //
    public function adminusersindex() {
        return view('adminusers.index');
    }
}

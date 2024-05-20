<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendTestEmail()
    {
        Mail::to('getfrancistsao@gmail.com')->send(new MyTestEmail());
    
        // Optionally, add some logic to verify email was sent
        return response()->json(['message' => 'Email sent successfully!']);
    }
}

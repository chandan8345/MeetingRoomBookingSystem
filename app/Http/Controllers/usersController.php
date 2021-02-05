<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Session;
use Auth;

class usersController extends Controller
{
    public function index()
    {
        return view('pages.onboard');
    }
    
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/login');
    }
}

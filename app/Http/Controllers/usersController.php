<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;

class usersController extends Controller
{
    public function login(Request $r){
        $i=0;
        $email=$r->input('email');
        $password=$r->input('password');
        if(User::where('email', $email)->first()){
            $i++;
        }
        if(User::where('password', $password)->first()){
            $i++;
        }
        if($i == 2){
            $result=User::where('email', $email)->where('password', $password)->get();
            foreach($result as $r){
                session()->put('id',$r->id);  
                session()->put('name',$r->name); 
                session()->put('role',$r->room_booking_role);
            }
            return $i;
        }else if($i == 1){
            return $i;
        }
        else{
            return $i;
        }
    }
    public function index()
    {
        return view('pages.signin');
    }

    public function profile()
    {
        $id=Session::get('id');
        $profiles=User::where('id',$id)->get();
        return view('pages.profile')->with('profiles',$profiles);
    }

    public function reports()
    {
        return view('pages.reports');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}

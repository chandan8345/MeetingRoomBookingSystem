<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $result=DB::select("select t_leave_users.id,t_leave_users.name,t_leave_users.room_booking_role role,t_leave_users.staffid,t_leave_users.mobile,t_leave_users.picture,t_leaves_departments.dep_name department,t_leaves_designations.designation_name designation from t_leave_users,t_leaves_departments,t_leaves_designations where t_leave_users.department_id=t_leaves_departments.id and t_leave_users.designation_id=t_leaves_designations.id and t_leave_users.email='$email' and t_leave_users.password='$password'");
            foreach($result as $r){
                session()->put('id', $r->id);
                session()->put('name', $r->name);
                session()->put('role', $r->role);
                session()->put('department', $r->department);
                session()->put('designation', $r->designation);
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
        //$profiles=User::where('id',$id)->get();
        $profiles=DB::select("select t_leave_users.id,t_leave_users.name,t_leave_users.email,t_leave_users.mobile,t_leave_users.room_booking_role role,t_leave_users.staffid,t_leave_users.mobile,t_leave_users.picture,t_leaves_departments.dep_name department,t_leaves_designations.designation_name designation from t_leave_users,t_leaves_departments,t_leaves_designations where t_leave_users.department_id=t_leaves_departments.id and t_leave_users.designation_id=t_leaves_designations.id and t_leave_users.id='$id'");
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

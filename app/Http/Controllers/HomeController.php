<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id=Auth::id();
        $result=DB::select("select users.id as id,users.name,users.room_booking_role role,users.staffid,users.mobile,users.picture,t_leaves_departments.dep_name department,t_leaves_designations.designation_name designation from users,t_leaves_departments,t_leaves_designations where users.department_id=t_leaves_departments.id and users.designation_id=t_leaves_designations.id and users.id='$id'");
        foreach($result as $r){
            session()->put('id', $r->id);
            session()->put('name', $r->name);
            session()->put('role', $r->role);
            session()->put('department', $r->department);
            session()->put('designation', $r->designation);
        }
        return view('pages.dashboard');
    }
    public function countongoing(){
        $book=0;
        // if(Session::get('role') == 'admin'){
        //     $b = DB::select("select count(posts.status) book from posts where posts.status='booked' and posts.meetingdate = 
        //     now()");
        // }else{
            $id=Auth::id();
            $b = DB::select("select count(posts.status) book from posts where posts.postuser_id='$id' and posts.status='booked' and posts.meetingdate =
            CAST( GETDATE() AS Date )");
        // }
        foreach($b as $row){$book=$row->book;}
        return $book;
    }
    public function countbooked(){
        $book=0;
        // if(Session::get('role') == 'admin'){
        //     $b = DB::select("select count(posts.status) book from posts where posts.status='booked' and posts.meetingdate >= 
        //     now()");
        // }else{
            $id=Auth::id();
            $b = DB::select("select count(posts.status) book from posts where posts.postuser_id='$id' and posts.status='booked' and posts.meetingdate >=
            CAST( GETDATE() AS Date )");
        // }
        foreach($b as $row){$book=$row->book;}
        return $book;
    }
    public function countpostponed(){
        $postponed=0;
        // if(Session::get('role') == 'admin'){
        //     $w = DB::select("select count(posts.status) postponed from posts where posts.status='postponed'");
        // }else{
            $id=Auth::id();
            $w = DB::select("select count(posts.status) postponed from posts where posts.postuser_id='$id' and posts.status='postponed'");             
        // }
        foreach($w as $row){$postponed=$row->postponed;}
        return $postponed;
    }
    public function countcompleted(){
        $complete=0;
        // if(Session::get('role') == 'admin'){
        //     $c = DB::select("select count(posts.status) complete from posts where posts.status='booked' and posts.meetingdate < 
        //     now()");
        // }else{
            $id=Auth::id();
            $c = DB::select("select count(posts.status) complete from posts where posts.postuser_id='$id' and posts.status='booked' and posts.meetingdate < 
            CAST( GETDATE() AS Date )");
        // }      
        foreach($c as $row){$complete=$row->complete;}
        return $complete;
    } 
    
    public function profile()
    {
        $id=Auth::id();
        $profiles=DB::select("select users.id,users.name,users.email,users.mobile,users.room_booking_role role,users.staffid,users.mobile,users.picture,t_leaves_departments.dep_name department,t_leaves_designations.designation_name designation from users,t_leaves_departments,t_leaves_designations where users.department_id=t_leaves_departments.id and users.designation_id=t_leaves_designations.id and users.id='$id'");
        return view('pages.profile')->with('profiles',$profiles);
    }

    public function reports()
    {
        return view('pages.reports');
    }
}

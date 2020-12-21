<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class dashboardController extends Controller
{

    public function index(){
        return view('pages.dashboard');
    }

    public function countbooked(){
        $book=0;
        if(Session::get('role') == 'admin'){
            $b = DB::select("select count(posts.status) book from posts where posts.status='booked' and posts.meetingdate >= 
            DATE(NOW())");
        }else{
            $id=Session::get('id');
            $b = DB::select("select count(posts.status) book from posts where posts.postuser_id='$id' and posts.status='booked' and posts.meetingdate >=
            DATE(NOW())");
        }
        foreach($b as $row){$book=$row->book;}
        return $book;
    }
    public function countpostponed(){
        $postponed=0;
        if(Session::get('role') == 'admin'){
            $w = DB::select("select count(posts.status) postponed from posts where posts.status='postponed'");
        }else{
            $id=Session::get('id');
            $w = DB::select("select count(posts.status) postponed from posts where posts.postuser_id='$id' and posts.status='postponed'");             
        }
        foreach($w as $row){$postponed=$row->postponed;}
        return $postponed;
    }
    public function countcompleted(){
        $complete=0;
        if(Session::get('role') == 'admin'){
            $c = DB::select("select count(posts.status) complete from posts where posts.status='booked' and posts.meetingdate < 
            DATE(NOW())");
        }else{
            $id=Session::get('id');
            $c = DB::select("select count(posts.status) complete from posts where posts.postuser_id='$id' and posts.status='booked' and posts.meetingdate < 
            DATE(NOW())");          
        }      
        foreach($c as $row){$complete=$row->complete;}
        return $complete;
    } 
}

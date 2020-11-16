<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('pages.dashboard');
    }
    public function countbooked(){
        $book=0;
        if(Session::get('role') == 'admin'){
            $b = DB::select("select count(posts.status) book from posts where posts.status='booked' and posts.meetingdate >= 
            CAST( GETDATE() AS Date )");
        }else{
            $id=Session::get('id');
            $b = DB::select("select count(posts.status) book from posts where posts.postuser_id='$id' and posts.status='booked' and posts.meetingdate >= 
            CAST( GETDATE() AS Date )");
        }
        foreach($b as $row){$book=$row->book;}
        return $book;
    }
    public function countwaiting(){
        $waiting=0;
        if(Session::get('role') == 'admin'){
            $w = DB::select("select count(posts.status) waiting from posts where posts.status='waiting'");
        }else{
            $id=Session::get('id');
            $w = DB::select("select count(posts.status) waiting from posts where posts.postuser_id='$id' and posts.status='waiting'");             
        }
        foreach($w as $row){$waiting=$row->waiting;}
        return $waiting;
    }
    public function countcompleted(){
        $complete=0;
        if(Session::get('role') == 'admin'){
            $c = DB::select("select count(posts.status) complete from posts where posts.status='booked' and posts.meetingdate < 
            CAST( GETDATE() AS Date )");
        }else{
            $id=Session::get('id');
            $c = DB::select("select count(posts.status) complete from posts where posts.postuser_id='$id' and posts.status='booked' and posts.meetingdate < 
            CAST( GETDATE() AS Date )");          
        }      
        foreach($c as $row){$complete=$row->complete;}
        return $complete;
    } 
}

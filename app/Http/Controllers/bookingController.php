<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Room;
use App\Models\Post;

class bookingController extends Controller
{
    public function managebooking()
    {
        return view('pages.manage-booking');
    }

    public function quickbooking()
    {
        $rooms=Room::where('status',1)->get();
        $categories=Category::where('status',1)->get();
        return view('pages.quick-booking')->with('rooms',$rooms)->with('categories',$categories);
    }
    public function booking(Request $r){
        $post=new Post;
        $post->purpose=$r->input('purpose');
        $post->meetingdate=$r->input('meetingdate');
        $post->meetingtime=$r->input('meetingtime');
        $post->duration=$r->input('duration');
        $post->meetingtype=$r->input('meetingtype');
        $post->remarks=$r->input('remarks');
        $post->total=$r->input('total');
        $post->coffee='Yes';
        $post->snacks='No';
        $post->room_id=$r->input('room');
        $post->category_id=$r->input('category');
        $post->status='waiting';
        $post->postuser_id=session()->get('id');
        $post->save();
        return "store";
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Room;
use App\Models\Post;
Use Session;

class bookingController extends Controller
{   
    public function updatepost(Request $r){
        $post = Post::find($r->input('id'));
        $post->purpose=$r->input('purpose');
        $post->meetingdate=$r->input('meetingdate');
        $post->meetingtime=$r->input('meetingtime');
        $post->duration=$r->input('duration');
        $post->comments=$r->input('comments');
        $post->coffee=$r->input('coffee');
        $post->snacks=$r->input('snacks');
        $post->room_id=$r->input('room');
        $post->save();
        return "update";
    }
    public function delete($id){
        Post::where('id', $id)->delete();
        return "delete";
    }
    public function reject($id){
        $post = Post::find($id);
        $post->status='rejected';
        $post->save();
        return "rejected";
    }
    public function book(Request $r){
        $post = Post::find($r->input('id'));
        $post->meetingdate=$r->input('meetingdate');
        $post->meetingtime=$r->input('meetingtime');
        $post->duration=$r->input('duration');
        $post->comments=$r->input('comments');
        $post->coffee=$r->input('coffee');
        $post->snacks=$r->input('snacks');
        $post->room_id=$r->input('room');
        $post->status='booked';
        $post->approveuser=session()->get('name');
        $post->save();
        return "update";
    }

    public function rebook(Request $r){
        $post= Post::find($r->input('id'));
        $post->meetingdate=$r->input('meetingdate');
        $post->meetingtime=$r->input('meetingtime');
        $post->duration=$r->input('duration');
        $post->remarks=$r->input('remarks');
        $post->coffee=$r->input('coffee');
        $post->snacks=$r->input('snacks');
        $post->room_id=$r->input('room');
        $post->status='waiting';
        $post->approveuser=session()->get('name');
        $post->save();
        return "rebook";
    }

    public function setPostponed(Request $r){
        $post= Post::find($r->input('id'));
        $post->meetingdate=$r->input('meetingdate');
        $post->meetingtime=$r->input('meetingtime');
        $post->duration=$r->input('duration');
        $post->remarks=$r->input('remarks');
        $post->coffee=$r->input('coffee');
        $post->snacks=$r->input('snacks');
        $post->room_id=$r->input('room');
        $post->status='postponed';
        $post->approveuser=session()->get('name');
        $post->save();
        return "update";
    }

    public function edit($id){
        $rooms=Room::where('status',1)->get();
        $categories=Category::where('status',1)->get();
        $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.meetingtime,posts.duration,posts.total,posts.postingdate,posts.snacks,posts.coffee,posts.remarks,categories.name category,rooms.name room,users.name postuser,posts.status,posts.approveuser,posts.approvedate,posts.comments,posts.meetingtype from users,posts,categories,rooms where users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id and posts.id='$id' order by posts.meetingdate asc");
        return view('pages.edit-booking')->with('posts',$posts)->with('rooms',$rooms)->with('categories',$categories);
    }
    public function waiting(){
        $rooms=Room::where('status',1)->get();
        $categories=Category::where('status',1)->get();
        $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.meetingtime,posts.duration,posts.total,posts.postingdate,posts.snacks,posts.coffee,posts.remarks,categories.name category,rooms.name room,users.name postuser,posts.status,posts.approveuser,posts.approvedate,posts.comments,posts.meetingtype from users,posts,categories,rooms where posts.status='waiting' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id order by posts.meetingdate desc");
        $i=1;
        foreach($posts as $post){
            echo 
           '<tr>
            <td id="name'.$post->id.'" onblur="updateName('.$post->id.')" contenteditable="true" class="align-middle text-center">
            '.$post->category.'
            </td>
            <td id="status'.$post->id.'" class="align-middle">'.$post->meetingdate.'</td>
            <td id="status'.$post->id.'"  class="align-middle text-center">'.date('G:i', strtotime($post->meetingtime)).'</td>
            <td id="status'.$post->id.'" class="align-middle text-center">'.$post->duration.'</td>
            <td id="status'.$post->id.'"  class="align-middle text-center">'.$post->total.'</td>
            <td id="status'.$post->id.'" class="align-middle text-center">'.$post->room.'</td>
            <td id="status'.$post->id.'"  class="align-middle text-center">'.$post->meetingtype.'</td>
            ';
            if(Session::get('role') == 'admin'){
            echo '<td id="status'.$post->id.'"  class="align-middle text-center">'.$post->postuser.'</td>
            ';}
            echo ' 
            <td id="status'.$post->id.'"  class="align-middle text-center">Waiting</td>
            <td class="align-middle text-center">
            <a href="edit/'.$post->id.'" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a>
            ';
            if(Session::get('role') == 'user'){
            echo '<button class="btn btn-danger" type="button" onclick="remove('.$post->id.')" ><i class="fa fa-trash"></i></button>
            ';}
            echo '</td>
        </tr>';
        }
    }
    public function postponed(){
        $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.meetingtime,posts.duration,posts.total,posts.postingdate,posts.snacks,posts.coffee,posts.remarks,categories.name category,rooms.name room,users.name postuser,posts.status,posts.approveuser,posts.approvedate,posts.comments,posts.meetingtype from users,posts,categories,rooms where posts.status='postponed' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id order by posts.meetingdate desc");
        $i=1;
        foreach($posts as $post){
            echo 
           '
           <tr>
            <td id="name'.$post->id.'" onblur="updateName('.$post->id.')" contenteditable="true" class="align-middle text-center">
            '.$post->category.'
            </td>
            <td id="status'.$post->id.'" class="align-middle">'.$post->meetingdate.'</td>
            <td id="status'.$post->id.'"  class="align-middle text-center">'.date('G:i', strtotime($post->meetingtime)).'</td>
            <td id="status'.$post->id.'" class="align-middle text-center">'.$post->duration.'</td>
            <td id="status'.$post->id.'"  class="align-middle text-center">'.$post->total.'</td>
            <td id="status'.$post->id.'" class="align-middle text-center">'.$post->room.'</td>
            <td id="status'.$post->id.'"  class="align-middle text-center">'.$post->meetingtype.'</td>
            ';
            if(Session::get('role') == 'admin'){
            echo '<td id="status'.$post->id.'"  class="align-middle text-center">'.$post->postuser.'</td>
            ';}
            echo ' 
            <td id="status'.$post->id.'"  class="align-middle text-center">Postponed</td>
            <td class="align-middle text-center">
            ';
            if(Session::get('role') == 'user'){
            echo '<a href="edit/'.$post->id.'" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a>
            ';}
            echo '<button class="btn btn-danger" type="button" onclick="reject('.$post->id.')" ><i class="fa fa-trash"></i></button>
            </td>
        </tr>';
        }
    }
    public function booked(){
        $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.meetingtime,posts.duration,posts.total,posts.postingdate,posts.snacks,posts.coffee,posts.remarks,categories.name category,rooms.name room,users.name postuser,posts.status,posts.approveuser,posts.approvedate,posts.comments,posts.meetingtype from users,posts,categories,rooms where posts.status='booked' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id and posts.meetingdate > 
        CAST( GETDATE() AS Date ) order by posts.meetingdate desc");
        $i=1;
        foreach($posts as $post){
            echo 
           '
           <tr>
            <td id="name'.$post->id.'" onblur="updateName('.$post->id.')" contenteditable="true" class="align-middle text-center">
            '.$post->category.'
            </td>
            <td id="status'.$post->id.'" class="align-middle">'.$post->meetingdate.'</td>
            <td id="status'.$post->id.'"  class="align-middle text-center">'.date('G:i', strtotime($post->meetingtime)).'</td>
            <td id="status'.$post->id.'" class="align-middle text-center">'.$post->duration.'</td>
            <td id="status'.$post->id.'"  class="align-middle text-center">'.$post->total.'</td>
            <td id="status'.$post->id.'" class="align-middle text-center">'.$post->room.'</td>
            <td id="status'.$post->id.'"  class="align-middle text-center">'.$post->meetingtype.'</td>
            ';
            if(Session::get('role') == 'admin'){
            echo '<td id="status'.$post->id.'"  class="align-middle text-center">'.$post->postuser.'</td>
            ';}
            echo ' 
            <td id="status'.$post->id.'"  class="align-middle text-center">Booked</td>
            <td class="align-middle text-center">
            <a href="edit/'.$post->id.'" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a>
            <button class="btn btn-danger" type="button" onclick="reject('.$post->id.')" ><i class="fa fa-trash"></i></button>
            </td>
        </tr>';
        }    }
        public function rejected(){
            $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.meetingtime,posts.duration,posts.total,posts.postingdate,posts.snacks,posts.coffee,posts.remarks,categories.name category,rooms.name room,users.name postuser,posts.status,posts.approveuser,posts.approvedate,posts.comments,posts.meetingtype from users,posts,categories,rooms where posts.status='rejected' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id order by posts.meetingdate asc");
            $i=1;
            foreach($posts as $post){
                echo 
               '
               <tr>
                <td id="name'.$post->id.'" class="align-middle text-center">
                '.$post->category.'
                </td>
                <td class="align-middle">'.$post->meetingdate.'</td>
                <td  class="align-middle text-center">'.date('g:i', strtotime($post->meetingtime)).'</td>
                <td class="align-middle text-center">'.$post->duration.'</td>
                <td  class="align-middle text-center">'.$post->total.'</td>
                <td  class="align-middle text-center">'.$post->room.'</td>
                <td id="status'.$post->id.'"  class="align-middle text-center">'.$post->meetingtype.'</td>
                ';
                if(Session::get('role') == 'admin'){
                echo '<td id="status'.$post->id.'"  class="align-middle text-center">'.$post->postuser.'</td>
                ';}
                echo ' 
                <td id="status'.$post->id.'"  class="align-middle text-center">Rejected</td>
                <td class="align-middle text-center">
                <a href="edit/'.$post->id.'" class="btn btn-info" type="button"><i class="fa fa-edit"></i></a>
                </td>
            </tr>';
            }
        }
    public function completed(){
        $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.meetingtime,posts.duration,posts.total,posts.postingdate,posts.snacks,posts.coffee,posts.remarks,categories.name category,rooms.name room,users.name postuser,posts.status,posts.approveuser,posts.approvedate,posts.comments,posts.meetingtype from users,posts,categories,rooms where posts.status='booked' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id and posts.meetingdate < 
        CAST( GETDATE() AS Date ) order by posts.meetingdate desc");
        $i=1;
        foreach($posts as $post){
            echo 
           '
           <tr>
            <td id="name'.$post->id.'" onblur="updateName('.$post->id.')" contenteditable="true" class="align-middle text-center">
            '.$post->category.'
            </td>
            <td id="status'.$post->id.'" class="align-middle">'.$post->meetingdate.'</td>
            <td id="status'.$post->id.'"  class="align-middle text-center">'.date('G:i', strtotime($post->meetingtime)).'</td>
            <td id="status'.$post->id.'" class="align-middle text-center">'.$post->duration.'</td>
            <td id="status'.$post->id.'"  class="align-middle text-center">'.$post->total.'</td>
            <td id="status'.$post->id.'" class="align-middle text-center">'.$post->room.'</td>
            ';
            if(Session::get('role') == 'admin'){
            echo '<td id="status'.$post->id.'"  class="align-middle text-center">'.$post->postuser.'</td>
            ';}
            echo ' 
            <td id="status'.$post->id.'"  class="align-middle text-center">'.$post->meetingtype.'</td>
            <td id="status'.$post->id.'"  class="align-middle text-center">Completed</td>
            ';
            if(Session::get('role') == 'user'){
                echo '<td class="align-middle text-center"><a href="edit/'.$post->id.'" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a>
            ';}
            echo '<a onclick="reject('.$post->id.')" class="btn btn-danger" type="button"><i class="fa fa-ban"></i></a>
            </td>
        </tr>';
        }
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
        $post->coffee=$r->input('coffee');
        $post->snacks=$r->input('snacks');
        $post->postingdate=date('Y-m-d');
        $post->room_id=$r->input('room');
        $post->category_id=$r->input('category');
        $post->status='waiting';
        $post->postuser_id=session()->get('id');
        $post->save();
        return "store";
    }
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
}

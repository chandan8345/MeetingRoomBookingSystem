<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Room;
use App\Models\Post;

class bookingController extends Controller
{
    public function waiting(){
        $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.meetingtime,posts.duration,posts.total,posts.postingdate,posts.snacks,posts.coffee,posts.remarks,categories.name category,rooms.name room,users.name postuser,posts.status,posts.approveuser,posts.approvedate,posts.comments,posts.meetingtype from users,posts,categories,rooms where posts.status='waiting' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id order by posts.meetingdate asc");
        $i=1;
        foreach($posts as $post){
            echo 
           '  <div id="view'.$post->id.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="add-category">
                            {{ csrf_field() }}
                            <div class="modal-header">
                                <h4 class="modal-title">Add Category</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name of Category</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-primary" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           <tr>
            <td id="name'.$post->id.'" onblur="updateName('.$post->id.')" contenteditable="true" class="align-middle text-center">
            '.$post->category.'
            </td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle">'.$post->meetingdate.'</td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.date('G:i', strtotime($post->meetingtime)).'</td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.$post->duration.'</td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.$post->total.'</td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.$post->room.'</td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.$post->postuser.'</td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.$post->meetingtype.'</td>
            <td class="align-middle text-center">
            <a class="btn btn-warning" data-toggle="modal" data-target="#view'.$post->id.'" type="button"><i class="fa fa-edit"></i></a>
            </td>
        </tr>';
        }
    }
    public function postponed(){
        $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.meetingtime,posts.duration,posts.total,posts.postingdate,posts.snacks,posts.coffee,posts.remarks,categories.name category,rooms.name room,users.name postuser,posts.status,posts.approveuser,posts.approvedate,posts.comments,posts.meetingtype from users,posts,categories,rooms where posts.status='postponed' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id order by posts.meetingdate asc");
        $i=1;
        foreach($posts as $post){
            echo 
           '  <div id="view'.$post->id.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="add-category">
                            {{ csrf_field() }}
                            <div class="modal-header">
                                <h4 class="modal-title">Add Category</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name of Category</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-primary" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           <tr>
            <td id="name'.$post->id.'" onblur="updateName('.$post->id.')" contenteditable="true" class="align-middle text-center">
            '.$post->category.'
            </td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle">'.$post->meetingdate.'</td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.date('G:i', strtotime($post->meetingtime)).'</td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.$post->duration.'</td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.$post->total.'</td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.$post->room.'</td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.$post->postuser.'</td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.$post->meetingtype.'</td>
            <td class="align-middle text-center">
            <a class="btn btn-warning" data-toggle="modal" data-target="#view'.$post->id.'" type="button"><i class="fa fa-edit"></i></a>
            </td>
        </tr>';
        }
    }
    public function booked(){
        $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.meetingtime,posts.duration,posts.total,posts.postingdate,posts.snacks,posts.coffee,posts.remarks,categories.name category,rooms.name room,users.name postuser,posts.status,posts.approveuser,posts.approvedate,posts.comments,posts.meetingtype from users,posts,categories,rooms where posts.status='booked' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id order by posts.meetingdate asc");
        $i=1;
        foreach($posts as $post){
            echo 
           '  <div id="view'.$post->id.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="add-category">
                            {{ csrf_field() }}
                            <div class="modal-header">
                                <h4 class="modal-title">Add Category</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name of Category</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-primary" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           <tr>
            <td id="name'.$post->id.'" onblur="updateName('.$post->id.')" contenteditable="true" class="align-middle text-center">
            '.$post->category.'
            </td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle">'.$post->meetingdate.'</td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.date('G:i', strtotime($post->meetingtime)).'</td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.$post->duration.'</td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.$post->total.'</td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.$post->room.'</td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.$post->postuser.'</td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.$post->meetingtype.'</td>
            <td class="align-middle text-center">
            <a class="btn btn-warning" data-toggle="modal" data-target="#view'.$post->id.'" type="button"><i class="fa fa-edit"></i></a>
            </td>
        </tr>';
        }    }
    public function completed(){
        $i=1;
        foreach($posts as $post){
           echo 
           '<tr>
            <td class="align-middle text-center">'.$i++.'</td>
            <td id="name'.$post->id.'" onblur="updateName('.$post->id.')" contenteditable="true" class="align-middle text-center">
            '.$post->name.'
            </td>
            <td id="status'.$post->id.'" onblur="updateStatus('.$post->id.')" contenteditable="true" class="align-middle text-center">'.$post->status.'</td>
            <td class="align-middle text-center">
                <button class="btn btn-danger" onclick="remove('.$post->id.')"><i class="fas fa-trash"></i></button>
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

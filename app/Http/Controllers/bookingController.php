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
        $post->approveuser=Session::get('name');
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
        $post->status='booked';
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
        $post->save();
        return "update";
    }

    public function edit($id){
        $rooms=Room::where('status',1)->get();
        $categories=Category::where('status',1)->get();
        $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.starttime,posts.endtime,posts.total,posts.postingdate,categories.name category,rooms.name room,users.name postuser,posts.status,posts.meetingtype from users,posts,categories,rooms where users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id and posts.id='$id' order by posts.meetingdate asc");
        return view('pages.edit-booking')->with('posts',$posts)->with('rooms',$rooms)->with('categories',$categories);
    }
    public function waiting(){
        $rooms=Room::where('status',1)->get();
        $categories=Category::where('status',1)->get();
        if(Session::get('role') == 'admin'){
            $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.meetingtime,posts.duration,posts.total,posts.postingdate,posts.snacks,posts.coffee,posts.remarks,categories.name category,rooms.name room,users.name postuser,posts.status,posts.approveuser,posts.approvedate,posts.comments,posts.meetingtype from users,posts,categories,rooms where posts.status='waiting' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id order by posts.meetingdate asc");
        }else{
            $id=Session::get('id');
            $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.meetingtime,posts.duration,posts.total,posts.postingdate,posts.snacks,posts.coffee,posts.remarks,categories.name category,rooms.name room,users.name postuser,posts.status,posts.approveuser,posts.approvedate,posts.comments,posts.meetingtype from users,posts,categories,rooms where posts.postuser_id='$id' and posts.status='waiting' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id order by posts.meetingdate asc");   
        }
        $i=1;
        foreach($posts as $post){
            echo 
            '
            <tr>
             <td class="align-middle text-center">
             '.$post->category.'
             </td>
             <td class="align-middle">'.$post->meetingdate.'</td>
             <td class="align-middle text-center">'.date('G:i', strtotime($post->meetingtime)).'</td>
             <td class="align-middle text-center">'.$post->duration.'</td>
             <td class="align-middle text-center">'.$post->total.'</td>
             <td class="align-middle text-center">'.$post->room.'</td>
             <td class="align-middle text-center">'.$post->meetingtype.'</td>
             ';
             if(Session::get('role') == 'admin'){
             echo '<td class="align-middle text-center">'.$post->postuser.'</td>
             ';}
             echo ' 
             <td class="align-middle text-center">Waiting</td>
             <td class="align-middle text-center">
             <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal'.$post->id.'"><i class="fa fa-eye"></i></button>
 
             <div class="modal fade" id="exampleModal'.$post->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
             <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Booking Information</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
             </div>
             <div class="modal-body">
             <div class="row">
                 <div class="col-md-6">
                     <div class="form-group">
                     <input type="text" id="email-vr" value="'.$post->purpose.'" class="form-control"/>
                     </div>
                 </div>
                 <div class="col-md-6">
                     <div class="form-group">
                     <input type="text" id="email-vr"  value="'.$post->category.'" class="form-control"/>
                     </div>
                 </div>
             </div>
                          <div class="row">
                 <div class="col-md-6">
                     <div class="form-group">
                     <input type="text" id="email-vr" value="'.$post->room.'" class="form-control"/>
                     </div>
                 </div>
                 <div class="col-md-6">
                     <div class="form-group">
                     <input type="text" id="email-vr"  value="'.$post->meetingtype.'" class="form-control"/>
                     </div>
                 </div>
             </div>
                         <div class="row">
                 <div class="col-md-6">
                     <div class="form-group">
                     <input type="text" id="email-vr" value="'.$post->meetingdate.'" class="form-control"/>
                     </div>
                 </div>
                 <div class="col-md-6">
                     <div class="form-group">
                     <input type="text" id="email-vr"  value="'.date('G:i', strtotime($post->meetingtime)).'" class="form-control"/>
                     </div>
                 </div>
             </div>
                          <div class="row">
                 <div class="col-md-6">
                     <div class="form-group">
                     <input type="text" id="email-vr" value="'.$post->duration.'" class="form-control"/>
                     </div>
                 </div>
                 <div class="col-md-6">
                     <div class="form-group">
                     <input type="text" id="email-vr"  value="'.$post->total.' Person" class="form-control"/>
                     </div>
                 </div>
             </div>
                                      <div class="row">
                 <div class="col-md-12">
                     <div class="form-group">
                     <input type="text" id="email-vr" value="'.$post->remarks.'" class="form-control"/>
                     </div>
                 </div>
                 <div class="col-md-12">
                     <div class="form-group">
                     <input type="text" id="email-vr"  value="'.$post->comments.'" class="form-control"/>
                     </div>
                 </div>
             </div>
             </div>
             <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             </div>
             </div>
             </div>
             </div>
             <a href="edit/'.$post->id.'" class="btn btn-primary btn-sm" type="button"><i class="fa fa-edit"></i></a>
             ';
             if(Session::get('role') == 'user'){
             echo '<button class="btn btn-danger btn-sm" type="button" onclick="remove('.$post->id.')" ><i class="fa fa-trash"></i></button>
             ';}
             echo '</td>
         </tr>';
         }
    }
    public function postponed(){
        if(Session::get('role') == 'admin'){
            $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.starttime,posts.endtime,posts.total,posts.postingdate,categories.name category,rooms.name room,users.name postuser,posts.status,posts.meetingtype from users,posts,categories,rooms where posts.status='postponed' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id and posts.meetingdate >= 
            CAST( GETDATE() AS Date ) order by posts.meetingdate asc");
        }else{
            $id=Session::get('id');
            $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.starttime,posts.endtime,posts.total,posts.postingdate,categories.name category,rooms.name room,users.name postuser,posts.status,posts.meetingtype from users,posts,categories,rooms where posts.status='postponed' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id and posts.meetingdate >= 
            CAST( GETDATE() AS Date ) and posts.postuser_id='$id' order by posts.meetingdate asc");
        }
        $i=1;
        foreach($posts as $post){
            echo 
           '
           <tr>
            <td class="align-middle text-center">
            '.$post->category.'
            </td>
            <td class="align-middle">'.$post->meetingdate.'</td>
            <td class="align-middle text-center">'.date('h:i a', strtotime($post->starttime)).'</td>
            <td class="align-middle text-center">'.date('h:i a', strtotime($post->endtime)).'</td>
            <td class="align-middle text-center">'.$post->total.'</td>
            <td class="align-middle text-center">'.$post->room.'</td>
            <td class="align-middle text-center">'.$post->meetingtype.'</td>
            <td class="align-middle text-center">'.$post->postuser.'</td>
            <td class="align-middle text-center">Postponed</td>
            <td class="align-middle text-center">
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal'.$post->id.'"><i class="fa fa-eye"></i></button>

            <div class="modal fade" id="exampleModal'.$post->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Booking Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->purpose.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->category.'" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->room.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->meetingtype.'" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->meetingdate.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.date('G:i', strtotime($post->starttime)).'" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->total.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->total.' Person" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->total.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->total.'" class="form-control"/>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
            </div>
            <a href="edit/'.$post->id.'" class="btn btn-primary btn-sm" type="button"><i class="fa fa-edit"></i></a>
            ';
            if(Session::get('role') == 'user'){
            echo '<button class="btn btn-danger btn-sm" type="button" onclick="remove('.$post->id.')" ><i class="fa fa-trash"></i></button>
            ';}
            echo '</td>
        </tr>';
        }
    }
    public function completed(){
        if(Session::get('role') == 'admin'){
            $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.starttime,posts.endtime,posts.total,posts.postingdate,categories.name category,rooms.name room,users.name postuser,posts.status,posts.meetingtype from users,posts,categories,rooms where posts.status='booked' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id and posts.meetingdate < 
            CAST( GETDATE() AS Date ) order by posts.meetingdate asc");
        }else{
            $id=Session::get('id');
            $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.starttime,posts.endtime,posts.total,posts.postingdate,categories.name category,rooms.name room,users.name postuser,posts.status,posts.meetingtype from users,posts,categories,rooms where posts.status='booked' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id and posts.meetingdate < 
            CAST( GETDATE() AS Date ) and posts.postuser_id='$id' order by posts.meetingdate asc");
        }
        $i=1;
        foreach($posts as $post){
            echo 
           '
           <tr>
            <td class="align-middle text-center">
            '.$post->category.'
            </td>
            <td class="align-middle">'.$post->meetingdate.'</td>
            <td class="align-middle text-center">'.date('h:i a', strtotime($post->starttime)).'</td>
            <td class="align-middle text-center">'.date('h:i a', strtotime($post->endtime)).'</td>
            <td class="align-middle text-center">'.$post->total.'</td>
            <td class="align-middle text-center">'.$post->room.'</td>
            <td class="align-middle text-center">'.$post->meetingtype.'</td>
            <td class="align-middle text-center">'.$post->postuser.'</td>
            <td class="align-middle text-center">Completed</td>
            <td class="align-middle text-center">
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal'.$post->id.'"><i class="fa fa-eye"></i></button>

            <div class="modal fade" id="exampleModal'.$post->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Booking Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->purpose.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->category.'" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->room.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->meetingtype.'" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->meetingdate.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.date('G:i', strtotime($post->starttime)).'" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->total.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->total.' Person" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->total.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->total.'" class="form-control"/>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
            </div>
            </td>
        </tr>';
        }
    }
    public function booked(){
        if(Session::get('role') == 'admin'){
            $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.starttime,posts.endtime,posts.total,posts.postingdate,categories.name category,rooms.name room,users.name postuser,posts.status,posts.meetingtype from users,posts,categories,rooms where posts.status='booked' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id and posts.meetingdate >= 
            CAST( GETDATE() AS Date ) order by posts.meetingdate asc");
        }else{
            $id=Session::get('id');
            $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.starttime,posts.endtime,posts.total,posts.postingdate,categories.name category,rooms.name room,users.name postuser,posts.status,posts.meetingtype from users,posts,categories,rooms where posts.status='booked' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id and posts.meetingdate >= 
            CAST( GETDATE() AS Date ) and posts.postuser_id='$id' and users order by posts.meetingdate asc");
        }
        $i=1;
        foreach($posts as $post){
            echo 
           '
           <tr>
            <td class="align-middle text-center">
            '.$post->category.'
            </td>
            <td class="align-middle">'.$post->meetingdate.'</td>
            <td class="align-middle text-center">'.date('h:i a', strtotime($post->starttime)).'</td>
            <td class="align-middle text-center">'.date('h:i a', strtotime($post->endtime)).'</td>
            <td class="align-middle text-center">'.$post->total.'</td>
            <td class="align-middle text-center">'.$post->room.'</td>
            <td class="align-middle text-center">'.$post->meetingtype.'</td>
            <td class="align-middle text-center">'.$post->postuser.'</td>
            <td class="align-middle text-center">Booked</td>
            <td class="align-middle text-center">
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal'.$post->id.'"><i class="fa fa-eye"></i></button>

            <div class="modal fade" id="exampleModal'.$post->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Booking Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->purpose.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->category.'" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->room.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->meetingtype.'" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->meetingdate.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.date('G:i', strtotime($post->starttime)).'" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->total.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->total.' Person" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->total.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->total.'" class="form-control"/>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
            </div>
            <a href="edit/'.$post->id.'" class="btn btn-primary btn-sm" type="button"><i class="fa fa-edit"></i></a>
            ';
            if(Session::get('role') == 'user'){
            echo '<button class="btn btn-danger btn-sm" type="button" onclick="remove('.$post->id.')" ><i class="fa fa-trash"></i></button>
            ';}
            echo '</td>
        </tr>';
        }
    }
    public function rejected(){
        if(Session::get('role') == 'admin'){
            $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.starttime,posts.endtime,posts.total,posts.postingdate,categories.name category,rooms.name room,users.name postuser,posts.status,posts.meetingtype from users,posts,categories,rooms where posts.status='rejected' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id order by posts.meetingdate asc");
        }else{
            $id=Session::get('id');
            $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.starttime,posts.endtime,posts.total,posts.postingdate,categories.name category,rooms.name room,users.name postuser,posts.status,posts.meetingtype from users,posts,categories,rooms where posts.status='rejected' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id and posts.postuser_id='$id' order by posts.meetingdate asc");
        }
        $i=1;
        foreach($posts as $post){
            echo 
           '
           <tr>
            <td class="align-middle text-center">
            '.$post->category.'
            </td>
            <td class="align-middle">'.$post->meetingdate.'</td>
            <td class="align-middle text-center">'.date('h:i a', strtotime($post->starttime)).'</td>
            <td class="align-middle text-center">'.date('h:i a', strtotime($post->endtime)).'</td>
            <td class="align-middle text-center">'.$post->total.'</td>
            <td class="align-middle text-center">'.$post->room.'</td>
            <td class="align-middle text-center">'.$post->meetingtype.'</td>
            <td class="align-middle text-center">'.$post->postuser.'</td>
            <td class="align-middle text-center">Rejected</td>
            <td class="align-middle text-center">
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal'.$post->id.'"><i class="fa fa-eye"></i></button>

            <div class="modal fade" id="exampleModal'.$post->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Booking Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->purpose.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->category.'" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->room.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->meetingtype.'" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->meetingdate.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.date('G:i', strtotime($post->starttime)).'" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->total.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->total.' Person" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->total.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->total.'" class="form-control"/>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
            </div>
            </td>
        </tr>';
        }
    }

    public function today(){
        if(Session::get('role') == 'admin'){
            $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.starttime,posts.endtime,posts.total,posts.postingdate,categories.name category,rooms.name room,users.name postuser,posts.status,posts.meetingtype from users,posts,categories,rooms where posts.status='booked' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id and posts.meetingdate=CAST( GETDATE() AS Date ) order by posts.meetingdate asc");
        }else{
            $id=Session::get('id');
            $posts = DB::select("select posts.id,posts.purpose,posts.meetingdate,posts.starttime,posts.endtime,posts.total,posts.postingdate,categories.name category,rooms.name room,users.name postuser,posts.status,posts.meetingtype from users,posts,categories,rooms where posts.status='booked' and users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id and posts.meetingdate=CAST( GETDATE() AS Date ) order by posts.meetingdate asc");
        }
        $i=1;
        foreach($posts as $post){
            echo 
           '
           <tr>
            <td class="align-middle text-center">
            '.$post->category.'
            </td>
            <td class="align-middle">'.$post->meetingdate.'</td>
            <td class="align-middle text-center">'.date('h:i a', strtotime($post->starttime)).'</td>
            <td class="align-middle text-center">'.date('h:i a', strtotime($post->endtime)).'</td>
            <td class="align-middle text-center">'.$post->total.'</td>
            <td class="align-middle text-center">'.$post->room.'</td>
            <td class="align-middle text-center">'.$post->meetingtype.'</td>
            <td class="align-middle text-center">'.$post->postuser.'</td>
            <td class="align-middle text-center">On Going</td>
            <td class="align-middle text-center">
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal'.$post->id.'"><i class="fa fa-eye"></i></button>

            <div class="modal fade" id="exampleModal'.$post->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Booking Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->purpose.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->category.'" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->room.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->meetingtype.'" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->meetingdate.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.date('G:i', strtotime($post->starttime)).'" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->total.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->total.' Person" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <input type="text" id="email-vr" value="'.$post->total.'" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <input type="text" id="email-vr"  value="'.$post->total.'" class="form-control"/>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
            </div>
            </td>
        </tr>';
        }
    }
    public function booking(Request $r){
        $start;$end;$room;
        $post=new Post;
        $post->purpose=$r->input('purpose');
        $post->meetingdate=$r->input('meetingdate');
        $post->starttime=$r->input('starttime');
        $post->endtime=$r->input('endtime');
        // $post->meetingtime=$r->input('meetingtime');
        // $post->duration=$r->input('duration');
        $post->meetingtype=$r->input('meetingtype');
        // $post->remarks=$r->input('remarks');
        $post->total=$r->input('total');
        // $post->coffee=$r->input('coffee');
        // $post->snacks=$r->input('snacks');
        $post->postingdate=date('Y-m-d');
        $post->room_id=$r->input('room');
        $post->category_id=$r->input('category');
        $post->status='booked';
        $post->postuser_id=session()->get('id');
        // $sql="select posts.starttime,posts.endtime,rooms.name as room from posts,rooms where posts.room_id=rooms.id and posts.room_id='$r->input('room')' and posts.meetingdate='$r->input('meetingdate')' and cast(posts.starttime as time) <= '$r->input('starttime')' and cast(posts.endtime as time) >= '$r->input('starttime')' or  cast(posts.starttime as time) <= '$r->input('endtime')' and cast(posts.endtime as time) >= '$r->input('endtime')'";
        // $data=DB::select($sql);
        // if($data == null){
            $post->save();
            return "store";
        // }else{
        //     foreach($data as $row){
        //         $start=date('h:i A', strtotime($row->starttime));
        //         $end=date('h:i A', strtotime($row->endtime));
        //         $room=$row->room;
        //     }
        //     return "Sorry, $start to $end $room reserved";
        // }
    }

    public function hasbooked(Request $req){
        $start;$end;$room;
        $sql="select posts.starttime,posts.endtime,rooms.name as room from posts,rooms where posts.room_id=rooms.id and posts.room_id='$req->room' and posts.meetingdate='$req->date' and cast(posts.starttime as time) <= '$req->time' and cast(posts.endtime as time) >= '$req->time'";
        $data=DB::select($sql);
        foreach($data as $row){
            $start=date('h:i A', strtotime($row->starttime));
            $end=date('h:i A', strtotime($row->endtime));
            $room=$row->room;
        }
        $string = $data != null ? "Sorry, $start to $end $room reserved":"not booked";
        return $string;
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
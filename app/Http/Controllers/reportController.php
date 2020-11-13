<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
Use Session;

class reportController extends Controller
{
    public function search(Request $r){
        $status=$r->status;
        $datefrom=$r->datefrom;
        $dateto=$r->dateto;
        $query="select posts.id,posts.purpose,posts.meetingdate meetingdate,posts.meetingtime,posts.duration,posts.total,posts.postingdate,posts.snacks,posts.coffee,posts.remarks,categories.name category,rooms.name room,users.name postuser,posts.status,posts.approveuser,posts.approvedate,posts.comments,posts.meetingtype from users,posts,categories,rooms where users.id=posts.postuser_id and categories.id=posts.category_id and rooms.id=posts.room_id";
        if($status != ""){
            if($status == 'booked'){
                $query .=" and posts.meetingdate > CAST( GETDATE() AS Date )and posts.status = '$status'";
            }else if($status == 'completed'){
                $query .=" and posts.meetingdate <= CAST( GETDATE() AS Date )and posts.status = '$status'";
            }else{
                $query .=" and posts.status = '$status'";
            }
        }
        $query .=" and meetingdate between '$datefrom' and '$dateto'";
        $query .=" order by posts.meetingdate asc";
        $posts = DB::select($query);
        $i=1;
        foreach($posts as $post){
            echo '<tr>
            <td>'.$post->category.'</td>
            <td>'.$post->meetingdate.'</td>
            <td>'.date('G:i', strtotime($post->meetingtime)).'</td>
            <td>'.$post->duration.'</td>
            <td>'.$post->total.'</td>
            <td>'.$post->room.'</td>
            <td>'.$post->meetingtype.'</td>
            ';
            if(Session::get('role') == 'admin'){
            echo '<td>'.$post->postuser.'</td>';
            }
            echo '<td>'.$post->status.'</td>
            </tr>';
        }
    }   
}

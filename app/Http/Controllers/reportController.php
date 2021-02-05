<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use Session;

class reportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function search(Request $r){
        $status=$r->status;
        $datefrom=$r->datefrom;
        $dateto=$r->dateto;
        $query="select posts.id,posts.purpose,posts.meetingdate meetingdate,posts.starttime,posts.endtime,posts.total,posts.postingdate,posts.category category,posts.room room,users.name postuser,posts.status,posts.meetingtype from users,posts where users.id=posts.postuser_id";
        if($status != ""){
            if($status == 'booked'){
                $query .=" and posts.meetingdate >= CAST( GETDATE() AS Date ) and posts.status = 'booked'";
            }else if($status == 'completed'){
                $query .=" and posts.meetingdate < CAST( GETDATE() AS Date ) and posts.status = 'booked'";
            }
            else if($status == 'postponed'){
                $query .=" and posts.status = 'postponed'";
            }
            else{
                $query .=" and posts.status = 'rejected'";
            }
        }
        $query .=" and meetingdate between '$datefrom' and '$dateto'";
        $query .=" order by posts.meetingdate asc";
        $posts = DB::select($query);
        $i=1;
        foreach($posts as $post){
            echo '<tr>
            <td>'.$post->category.'</td>
            <td>'.$post->purpose.'</td>
            <td>'.$post->meetingdate.'</td>
            <td>'.date('h:i a', strtotime($post->starttime)).'</td>
            <td>'.date('h:i a', strtotime($post->endtime)).'</td>
            <td>'.$post->total.'</td>
            <td>'.$post->room.'</td>
            <td>'.$post->meetingtype.'</td>
            <td>'.$post->postuser.'</td>
            <td>'.$post->postingdate.'</td>
            <td>'.$post->status.'</td>
            </tr>';
        }
    }   
}

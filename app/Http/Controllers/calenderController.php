<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Room;
Use Session;


class calenderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.schedule');
    }

    public function postlist(){
    $val=[];
    $sql="select posts.meetingdate as date,rooms.name title,posts.starttime,posts.endtime from posts,rooms where posts.room_id=rooms.id and posts.status='booked' and posts.meetingdate >= CAST( GETDATE() AS Date )";
    $posts=DB::select($sql);
    foreach($posts as $post){
        $start=date('h:i', strtotime($post->starttime));
        $end=date('h:i', strtotime($post->endtime));
        $title=$start.'-'.$end.' '.$post->title;
        $val[] = [
            'date' => $post->date,
            'title' => $title,
        ];
    }
    return json_encode($val);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

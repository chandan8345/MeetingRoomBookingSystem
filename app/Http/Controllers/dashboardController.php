<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complete=0;$book=0;$waiting=0;
        $c = DB::select("select count(posts.status) complete from posts where posts.status='booked' and posts.meetingdate < 
        CAST( GETDATE() AS Date )");
        $b = DB::select("select count(posts.status) book from posts where posts.status='booked' and posts.meetingdate >= 
        CAST( GETDATE() AS Date )");
        $w = DB::select("select count(posts.status) waiting from posts where posts.status='waiting'");
        foreach($c as $row){$complete=$row->complete;}
        foreach($b as $row){$book=$row->book;}
        foreach($w as $row){$waiting=$row->waiting;}
        return view('pages.dashboard',['book' => $book,'waiting'=> $waiting,'complete'=> $complete]);
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
        //
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

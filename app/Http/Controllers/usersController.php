<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $r){
        $i=0;
        $email=$r->input('email');
        $password=$r->input('password');
        if(User::where('email', $email)->first()){
            $i++;
        }
        if(User::where('password', $password)->first()){
            $i++;
        }
        if($i == 2){
            $result=User::where('email', $email)->where('password', $password)->get();
            foreach($result as $r){
                session()->put('id',$r->id);  
                session()->put('name',$r->name); 
                session()->put('role','admin');
            }
            return $i;
        }else if($i == 1){
            return $i;
        }
        else{
            return $i;
        }
    }
    public function index()
    {
        return view('pages.signin');
    }

    public function profile()
    {
        return view('pages.profile');
    }

    public function reports()
    {
        return view('pages.reports');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
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

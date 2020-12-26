<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class roomsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function updateroom(Request $r, $id){
        Room::where('id', $id)->update($r->all());
        return "update";
    }
    public function deleteroom($id){
        Room::where('id',$id)->delete();
        return "remove";
    }
    public function roomlist(){
        $rooms=Room::all();
        $i=1;
        foreach($rooms as $room){
           echo 
           '<tr>
            <td class="align-middle text-center">'.$i++.'</td>
            <td id="name'.$room->id.'" onblur="updateName('.$room->id.')" contenteditable="true" class="align-middle text-center">
            '.$room->name.'
            </td>
            <td id="capacity'.$room->id.'" onblur="updateCapacity('.$room->id.')" contenteditable="true" class="align-middle text-center">'.$room->capacity.'</td>
            <td id="status'.$room->id.'" onblur="updateStatus('.$room->id.')" contenteditable="false" class="align-middle text-center">'.$room->status.'</td>
            <td class="align-middle text-center">
                <button class="btn btn-danger" onclick="remove('.$room->id.')"><i class="fas fa-trash"></i></button>
            </td>
        </tr>';
      }
    }
    public function index()
    {
        return view('pages.manage-rooms');
    }

    public function addroom(Request $r)
    {
        $room=new Room;
        $room->name=$r->input('name');
        $room->capacity=$r->input('capacity');
        $room->status=1;
        $room->user_id=session()->get('id');
        $room->save();
        return "store";
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class myController extends Controller
{
    public function index(){
        $users=User::all();
        return view('welcome')->with('users',$users);
    }
    
    public function create(Request $req){
        $user=new User;
        $user->name=$req->input('name');
        $user->email=$req->input('email');
        $user->phone=$req->input('phone');
        $user->address=$req->input('address');
        $user->save();
        return "create";
    }
    public function update(Request $r,$id){
        User::where('id', $id)->update($r->all());
        return "update";
    }

    public function remove($id){
        User::where('id',$id)->delete();
        return "remove";
    }
    
    public function userlist(){
        $users=User::all();
        $i=1;
        foreach($users as $user){
            echo '<tr>
            <td>'.$i++.'</td>
            <td id="name'.$user->id.'" onblur="updateName('.$user->id.')" contenteditable="true">'.$user->name.'</td>
            <td id="email'.$user->id.'" onblur="updateEmail('.$user->id.')" contenteditable="true">'.$user->email.'</td>
            <td id="address'.$user->id.'" onblur="updateAddress('.$user->id.')" contenteditable="true">'.$user->address.'</td>
            <td id="phone'.$user->id.'" onblur="updatePhone('.$user->id.')" contenteditable="true">'.$user->phone.'</td>
            <td><button type="button" onclick="remove('.$user->id.')" id="delete" class="btn btn-danger m-t-5 waves-effect">Delete</button>
    </td>
    </tr>';
      }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class categoryController extends Controller
{
    public function updatecategory(Request $r, $id){
        Category::where('id', $id)->update($r->all());
        return "update";
    }
    public function deletecategory($id){
        Category::where('id',$id)->delete();
        return "remove";
    }
    public function categorylist(){
        $categories=Category::all();
        $i=1;
        foreach($categories as $category){
           echo 
           '<tr>
            <td class="align-middle text-center">'.$i++.'</td>
            <td id="name'.$category->id.'" onblur="updateName('.$category->id.')" contenteditable="true" class="align-middle text-center">
            '.$category->name.'
            </td>
            <td id="status'.$category->id.'" onblur="updateStatus('.$category->id.')" contenteditable="false" class="align-middle text-center">'.$category->status.'</td>
            <td class="align-middle text-center">
                <button class="btn btn-danger" onclick="remove('.$category->id.')"><i class="fas fa-trash"></i></button>
            </td>
        </tr>';
      }
    }
    public function addcategory(Request $r)
    {
        $category=new Category;
        $category->name=strip_tags($r->input('name'));
        $category->status=1;
        $category->user_id=session()->get('id');
        $category->save();
        return "store";
    }
    public function index()
    {
        return view('pages.category');
    }
}

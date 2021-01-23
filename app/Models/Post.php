<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table='posts';
    protected $fillable=['purpose','meetingdate','starttime','endtime','meetingtype','total','postingdate','postuser_id','room_id','category_id','status','created_at','updated_at'];
    
    // public function category(){
    //     return $this->hasOne(Category::class,'category_id');
    // }
    public function room(){
        return $this->hasOne(Room::class,'id','room_id');
    }
    // public function postuser(){
    //     return $this->hasOne(User::class, 'postuser_id');
    // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table='posts';
    protected $fillable=['purpose','meetingdate','meetingtime','duration','meetingtype','remarks','comments','total','postingdate','approvedate' ,'approveuser','postuser_id','room_id','category_id','coffee','snacks','status','created_at','updated_at'];
}

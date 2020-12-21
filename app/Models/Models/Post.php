<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table='posts';
    protected $fillable=['purpose','meetingdate','starttime','endtime','meetingtype','total','postingdate','postuser_id','room_id','category_id','status','created_at','updated_at'];
}

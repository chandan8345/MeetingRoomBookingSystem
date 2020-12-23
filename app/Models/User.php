<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table='t_leave_users';
    protected $fillable=['name','password','email','staffid','mobile','created_at','uploaded_at'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table='users';
    //protected $fillable=['name','password','email','designation','staffid','mobile','ext','band','role','status','created_at','uploaded_at'];
}

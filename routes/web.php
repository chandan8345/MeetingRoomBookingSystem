<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\myController;


Route::get('/',[myController::class,'index']);
Route::post('/create',[myController::class,'create']);
Route::get('/update/{id}',[myController::class,'update']);
Route::get('/remove/{id}',[myController::class,'remove']);
Route::get('/userlist',[myController::class,'userlist']);
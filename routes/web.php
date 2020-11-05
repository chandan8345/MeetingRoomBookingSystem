<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\dashboardController;

//LOGIN
Route::get('/',[loginController::class,'index']);

//DASHBOARD
Route::get('/dashboard',[dashboardController::class,'index']);


Route::post('/create',[myController::class,'create']);
Route::get('/update/{id}',[myController::class,'update']);
Route::get('/remove/{id}',[myController::class,'remove']);
Route::get('/userlist',[myController::class,'userlist']);
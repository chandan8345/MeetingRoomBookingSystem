<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\roomsController;

//LOGIN
Route::get('/',[loginController::class,'index']);

//DASHBOARD
Route::get('/dashboard',[dashboardController::class,'index']);

//ROOMS
Route::get('/addrooms',[roomsController::class,'addrooms']);
Route::get('/managerooms',[roomsController::class,'managerooms']);

Route::post('/create',[myController::class,'create']);
Route::get('/update/{id}',[myController::class,'update']);
Route::get('/remove/{id}',[myController::class,'remove']);
Route::get('/userlist',[myController::class,'userlist']);
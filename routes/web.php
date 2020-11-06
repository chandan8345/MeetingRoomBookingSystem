<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usersController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\roomsController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\bookingController;
use App\Http\Controllers\calenderController;

//USERS
Route::get('/',[usersController::class,'index']);
Route::get('/profile',[usersController::class,'profile']);
Route::get('/reports',[usersController::class,'reports']);
Route::get('/logout',[usersController::class,'logout']);

//DASHBOARD
Route::get('/dashboard',[dashboardController::class,'index']);

//ROOMS
Route::get('/managerooms',[roomsController::class,'index']);

//Booking
Route::get('/quickbooking',[bookingController::class,'quickbooking']);
Route::get('/managebooking',[bookingController::class,'managebooking']);

//Category
Route::get('/category',[categoryController::class,'index']);

//Calender
Route::get('/schedule',[calenderController::class,'index']);


Route::post('/create',[myController::class,'create']);
Route::get('/update/{id}',[myController::class,'update']);
Route::get('/remove/{id}',[myController::class,'remove']);
Route::get('/userlist',[myController::class,'userlist']);
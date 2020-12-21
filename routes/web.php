<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usersController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\roomsController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\bookingController;
use App\Http\Controllers\calenderController;
use App\Http\Controllers\reportController;


Route::get('/',[usersController::class,'index']);
Route::post('/login',[usersController::class,'login']);

Route::group(['middleware' => 'usersession'], function () {
    
//USERS
Route::get('/profile',[usersController::class,'profile']);
Route::get('/reports',[usersController::class,'reports']);
Route::get('/logout',[usersController::class,'logout']);

//DASHBOARD
Route::get('/dashboard',[dashboardController::class,'index']);
Route::get('/count',[dashboardController::class,'count']);
Route::get('/countbooked',[dashboardController::class,'countbooked']);
Route::get('/countpostponed',[dashboardController::class,'countpostponed']);
Route::get('/countwaiting',[dashboardController::class,'countwaiting']);
Route::get('/countcompleted',[dashboardController::class,'countcompleted']);

//ROOMS
Route::get('/rooms',[roomsController::class,'index']);
Route::get('/roomlist',[roomsController::class,'roomlist']);
Route::get('/updateroom/{id}',[roomsController::class,'updateroom']);
Route::get('/deleteroom/{id}',[roomsController::class,'deleteroom']);
Route::post('/addroom',[roomsController::class,'addroom']);

//Reports
Route::get('/search',[reportController::class,'search']);

//Booking
Route::get('/quickbooking',[bookingController::class,'quickbooking']);
Route::get('/managebooking',[bookingController::class,'managebooking']);
Route::post('/booking',[bookingController::class,'booking']);
Route::post('/book',[bookingController::class,'book']);
Route::post('/updatepost',[bookingController::class,'updatepost']);
Route::get('/edit/{id}',[bookingController::class,'edit']);
Route::post('/setpostponed',[bookingController::class,'setpostponed']);
Route::post('/rebook',[bookingController::class,'rebook']);
Route::get('/reject/{id}',[bookingController::class,'reject']);
Route::get('/delete/{id}',[bookingController::class,'delete']);
Route::get('/waiting',[bookingController::class,'waiting']);
Route::get('/postponed',[bookingController::class,'postponed']);
Route::get('/booked',[bookingController::class,'booked']);
Route::get('/rejected',[bookingController::class,'rejected']);
Route::get('/completed',[bookingController::class,'completed']);
Route::get('/hasbooked',[bookingController::class,'hasbooked']);
Route::get('/userhasbooked',[bookingController::class,'userhasbooked']);
Route::get('/today',[bookingController::class,'today']);
Route::get('/setMaxCapacity',[bookingController::class,'capacity']);


//Category
Route::get('/category',[categoryController::class,'index']);
Route::get('/categorylist',[categoryController::class,'categorylist']);
Route::get('/updatecategory/{id}',[categoryController::class,'updatecategory']);
Route::get('/deletecategory/{id}',[categoryController::class,'deletecategory']);
Route::post('/addcategory',[categoryController::class,'addcategory']);

//Calender
Route::get('/schedule',[calenderController::class,'index']);


Route::post('/create',[myController::class,'create']);
Route::get('/update/{id}',[myController::class,'update']);
Route::get('/remove/{id}',[myController::class,'remove']);
Route::get('/userlist',[myController::class,'userlist']);

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

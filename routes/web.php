<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
  return view('pages.home');
})->name('home');

//Route Account

//Route Activity

//Route Activity Evaluation

//Route Administrator

//Route Career
Route::get('carreras', "CareerController@index")->name("view.careers");
//Route Category

//Route Department
Route::get('coordinaciones', "DepartmentController@index")->name("view.departments");
//Route Diploma

//Route Division
Route::get('divisiones', "DivisionController@index")->name("view.divisions");
//Route Faculty

//Route Instructor

//Route Instructor Evaluation

//Route Participant

//Route Professor Career

//Route Professor Category

//Route Professor

//Route Professor Division

//Route Professor Faculty

//Route Seminar Topic

//Route Venue
Route::get('salones', "VenueController@index")->name("view.venues");

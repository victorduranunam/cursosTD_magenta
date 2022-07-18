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
Route::get('administradores', 'AdministratorController@index')->name('view.administrators');
Route::get('administrador/crear', 'AdministratorController@create')->name('create.administrator');
Route::post('administrador/almacenar', 'AdministratorController@store')->name('store.administrator');
Route::get('administrador/actualizar/{administrator_id}', 'AdministratorController@edit')->name('edit.administrator');
Route::put('administrador/guardar/{administrator_id}', 'AdministratorController@update')->name('update.administrator');
Route::delete('administrador/eliminar/{administrator_id}', 'AdministratorController@delete')->name('delete.administrator');

//Route Career
Route::get('carreras', "CareerController@index")->name("view.careers");
//Route Category

//Route Department
Route::get('coordinaciones', "DepartmentController@index")->name("view.departments");
Route::get('coordinaciones/crear', "DepartmentController@create")->name("create.department");
Route::post('coordinaciones/almacenar', "DepartmentController@store")->name("store.department");
Route::get('coordinaciones/actualizar/{department_id}', "DepartmentController@edit")->name("edit.department");
Route::put('coordinaciones/guardar/{department_id}', "DepartmentController@update")->name('update.department');
Route::delete('coordinaciones/eliminar/{department_id}', "DepartmentController@delete")->name("delete.department");

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

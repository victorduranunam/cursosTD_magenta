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

//Route Activity Catalogue
Route::get('catalogo-actividades', 'ActivityCatalogueController@index')->name('view.activities.catalogue');
Route::get('catalogo-actividades/crear', 'ActivityCatalogueController@create')->name('create.activity.catalogue');
Route::post('catalogo-actividades/almacenar', 'ActivityCatalogueController@store')->name('store.activity.catalogue');
Route::get('catalogo-actividades/actualizar/{activity_catalogue_id}', 'ActivityCatalogueController@edit')->name('edit.activity.catalogue');
Route::put('catalogo-actividades/guardar/{activity_catalogue_id}', 'ActivityCatalogueController@update')->name('update.activity.catalogue');
Route::delete('catalogo-actividades/eliminar/{activity_catalogue_id}', 'ActivityCatalogueController@delete')->name('delete.activity.catalogue');

//Route Activity
Route::get('actividades','ActivityController@index')->name('view.activities');
Route::get('actividades/crear/{activity_catalogue_id}','ActivityController@create')->name('create.activity');
Route::post('actividades/almacenar','ActivityController@store')->name('store.activity');
Route::get('actividades/actualizar/{activity_id}','ActivityController@edit')->name('edit.activity');
Route::put('actividades/guardar/{activity_id}','ActivityController@update')->name('update.activity');
Route::delete('actividades/eliminar/{activity_id}','ActivityController@delete')->name('delete.activity');

//Route Activity Evaluation

//Route Administrator
Route::get('administradores', 'AdministratorController@index')->name('view.administrators');
Route::get('administrador/crear', 'AdministratorController@create')->name('create.administrator');
Route::post('administrador/almacenar', 'AdministratorController@store')->name('store.administrator');
Route::get('administrador/actualizar/{administrator_id}', 'AdministratorController@edit')->name('edit.administrator');
Route::put('administrador/guardar/{administrator_id}', 'AdministratorController@update')->name('update.administrator');
Route::delete('administrador/eliminar/{administrator_id}', 'AdministratorController@delete')->name('delete.administrator');

//Route Work Position
Route::get('puestos-trabajo', "WorkPositionController@index")->name("view.work-positions");
Route::post('puesto-trabajo/almacenar', "WorkPositionController@store")->name("store.work-position");
Route::put('puesto-trabajo/guardar/{work_position_id}', "WorkPositionController@update")->name('update.work-position');
Route::delete('puesto-trabajo/eliminar/{work_position_id}', "WorkPositionController@delete")->name("delete.work-position");

//Route Department
Route::get('coordinaciones', "DepartmentController@index")->name("view.departments");
Route::get('coordinaciones/crear', "DepartmentController@create")->name("create.department");
Route::post('coordinaciones/almacenar', "DepartmentController@store")->name("store.department");
Route::get('coordinaciones/actualizar/{department_id}', "DepartmentController@edit")->name("edit.department");
Route::put('coordinaciones/guardar/{department_id}', "DepartmentController@update")->name('update.department');
Route::delete('coordinaciones/eliminar/{department_id}', "DepartmentController@delete")->name("delete.department");

//Route Diploma
Route::get('diplomas', "DiplomaController@index")->name("view.diplomas");
Route::post('diplomas/almacenar', "DiplomaController@store")->name("store.diploma");
Route::put('diplomas/guardar/{diploma_id}', "DiplomaController@update")->name('update.diploma');
Route::delete('diplomas/eliminar/{diploma_id}', "DiplomaController@delete")->name("delete.diploma");

//Route Division
Route::get('divisiones', "DivisionController@index")->name("view.divisions");
Route::post('divisiones/almacenar', "DivisionController@store")->name("store.division");
Route::put('divisiones/guardar/{division_id}', "DivisionController@update")->name('update.division');
Route::delete('divisiones/eliminar/{division_id}', "DivisionController@delete")->name("delete.division");

//Route Instructor
Route::get('instructores/{activity_id}', "InstructorController@index")->name("view.instructors");
Route::post('instructores/almacenar/{professor_id}', "InstructorController@store")->name("store.instructor");
Route::delete('instructores/eliminar/{instructor_id}', "InstructorController@delete")->name("delete.instructor");

//Route Instructor Evaluation

//Route Participant
Route::get('participantes/{activity_id}',"ParticipantController@index")->name("view.participants");
Route::get('participantes/crear/{activity_id}', "ParticipantController@create")->name("create.participant");
Route::post('participantes/almacenar/{professor_id}', "ParticipantController@store")->name("store.participant");
Route::get('participantes/actualizar/{participant_id}', 'ParticipantController@edit')->name('edit.participant');
Route::put('participantes/guardar/{participant_id}', "ParticipantController@update")->name('update.participant');
Route::delete('participantes/eliminar/{participant_id}', "ParticipantController@delete")->name("delete.participant");

//Route Professor
Route::get('profesores', "ProfessorController@index")->name("view.professors");
Route::get('profesores/crear', "ProfessorController@create")->name("create.professor");
Route::post('profesores/almacenar', "ProfessorController@store")->name("store.professor");
Route::get('profesores/actualizar/{professor_id}', "ProfessorController@edit")->name("edit.professor");
Route::put('profesores/guardar/{professor_id}', "ProfessorController@update")->name('update.professor');
Route::delete('profesores/eliminar/{professor_id}', "ProfessorController@delete")->name("delete.professor");

//Route Professor Position

//Route Professor Division

//Route Seminar Topic

//Route Venue
Route::get('salones', "VenueController@index")->name("view.venues");
Route::get('salones/crear', "VenueController@create")->name("create.venue");
Route::post('salones/almacenar', "VenueController@store")->name("store.venue");
Route::get('salones/actualizar/{venue_id}', "VenueController@edit")->name("edit.venue");
Route::put('salones/guardar/{venue_id}', "VenueController@update")->name('update.venue');
Route::delete('salones/eliminar/{venue_id}', "VenueController@delete")->name("delete.venue");
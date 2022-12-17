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

Route::group( ['middleware' => 'guest'], function() {

  // Route Welcome
  Route::get('/', function () {
      return view('welcome');
  })->name('welcome')->withoutMiddleware(['guest']);
  
  // Route Home
  Route::get('/hogar', function () {
    return view('pages.home');
  })->name('home');
  
  // Route for login
  Route::get('/ingresar', function () {
    return view('pages.login');
  })->name('login')->withoutMiddleware(['guest']);
  
  // Route Login
  Route::post('/autenticacion', 'AdministratorController@auth')->name('auth')->withoutMiddleware(['guest']);
  Route::get('/salir', 'AdministratorController@logout')->name('logout');
  
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
  Route::get('actividades/crear/constancias/{activity_id}','ActivityController@createCertificates')->name('create.activity-certificates');
  Route::get('actividades/crear/reconocimientos/{activity_id}','ActivityController@createRecognitions')->name('create.activity-recognitions');
  Route::get('actividades/descargar/publicidad/{activity_id}','ActivityController@downloadPromo')->name('download.activity-promo');
  Route::post('actividades/descargar/constancias/{activity_id}','ActivityController@downloadCertificates')->name('download.activity-certificates');
  Route::post('actividades/descargar/reconocimientos/{activity_id}','ActivityController@downloadRecognitions')->name('download.activity-recognitions');
  Route::get('actividades/descargar/verificacion-datos/{activity_id}', "ActivityController@downloadVerifyDataSheet")->name('download.activities-verify-data-sheet');
  Route::get('actividades/descargar/identificadores/{activity_id}', "ActivityController@downloadIdentifiers")->name('download.activities-identifiers');
  Route::get('actividades/descargar/hoja-asistencia/{activity_id}', "ActivityController@downloadAttendanceSheet")->name('download.activities-attendance-sheet');
  Route::get('actividades/descargar/exportacion','ActivityController@downloadExport')->name('download.activities-export');
  Route::get('actividades/descargar/libro-de-folios','ActivityController@downloadKeysBook')->name('download.activities-keys-book');
  Route::get('actividades/descargar/reporte-general','ActivityController@downloadGeneralReport')->name('download.activities-general-record');
  Route::get('actividades/descargar/reporte-sugerencias','ActivityController@downloadSuggestionsReport')->name('download.activities-suggestions-record');

  
  //Route Activity Evaluation
  Route::get('evaluacion-actividad/ver/{participant_id}', 'ActivityEvaluationController@view')->name('view.activity-evaluation');
  Route::get('evaluacion-actividad/crear/{participant_id}', 'ActivityEvaluationController@create')->name('create.activity-evaluation');
  Route::post('evaluacion-actividad/almacenar/{participant_id}', 'ActivityEvaluationController@store')->name('store.activity-evaluation');
  
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
  Route::get('departamentos', "DepartmentController@index")->name("view.departments");
  Route::get('departamentos/crear', "DepartmentController@create")->name("create.department");
  Route::post('departamentos/almacenar', "DepartmentController@store")->name("store.department");
  Route::get('departamentos/actualizar/{department_id}', "DepartmentController@edit")->name("edit.department");
  Route::put('departamentos/guardar/{department_id}', "DepartmentController@update")->name('update.department');
  Route::delete('departamentos/eliminar/{department_id}', "DepartmentController@delete")->name("delete.department");
  Route::get('departamentos/descargar/reporte-criterio-aceptacion/{department_id}','DepartmentController@downloadAcceptanceCriteriaReport')->name('download.department-acceptance-criteria-report');
  Route::get('departamentos/descargar/reporte-participantes/{department_id}','DepartmentController@downloadParticipantsReport')->name('download.department-participants-report');
  Route::get('departamentos/descargar/reporte-evaluacion/{department_id}','DepartmentController@downloadEvaluationReport')->name('download.department-evaluation-report');
  
  //Route Diploma
  Route::get('diplomados', "DiplomaController@index")->name("view.diplomas");
  Route::post('diplomados/almacenar', "DiplomaController@store")->name("store.diploma");
  Route::put('diplomados/guardar/{diploma_id}', "DiplomaController@update")->name('update.diploma');
  Route::delete('diplomados/eliminar/{diploma_id}', "DiplomaController@delete")->name("delete.diploma");
  Route::get('diplomados/descargar-diplomas/{diploma_id}', "DiplomaController@downloadDiplomas")->name('download.diplomas');
  
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
  Route::get('evaluacion-instructor/ver/{participant_id}', 'InstructorEvaluationController@view')->name('view.instructor-evaluation');
  Route::get('evaluacion-instructor/crear/{instructor_id}', 'InstructorEvaluationController@create')->name('create.instructor-evaluation');
  Route::post('evaluacion-instructor/almacenar/{instructor_id}', 'InstructorEvaluationController@store')->name('store.instructor-evaluation');
  Route::put('evaluacion-instructor/guardar/{instructor_evaluation_id}', 'InstructorEvaluationController@update')->name('update.instructor-evaluation');
  Route::delete('evaluacion-instructor/eliminar/{instructor_evaluation_id}', 'InstructorEvaluationController@delete')->name('delete.instructor-evaluation');

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
  Route::get('profesor/descargar/reporte-actividades/{professor_id}', "ProfessorController@downloadRecord")->name("download.professor-record");
  Route::post('profesores/almacenar', "ProfessorController@store")->name("store.professor");
  Route::get('profesores/actualizar/{professor_id}', "ProfessorController@edit")->name("edit.professor");
  Route::put('profesores/guardar/{professor_id}', "ProfessorController@update")->name('update.professor');
  Route::delete('profesores/eliminar/{professor_id}', "ProfessorController@delete")->name("delete.professor");
  
  //Route Professor Position
  Route::get('puestos/profesor/{professor_id}', "ProfessorPositionController@index")->name("view.professor-positions");
  Route::post('puestos/profesor/crear/{professor_id}', "ProfessorPositionController@store")->name("store.professor-position");
  Route::delete('puestos/eliminar/{profesor_position_id}', "ProfessorPositionController@delete")->name("delete.professor-position");
  
  //Route Professor Division
  Route::get('divisiones/profesor/{profesor_id}', "ProfessorDivisionController@index")->name("view.professor-divisions");
  Route::post('divisiones/profesor/crear/{professor_id}', "ProfessorDivisionController@store")->name("store.professor-division");
  Route::delete('divisiones/profesor/eliminar/{professor_division_id}', "ProfessorDivisionController@delete")->name("delete.professor-division");
  
  //Route Seminar Topic
  
  //Route Venue
  Route::get('salones', "VenueController@index")->name("view.venues");
  Route::get('salones/crear', "VenueController@create")->name("create.venue");
  Route::post('salones/almacenar', "VenueController@store")->name("store.venue");
  Route::get('salones/actualizar/{venue_id}', "VenueController@edit")->name("edit.venue");
  Route::put('salones/guardar/{venue_id}', "VenueController@update")->name('update.venue');
  Route::delete('salones/eliminar/{venue_id}', "VenueController@delete")->name("delete.venue");

});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::group(['middleware' => 'guest'], function () {

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
  Route::get('catalogo-actividades/buscar', 'ActivityCatalogueController@search')->name('search.activity.catalogue');
  Route::post('catalogo-actividades/almacenar', 'ActivityCatalogueController@store')->middleware('verifyUserDepartment')->name('store.activity.catalogue');
  Route::get('catalogo-actividades/actualizar/{activity_catalogue_id}', 'ActivityCatalogueController@edit')->middleware('verifyUserDepartment')->name('edit.activity.catalogue');
  Route::put('catalogo-actividades/guardar/{activity_catalogue_id}', 'ActivityCatalogueController@update')->middleware('verifyUserDepartment')->name('update.activity.catalogue');
  Route::delete('catalogo-actividades/eliminar/{activity_catalogue_id}', 'ActivityCatalogueController@delete')->middleware('verifyUserDepartment')->name('delete.activity.catalogue');

  //Route Activity
  Route::get('actividades', 'ActivityController@index')->name('view.activities');
  Route::get('actividades/buscar', 'ActivityController@search')->name('search.activities');
  Route::get('actividades/crear/{activity_catalogue_id}', 'ActivityController@create')->middleware('verifyUserDepartment')->name('create.activity');
  Route::post('actividades/almacenar', 'ActivityController@store')->middleware('verifyUserDepartment')->name('store.activity');
  Route::get('actividades/actualizar/{activity_id}', 'ActivityController@edit')->middleware('verifyUserDepartment')->name('edit.activity');
  Route::put('actividades/guardar/{activity_id}', 'ActivityController@update')->middleware('verifyUserDepartment')->name('update.activity');
  Route::delete('actividades/eliminar/{activity_id}', 'ActivityController@delete')->middleware('verifyUserDepartment')->name('delete.activity');
  Route::get('actividades/crear/constancias/{activity_id}', 'ActivityController@createCertificates')->middleware('verifyUserDepartment')->name('create.activity-certificates');
  Route::get('actividades/crear/reconocimientos/{activity_id}', 'ActivityController@createRecognitions')->middleware('verifyUserDepartment')->name('create.activity-recognitions');
  Route::get('actividades/descargar/publicidad/{activity_id}', 'ActivityController@downloadPromo')->middleware('verifyUserDepartment')->name('download.activity-promo');
  Route::post('actividades/descargar/constancias/{activity_id}', 'ActivityController@downloadCertificates')->middleware('verifyUserDepartment')->name('download.activity-certificates');
  Route::post('actividades/descargar/reconocimientos/{activity_id}', 'ActivityController@downloadRecognitions')->middleware('verifyUserDepartment')->name('download.activity-recognitions');
  Route::get('actividades/descargar/verificacion-datos/{activity_id}', "ActivityController@downloadVerifyDataSheet")->middleware('verifyUserDepartment')->name('download.activities-verify-data-sheet');
  Route::get('actividades/descargar/identificadores/{activity_id}', "ActivityController@downloadIdentifiers")->middleware('verifyUserDepartment')->name('download.activities-identifiers');
  Route::get('actividades/descargar/hoja-asistencia/{activity_id}', "ActivityController@downloadAttendanceSheet")->middleware('verifyUserDepartment')->name('download.activities-attendance-sheet');
  Route::get('actividades/descargar/exportacion', 'ActivityController@downloadExport')->middleware('verifyUserPrivileges')->name('download.activities-export');
  Route::get('actividades/descargar/libro-de-folios', 'ActivityController@downloadKeysBook')->middleware('verifyUserPrivileges')->name('download.activities-keys-book');
  Route::get('actividades/descargar/reporte-general', 'ActivityController@downloadGeneralReport')->name('download.activities-general-record');
  Route::get('actividades/descargar/reporte-sugerencias', 'ActivityController@downloadSuggestionsReport')->name('download.activities-suggestions-record');
  Route::get('actividades/descargar/reporte-evaluacion/{activity_id}', 'ActivityController@downloadEvaluationReport')->middleware('verifyUserDepartment')->name('download.activity-evaluation-report');
  Route::get('actividades/descargar/reporte-instructores/{activity_id}', 'ActivityController@downloadInstructorsEvaluationReport')->middleware('verifyUserDepartment')->name('download.instructors-evaluation-report');

  //Route Activity Evaluation
  Route::get('evaluacion-actividad/ver/{participant_id}', 'ActivityEvaluationController@view')->middleware('verifyUserDepartment')->name('view.activity-evaluation');
  Route::get('evaluacion-actividad/crear', 'ActivityEvaluationController@create')->name('create.activity-evaluation')->withoutMiddleware(['guest']);
  Route::post('evaluacion-actividad/almacenar/{participant_id}', 'ActivityEvaluationController@store')->name('store.activity-evaluation')->withoutMiddleware(['guest']);

  //Route Administrator
  Route::get('administradores', 'AdministratorController@index')->middleware('verifyUserPrivileges')->name('view.administrators');
  Route::get('administradores/buscar', 'AdministratorController@search')->middleware('verifyUserPrivileges')->name('search.administrators');
  Route::get('administrador/crear', 'AdministratorController@create')->middleware('verifyUserPrivileges')->name('create.administrator');
  Route::post('administrador/almacenar', 'AdministratorController@store')->middleware('verifyUserPrivileges')->name('store.administrator');
  Route::get('administrador/actualizar/{administrator_id}', 'AdministratorController@edit')->middleware('verifyUserPrivileges')->name('edit.administrator');
  Route::put('administrador/guardar/{administrator_id}', 'AdministratorController@update')->middleware('verifyUserPrivileges')->name('update.administrator');
  Route::delete('administrador/eliminar/{administrator_id}', 'AdministratorController@delete')->middleware('verifyUserPrivileges')->name('delete.administrator');

  //Route Work Position
  Route::get('puestos-trabajo', "WorkPositionController@index")->middleware('verifyUserPrivileges')->name("view.work-positions");
  Route::get('puestos-trabajo/buscar', "WorkPositionController@search")->middleware('verifyUserPrivileges')->name("search.work-positions");
  Route::post('puesto-trabajo/almacenar', "WorkPositionController@store")->middleware('verifyUserPrivileges')->name("store.work-position");
  Route::put('puesto-trabajo/guardar/{work_position_id}', "WorkPositionController@update")->middleware('verifyUserPrivileges')->name('update.work-position');
  Route::delete('puesto-trabajo/eliminar/{work_position_id}', "WorkPositionController@delete")->middleware('verifyUserPrivileges')->name("delete.work-position");

  //Route Department
  Route::get('departamentos', "DepartmentController@index")->middleware('verifyUserPrivileges')->name("view.departments");
  Route::get('departamentos/buscar', "DepartmentController@search")->middleware('verifyUserPrivileges')->name("search.departments");
  Route::get('departamentos/crear', "DepartmentController@create")->middleware('verifyUserPrivileges')->name("create.department");
  Route::post('departamentos/almacenar', "DepartmentController@store")->middleware('verifyUserPrivileges')->name("store.department");
  Route::get('departamentos/actualizar/{department_id}', "DepartmentController@edit")->middleware('verifyUserPrivileges')->name("edit.department");
  Route::put('departamentos/guardar/{department_id}', "DepartmentController@update")->middleware('verifyUserPrivileges')->name('update.department');
  Route::delete('departamentos/eliminar/{department_id}', "DepartmentController@delete")->middleware('verifyUserPrivileges')->name("delete.department");
  Route::get('departamentos/descargar/reporte-criterio-aceptacion/{department_id}', 'DepartmentController@downloadAcceptanceCriteriaReport')->middleware('verifyUserPrivileges')->name('download.department-acceptance-criteria-report');
  Route::get('departamentos/descargar/reporte-participantes/{department_id}', 'DepartmentController@downloadParticipantsReport')->middleware('verifyUserPrivileges')->name('download.department-participants-report');
  Route::get('departamentos/descargar/reporte-evaluacion/{department_id}', 'DepartmentController@downloadEvaluationReport')->middleware('verifyUserPrivileges')->name('download.department-evaluation-report');

  //Route Diploma
  Route::get('diplomados', "DiplomaController@index")->name("view.diplomas");
  Route::post('diplomados/almacenar', "DiplomaController@store")->name("store.diploma");
  Route::put('diplomados/guardar/{diploma_id}', "DiplomaController@update")->name('update.diploma');
  Route::delete('diplomados/eliminar/{diploma_id}', "DiplomaController@delete")->name("delete.diploma");
  Route::get('diplomados/{diploma_id}/generar-diplomas', "DiplomaController@createDiplomaCertificates")->name('create.diploma-certificates');
  Route::post('diplomados/{diploma_id}/descargar-diplomas', "DiplomaController@downloadDiplomaCertificates")->name('download.diploma-certificates');

  //Route Division
  Route::get('divisiones', "DivisionController@index")->middleware('verifyUserPrivileges')->name("view.divisions");
  Route::get('divisiones/buscar', "DivisionController@search")->middleware('verifyUserPrivileges')->name("search.divisions");
  Route::post('divisiones/almacenar', "DivisionController@store")->middleware('verifyUserPrivileges')->name("store.division");
  Route::put('divisiones/guardar/{division_id}', "DivisionController@update")->middleware('verifyUserPrivileges')->name('update.division');
  Route::delete('divisiones/eliminar/{division_id}', "DivisionController@delete")->middleware('verifyUserPrivileges')->name("delete.division");

  //Route Instructor
  Route::get('instructores/{activity_id}', "InstructorController@index")->middleware('verifyUserDepartment')->name("view.instructors");
  Route::get('instructores/buscar/{activity_id}', "InstructorController@search")->middleware('verifyUserDepartment')->name("search.instructors");
  Route::post('instructores/almacenar/{professor_id}', "InstructorController@store")->middleware('verifyUserDepartment')->name("store.instructor");
  Route::delete('instructores/eliminar/{instructor_id}', "InstructorController@delete")->middleware('verifyUserDepartment')->name("delete.instructor");

  //Route Instructor Evaluation
  Route::get('evaluacion-instructor/ver/{participant_id}', 'InstructorEvaluationController@view')->middleware('verifyUserDepartment')->name('view.instructor-evaluation');
  Route::get('evaluacion-instructor/crear/{participant_id}', 'InstructorEvaluationController@create')->name('create.instructor-evaluation')->withoutMiddleware(['guest']);
  Route::post('evaluacion-instructor/almacenar/{instructor_id}', 'InstructorEvaluationController@store')->name('store.instructor-evaluation')->withoutMiddleware(['guest']);

  //Route Participant
  Route::get('participantes/{activity_id}', "ParticipantController@index")->middleware('verifyUserDepartment')->name("view.participants");
  Route::get('participantes/buscar/{activity_id}', "ParticipantController@search")->middleware('verifyUserDepartment')->name("search.participants");
  Route::get('participantes/crear/{activity_id}', "ParticipantController@create")->middleware('verifyUserDepartment')->name("create.participant");
  Route::post('participantes/almacenar/{professor_id}', "ParticipantController@store")->middleware('verifyUserDepartment')->name("store.participant");
  Route::get('participantes/actualizar/{participant_id}', 'ParticipantController@edit')->middleware('verifyUserDepartment')->name('edit.participant');
  Route::put('participantes/guardar/{participant_id}', "ParticipantController@update")->middleware('verifyUserDepartment')->name('update.participant');
  Route::delete('participantes/eliminar/{participant_id}', "ParticipantController@delete")->middleware('verifyUserDepartment')->name("delete.participant");
  Route::get('participantes/buscar/encuesta', "ParticipantController@searchEvaluation")->name("search.evaluation")->withoutMiddleware(['guest']);

  //Route Professor
  Route::get('profesores', "ProfessorController@index")->name("view.professors");
  Route::get('profesores/buscar', "ProfessorController@search")->name("search.professors");
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

  //Route Venue
  Route::get('sedes', "VenueController@index")->name("view.venues");
  Route::get('sedes/buscar', "VenueController@search")->name("search.venues");
  Route::get('sedes/crear', "VenueController@create")->name("create.venue");
  Route::post('sedes/almacenar', "VenueController@store")->name("store.venue");
  Route::get('sedes/actualizar/{venue_id}', "VenueController@edit")->name("edit.venue");
  Route::put('sedes/guardar/{venue_id}', "VenueController@update")->name('update.venue');
  Route::delete('sedes/eliminar/{venue_id}', "VenueController@delete")->name("delete.venue");
});
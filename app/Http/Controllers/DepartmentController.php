<?php
namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityEvaluation;
use App\Models\Participant;
use App\Models\Administrator;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use PDF;


class DepartmentController extends Controller
{
  public function index()
  {
      try {

        $departments = Department::orderByRaw('unaccent(lower(name))')->get();

        return view("pages.view-departments")
          ->with("departments", $departments);

      } catch (\Illuminate\Database\QueryException $th) {
        
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');
      }
  }

  public function create() {
    $administrators = Administrator::where('job', 'C')
      ->orderByRaw('last_name || mothers_last_name || name')
      ->get();
    return view ("pages.create-department")
      ->with('administrators', $administrators);
  }

  public function store(Request $req){
    
    try{

      $department = new Department();
      $department->department_id = DB::select("select nextval('department_seq')")[0]->nextval;
      $department->name = $req->name;
      $department->abbreviation = $req->abbreviation;
      $department->administrator_id = $req->administrator_id;
      $department->save();

      return redirect()
        ->route('view.departments')
        ->with('success', 'Coordinación creada correctamente');

    } catch (\Illuminate\Database\QueryException $th) {
      if($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'No hay conexión con la base de datos.');
      else
        return redirect()
          ->back()
          ->with('warning', 'Error al almacenar, verifique sus datos.')
          ->withInput();
    }
  }

  public function edit($department_id){

    try {

        $department = Department::findOrFail($department_id);
        $administrators = Administrator::where('job', 'C')
          ->orderByRaw('last_name || mothers_last_name || name')
          ->get();
        
        return view("pages.update-department")
          ->with("department", $department)
          ->with('administrators', $administrators);
  
      } catch (\Illuminate\Database\QueryException $th) {
        
        return redirect()
          ->route('view.departments')
          ->with('danger', 'Problema con la base de datos');
      }

  }

  public function update(Request $req, $department_id){
    
    try {

      $department = Department::findOrFail($department_id);
      $department->name = $req->name;
      $department->abbreviation = $req->abbreviation;
      $department->administrator_id = $req->administrator_id;
      $department->save();

      return redirect()
        ->route('edit.department', $department->department_id)
        ->with('success', 'Cambios realizados.');

    } catch (\Illuminate\Database\QueryException $th) {
      
      if($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'No hay conexión con la base de datos.');
      else
        return redirect()
          ->back()
          ->with('department', $department)
          ->with('warning', 'Error al almacenar, verifique sus datos.');
    }
  }

  public function delete($department_id){
    
    try {
      
      $department = Department::findOrFail($department_id);
      $department->delete();
      
      return redirect()
        ->route('view.departments')
        ->with('success', 'Eliminado correctamente.');

    } catch (\Illuminate\Database\QueryException $th) {
      
      if($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'No hay conexión con la base de datos.');
      else
        return redirect()
          ->back()
          ->with('warning', 'Error al eliminar la coordinación.');
    }
  }
//TODO::evaluaciones 1s,1i,2s,2i.
  public function downloadAcceptanceCriteriaReport(Request $req, $department_id){
    $department = Department::findOrFail($department_id);
    $department->evaluations = ActivityEvaluation::join('participant as p',
                                             'p.participant_id',
                                             '=',
                                             'activity_evaluation.participant_id')
                                      ->join('activity as a',
                                             'a.activity_id',
                                             '=',
                                             'p.participant_id')
                                      ->join('activity_catalogue as ac', 
                                            'ac.activity_catalogue_id', 
                                            '=', 
                                            'a.activity_catalogue_id')
                                      ->where('a.year', $req->year_search)
                                      ->where('ac.department_id', $department_id)
                                      ->select('a.activity_id', 
                                              'a.activity_catalogue_id',
                                              'activity_evaluation.*')
                                      ->get();
    
    return $department;
  }

  public function downloadParticipantsReport(Request $req, $department_id){
    $period = $req->year_search.'-'.$req->num_search.$req->type_search;
    $department = Department::findOrFail($department_id);
    $activities = Activity::join('activity_catalogue as ac', 
                                 'ac.activity_catalogue_id', 
                                 '=', 
                                 'activity.activity_catalogue_id')
                          ->where('activity.year', $req->year_search)
                          ->where('activity.num', $req->num_search)
                          ->where('activity.type', $req->type_search)
                          ->where('ac.department_id', $department_id)
                          ->select('activity.activity_id', 
                                   'activity.max_quota', 
                                   'activity.activity_catalogue_id')
                          ->get();
    if($activities->isEmpty())
      return redirect()
           ->back()
           ->with('warning', 'La coordinación elegida no cuenta con cursos en el periodo ingresado.');
           
    foreach($activities as $activity){

      $activity->name = $activity->getName();

      $participants = Participant::where('activity_id', $activity->activity_id)
                                  ->select('participant_id', 'additional', 'mistimed')
                                  ->get();

      $activity->total_participants = $participants->count();

      $mistimed = $participants->countBy(function ($activity){
          return $activity->mistimed ? 'true' : 'false';
      });
      $activity->mistimed_participants = empty($mistimed['true']) 
                                       ? 0 
                                       : $mistimed['true'];

      $additional = $participants->countBy(function ($activity){
        return $activity->additional ? 'true' : 'false';
      });

      $activity->additional_participants = empty($additional['true'])
                                         ? 0
                                         : $additional['true'];

      $activity->average = $activity->total_participants
                         ? $activity->total_participants / $activity->max_quota * 100
                         : 'No calculable';
    }

    $pdf = PDF::loadView('docs.department-participants-report',
          [
            'activities' => $activities,
            'period' => $period,
            'department' => $department->name
          ]
          )->setPaper('letter');

    return $pdf->download('Reporte_Criterio_Aceptacion_'.$department->getFileName().'.pdf');
  }

  public function downloadEvaluationReport(Request $req, $department_id){
    return 'Evaluacion';
  }
}

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
use stdClass;

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

  public function downloadAcceptanceCriteriaReport(Request $req, $department_id){
    $department = Department::findOrFail($department_id);
    $activities = DB::table('activity AS a')
                    ->select('a.activity_id', 'ae.activity_evaluation_id', 
                              'a.num','a.type','ae.question_4')
                    ->join('activity_catalogue AS ac',
                           'ac.activity_catalogue_id',
                           '=',
                           'a.activity_catalogue_id')
                    ->join('participant AS p',
                           'p.activity_id',
                           '=',
                           'a.activity_id')
                    ->join('activity_evaluation AS ae',
                           'ae.participant_id',
                           '=',
                           'p.participant_id')
                    ->where('a.year', $req->year_search)
                    ->where('ac.department_id', $department_id)
                    ->get();

    
    $department->period_1s = (object) ['avg' => 0, 'sum' => 0, 'activities' => collect()];
    $department->period_1i = (object) ['avg' => 0, 'sum' => 0, 'activities' => collect()];
    $department->period_2s = (object) ['avg' => 0, 'sum' => 0, 'activities' => collect()];
    $department->period_2i = (object) ['avg' => 0, 'sum' => 0, 'activities' => collect()];

    foreach($activities as $activity){
      if($activity->type === 's' && $activity->num === 1)
        $p = 'period_1s';
      elseif($activity->type === 'i' && $activity->num === 1)
        $p = 'period_1i';
      elseif($activity->type === 's' && $activity->num === 2)
        $p = 'period_2s';
      elseif($activity->type === 'i' && $activity->num === 2)
        $p = 'period_2i';
      
      if($department->$p->activities->doesntContain('activity_id',$activity->activity_id))
        $department->$p->activities->push((object) [
          'activity_id'  => $activity->activity_id,
          'sum'     => $activity->question_4 ? 100 : 0,
          'avg'     => $activity->question_4 ? 100 : 0,
          'evals' => collect()->push((object) [
            'activity_evaluation_id' => $activity->activity_evaluation_id, 
            'question_4'             => $activity->question_4
          ])
        ]);
      else{
        $searched_act = $department->$p->activities->firstWhere('activity_id', $activity->activity_id);
        $searched_act->evals->push((object) [
            'activity_evaluation_id' => $activity->activity_evaluation_id, 
            'question_4' => $activity->question_4
        ]);
        $searched_act->sum += $activity->question_4 ? 100 : 0;
        $searched_act->avg = $searched_act->sum/$searched_act->evals->count();
      }
    }
    
    $department->period_1s->sum = $department->period_1s->activities->sum('avg');
    $department->period_1s->avg = $department->period_1s->activities->count()
                                ? $department->period_1s->sum
                                / $department->period_1s->activities->count()
                                : 0;


    $department->period_1i->sum = $department->period_1i->activities->sum('avg');
    $department->period_1i->avg = $department->period_1i->activities->count()
                                ? $department->period_1i->sum
                                / $department->period_1i->activities->count()
                                : 0;

    $department->period_2s->sum = $department->period_2s->activities->sum('avg');
    $department->period_2s->avg = $department->period_2s->activities->count() 
                                ? $department->period_2s->sum
                                / $department->period_2s->activities->count() 
                                : 0;

    $department->period_2i->sum = $department->period_2i->activities->sum('avg');
    $department->period_2i->avg = $department->period_2i->activities->count()
                                ? $department->period_2i->sum
                                / $department->period_2i->activities->count()
                                : 0;
                                
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

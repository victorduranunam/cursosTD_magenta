<?php
namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\Department;
use Exception;
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

  public function search (Request $req)
  {
    try {

      $query = NULL;

      if ( $req->search_type === 'name' OR 
           $req->search_type === 'abbreviation' )

        $query = 'unaccent('.$req->search_type.') ILIKE unaccent(\'%'
               . $req->words . '%\')';

      if ( $query ) {

        $departments = Department::whereRaw($query)
          ->orderByRaw('unaccent(lower(name))')
          ->get();

      } else {

        $departments = collect();

      }

      return view("pages.view-departments")
          ->with("departments",$departments);

    } catch (\Illuminate\Database\QueryException $th) {

      return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');

    }
  }

  public function create() {
    return view ("pages.create-department");
  }

  public function store(Request $req){
    
    try{

      $department = new Department();
      $department->department_id = DB::select("select nextval('department_seq')")[0]->nextval;
      $department->name = $req->name;
      $department->abbreviation = $req->abbreviation;

      $department->save();

      return redirect()
        ->route('view.departments')
        ->with('success', 'Departamento creado correctamente');

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
        
        return view("pages.update-department")
          ->with("department", $department);
  
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
          ->with('warning', 'Error al eliminar el departamento.');
    }
  }

  public function downloadAcceptanceCriteriaReport(Request $req, $department_id){
    try{

      // Find Department
      $department = Department::findOrFail($department_id);

      // Find Evaluations linked to the department and the requested year
      $evals = DB::table('activity AS a')
                    ->select('a.activity_id', 'ac.key', 
                             'ae.activity_evaluation_id', 'a.num','a.type',
                             'ae.question_4')
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

      // Return if it isn't evaluations.
      if($evals->isEmpty())
        return redirect()
             ->back()
             ->with('warning', 'No hay actividades asociadas a ese '.
                               'departamento en ese año.');
                                
      // Prepare data
      $department->period_1s = (object) 
                            ['avg' => 0, 'sum' => 0, 'activities' => collect()];
      $department->period_1i = (object) 
                            ['avg' => 0, 'sum' => 0, 'activities' => collect()];
      $department->period_2s = (object) 
                            ['avg' => 0, 'sum' => 0, 'activities' => collect()];
      $department->period_2i = (object) 
                            ['avg' => 0, 'sum' => 0, 'activities' => collect()];

    // Associate each evaluation to his period.
    foreach($evals as $eval){
      if($eval->type === 's' && $eval->num === 1)
        $p = 'period_1s';
      elseif($eval->type === 'i' && $eval->num === 1)
        $p = 'period_1i';
      elseif($eval->type === 's' && $eval->num === 2)
        $p = 'period_2s';
      elseif($eval->type === 'i' && $eval->num === 2)
        $p = 'period_2i';
      
      // Check if the activity of the evaluation is already in the data
      // if the activity doesn't have any evaluations is not in the final data.
      if($department->$p->activities
          ->doesntContain('activity_id',$eval->activity_id))
        $department->$p->activities->push(
          (object) [
            'activity_id'  => $eval->activity_id,
            'key'          => $eval->key,
            'sum'          => $eval->question_4 ? 100 : 0,
            'avg'          => $eval->question_4 ? 100 : 0,
            'evals'        => collect()->push(
              (object) [
                'activity_evaluation_id' => $eval->activity_evaluation_id, 
                'question_4'             => $eval->question_4
              ])
        ]);
      else{
        $searched_act = $department
                     -> $p
                     -> activities
                     ->firstWhere('activity_id', $eval->activity_id);

        $searched_act -> evals
                      -> push((object) [
            'activity_evaluation_id' => $eval->activity_evaluation_id, 
            'question_4' => $eval->question_4
        ]);
        $searched_act->sum += $eval->question_4 ? 100 : 0;
        $searched_act->avg = round(
          $searched_act->sum/$searched_act->evals->count(),2
        );
      }
    }
    
    $department->period_count = 4;
    // Calculate average per period
    $department->period_1s
               ->activities_count = $department->period_1s
                                               ->activities
                                               ->count();

    if( $department->period_1s->activities_count == 0){
      $department->period_1s->sum = 0;
      $department->period_1s->avg = 0;
      $department->period_count--;
    } else {
      $department->period_1s->sum = $department->period_1s 
                                               -> activities
                                               -> sum('avg');
                                      
      $department->period_1s->avg = round(
        $department->period_1s->activities_count ?
        $department->period_1s->sum                 /
        $department->period_1s->activities_count :
        0,2
      );
    }

    $department -> period_2s
                -> activities_count = $department -> period_2s
                                                  -> activities
                                                  -> count();

    if( $department -> period_2s -> activities_count == 0){
      $department -> period_2s -> sum = 0;
      $department -> period_2s -> avg = 0;
      $department->period_count--;
    } else {
      $department -> period_2s -> sum = $department -> period_2s 
                                                    -> activities
                                                    -> sum('avg');
                                      
      $department -> period_2s ->avg = round(
          $department -> period_2s -> activities_count
        ? $department -> period_2s -> sum
        / $department -> period_2s -> activities_count
        : 0,2
      );
    }

    $department -> period_1i
                -> activities_count = $department -> period_1i
                                                  -> activities
                                                  -> count();

    if( $department -> period_1i -> activities_count == 0){
      $department -> period_1i -> sum = 0;
      $department -> period_1i -> avg = 0;
      $department->period_count--;
    } else {
      $department -> period_1i -> sum = $department -> period_1i 
                                                    -> activities
                                                    -> sum('avg');
                                      
      $department -> period_1i ->avg = round(
          $department -> period_1i -> activities_count
        ? $department -> period_1i -> sum
        / $department -> period_1i -> activities_count
        : 0,2
      );
    }

    $department -> period_2i
                -> activities_count = $department -> period_2i
                                                  -> activities
                                                  -> count();

    if( $department -> period_2i -> activities_count == 0){
      $department -> period_2i -> sum = 0;
      $department -> period_2i -> avg = 0;
      $department->period_count--;
    } else {
      $department -> period_2i -> sum = $department -> period_2i 
                                                    -> activities
                                                    -> sum('avg');
                                      
      $department -> period_2i ->avg = round(
          $department -> period_2i -> activities_count
        ? $department -> period_2i -> sum
        / $department -> period_2i -> activities_count
        : 0,2
      );
    }
    
    $department->sum = $department->period_1s->avg + 
                       $department->period_2s->avg + 
                       $department->period_1i->avg + 
                       $department->period_2i->avg;

    $department->avg = round($department->sum / $department->period_count,2);

    $pdf = PDF::loadView('docs.department-acceptance-criteria-report',
      [
        'department' => $department,
        'year'       => $req->year_search
      ]
    )->setPaper('letter');

    return $pdf->download(
      'Reporte_Criterio_Aceptacion_'.$department->getFileName().'.pdf'
    );

    } catch (Exception $th){
      return dd($th);
      return redirect()
        ->back()
        ->with('danger', 'Problema al generar el formato');
    }
    
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
           ->with('warning', 'El departamento elegido no cuenta con cursos en el periodo ingresado.');
           
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

    return $pdf->download('Reporte_Participantes_'.$department->getFileName().'.pdf');
  }

  public function downloadEvaluationReport(Request $req, $department_id){
    try {

      // ---------------------------- QUERIES ----------------------------------

      $department = Department::findOrFail($department_id);

      // Get all the activities
      $activities = DB::table('activity AS a')
        ->join('activity_catalogue AS ac', 
                'ac.activity_catalogue_id', 
                'a.activity_catalogue_id')
        ->where('ac.department_id', $department_id)
        ->where('a.year', $req->year_search)
        ->where('a.num', $req->num_search)
        ->where('a.type', $req->type_search)
        ->select('a.activity_id', 'ac.key', 'ac.name', 
                 'ac.type', 'a.max_quota', 'ac.hours')
        ->get();

      // Get all the instructor_evaluations
      $instructor_evaluations = DB::table('instructor AS i')
        ->join('professor AS pr', 'pr.professor_id', 'i.professor_id')
        ->join('activity AS a', 'a.activity_id', 'i.activity_id')
        ->join('activity_catalogue AS ac', 
               'ac.activity_catalogue_id',
               'a.activity_catalogue_id'
              )
        ->leftJoin('instructor_evaluation AS ie', 
                   'ie.instructor_id', 
                   'i.instructor_id'
                  )
        ->whereIn('a.activity_id', $activities->pluck('activity_id'))
        ->select('a.activity_id', 'ac.key', 'pr.name',
                 'pr.last_name', 'pr.mothers_last_name', 'ie.*')
        ->get();

      // Get all the activity_evaluations
      $activity_evaluations = DB::table('participant AS p')
        ->leftJoin('activity_evaluation AS ae', 'p.participant_id', 'ae.participant_id')
        ->join('activity AS a', 'a.activity_id', 'p.activity_id')
        ->whereIn('a.activity_id', $activities->pluck('activity_id'))
        ->select('ae.*', 'p.attendance', 'p.accredited', 'a.activity_id')
        ->get();

      // return $activity_evaluations->dd();

      // -----------------------------------------------------------------------

      // --------------- SECOND SECTION: PARTICIPANT COUNTS --------------------

      // Maximum quota
      $activities->max_quota = $activities->sum('max_quota');
      
      // Hours total
      $activities->hours = $activities->sum('hours');

      // Participants count
      $activity_evaluations->enrolled = $activity_evaluations->count();

      // Attendance count
      $activity_evaluations->attendance = $activity_evaluations->sum('attendance');

      // Accredited count
      $activity_evaluations->accredited = $activity_evaluations->sum('accredited');

      // Areas
      $areas_count = ['P' => 0, 'H' => 0, 'C' => 0, 'O' => 0];

      // Schedules
      $schedules = collect([]);

      // Suggestions
      $suggestions = collect([]);

      // Subjects
      $subjects = collect([]);

      // Evaluations count
      $activity_evaluations->count = $activity_evaluations->sum(function ($p){
        return $p->activity_evaluation_id ? 1 : 0;
      });

      if(!$activity_evaluations->count)
        return redirect()
             ->back()
             ->with('warning', 'No existen encuestas de evaluación registradas'.
                               ' en todo el periodo para ninguna actividad.'.
                               ' Para generar el reporte es necesario que'.
                               ' exista al menos una.');
      // -----------------------------------------------------------------------

      // --------------- THIRD SECTION: OCCUPANCE FACTOR -----------------------
      $occupance_factor = round(
        $activity_evaluations->attendance / 
        $activities->max_quota * 100, 2);

      // -----------------------------------------------------------------------

      // ------------ FOURTH SECTION: RECOMMENDATION FACTOR --------------------
      $recommendation_factor = round(
        $activity_evaluations->sum('question_4') / 
        $activity_evaluations->count * 100, 2);

      // -----------------------------------------------------------------------

      // ------------ FIFTH SECTION: ACCREDITANCE FACTOR -----------------------
      if($activity_evaluations->attendance)
        $accredited_factor = round($activity_evaluations->accredited / 
                                   $activity_evaluations->attendance * 100, 2
                                  );
      else
        $accredited_factor = "Sin asistentes";

      // -----------------------------------------------------------------------

      // --------- SIXTH SECTION: ACTIVITIES & DEPARTMENT QUALITY FACTOR -------
      foreach($activity_evaluations as $ae){
        
        $activity_answers = 0;
        $department_answers = 0;

        $activity_positive_answers = 0;
        $department_positive_answers = 0;

        if($ae->question_1_1){
          $activity_answers++;
          if($ae->question_1_1 == 80 || $ae->question_1_1 == 95 || $ae->question_1_1 == 100)
            $activity_positive_answers++;
        }

        if($ae->question_1_2){
          $activity_answers++;
          if($ae->question_1_2 == 80 || $ae->question_1_2 == 95 || $ae->question_1_2 == 100)
            $activity_positive_answers++;
        }

        if($ae->question_1_3){
          $activity_answers++;
          if($ae->question_1_3 == 80 || $ae->question_1_3 == 95 || $ae->question_1_3 == 100)
            $activity_positive_answers++;
        }

        if($ae->question_1_4){
          $activity_answers++;
          if($ae->question_1_4 == 80 || $ae->question_1_4 == 95 || $ae->question_1_4 == 100)
            $activity_positive_answers++;
        }

        if($ae->question_1_5){
          $activity_answers++;
          if($ae->question_1_5 == 80 || $ae->question_1_5 == 95 || $ae->question_1_5 == 100)
            $activity_positive_answers++;
        }

        if($ae->question_3_1){
          $department_answers++;
          if($ae->question_3_1 == 80 || $ae->question_3_1 == 95 || $ae->question_3_1 == 100)
            $department_positive_answers++;
        }

        if($ae->question_3_2){
          $department_answers++;
          if($ae->question_3_2 == 80 || $ae->question_3_2 == 95 || $ae->question_3_2 == 100)
            $department_positive_answers++;
        }

        if($ae->question_3_3){
          $department_answers++;
          if($ae->question_3_3 == 80 || $ae->question_3_3 == 95 || $ae->question_3_3 == 100)
            $department_positive_answers++;
        }

        if($ae->question_3_4){
          $department_answers++;
          if($ae->question_3_4 == 80 || $ae->question_3_4 == 95 || $ae->question_3_4 == 100)
            $department_positive_answers++;
        }

        $suggestions->push([
          'best'        => $ae->question_6_1 ? $ae->question_6_1 : '',
          'suggestions' => $ae->question_6_2 ? $ae->question_6_2 : '',
          'others'      => $ae->question_6_3 ? $ae->question_6_3 : ''
        ]);

        if($ae->question_7_1){
          $areas = collect(str_split($ae->question_7_1));
          if($areas->contains('P'))
            $areas_count['P']++;
          if($areas->contains('H'))
            $areas_count['H']++;
          if($areas->contains('C'))
            $areas_count['C']++;
          if($areas->contains('O'))
            $areas_count['O']++;
        }

        if($ae->question_7_2)
          $subjects->push($ae->question_7_2);


        $schedules->push([
          'sem' => $ae->question_8_1 ? $ae->question_8_1 : '',
          'int' => $ae->question_8_2 ? $ae->question_8_2 : '',
        ]);
      }

      $activity_quality_factor = $activity_positive_answers / 
                                 $activity_answers * 100;

      $department_quality_factor = $department_positive_answers / 
                                   $department_answers * 100;
      // -----------------------------------------------------------------------

      // ------------------- EIGHTH SECTION: INSTRUCTORS -----------------------
      $instructors = collect([]);

      foreach ($instructor_evaluations as $ie) {

        if ($instructors->contains('instructor_id', $ie->instructor_id)) {
            $instructors
              ->firstWhere('instructor_id', $ie->instructor_id)['evaluations']
              ->push([
                'instructor_evaluation_id' => $ie->instructor_evaluation_id,
                'average'                  => $ie->instructor_evaluation_id ? (
                  $ie->question_1 +
                  $ie->question_2 +
                  $ie->question_3 +
                  $ie->question_4 +
                  $ie->question_5 +
                  $ie->question_6 +
                  $ie->question_7 +
                  $ie->question_8
                ) / 8 : 0
              ]);
        } else{
          $instructors->push([
            'instructor_id' => $ie->instructor_id,
            'name' => $ie->name,
            'last_name' => $ie->last_name,
            'mothers_last_name' => $ie->mothers_last_name,
            'activity_key' => $ie->key.'-'.$ie->activity_id,
            'evaluations' => collect([[
              'instructor_evaluation_id' => $ie->instructor_evaluation_id,
              'average'                  => $ie->instructor_evaluation_id ? (
                $ie->question_1 +
                $ie->question_2 +
                $ie->question_3 +
                $ie->question_4 +
                $ie->question_5 +
                $ie->question_6 +
                $ie->question_7 +
                $ie->question_8
                ) / 8 : 0
              ]])
          ]);
        }
      }
      // -----------------------------------------------------------------------

      // ------------------------- PDF DOWNLOAD --------------------------------

      $pdf = PDF::loadView(
        'docs.department-evaluation-report',
        [
          'period'                    => $req->year_search.'-'.
                                         $req->num_search.
                                         $req->type_search,
          'department_name'           => $department->name,
          'count_attendance'          => $activity_evaluations->attendance,
          'count_accredited'          => $activity_evaluations->accredited,
          'count_participants'        => $activity_evaluations->enrolled,
          'count_evaluations'         => $activity_evaluations->count,
          'activity_quality_factor'   => $activity_quality_factor,
          'department_quality_factor' => $department_quality_factor,
          'occupance_factor'          => $occupance_factor,
          'recommendation_factor'     => $recommendation_factor,
          'accredited_factor'         => $accredited_factor,
          'suggestions'               => $suggestions,
          'subjects'                  => $subjects,
          'schedules'                 => $schedules,
          'areas_count'               => $areas_count,
          'instructors'               => $instructors,
          'activities'                => $activities
        ]
      )->setPaper('letter');

      return $pdf->download(
        'Reporte_Evaluacion_'.$department->getFileName().'.pdf'
      );

    } catch (Exception $th) {
      if ($th->getMessage() === 'Division by zero')
        return redirect()
             ->back()
             ->with('danger', 'Ocurrió una división por cero en alguna fórmula.');
      else
        return dd($th);
    }
  }
}

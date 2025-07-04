<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityCatalogue;
use Illuminate\Http\Request;
use App\Models\ActivityEvaluation;
use App\Models\Participant;
use App\Models\Professor;
use App\Models\Student;
use Exception;
use Illuminate\Support\Facades\DB;



class ActivityEvaluationController extends Controller
{

  public function create(Request $req) {
    try {
      $professor = Student::where("email", $req->email)->get()->first();
      
      if(!$professor){
        return redirect()->back()->with(
          'danger', " Email no registrado."
        );
      }
      try{
        //$group_key = explode("-", $req->group_key);
        //$key = $group_key[0];
        //$activity_id = $group_key[1];
      } catch(Exception $e){
        return redirect()->back()->with(
          'danger', "Formato de clave inválido."
        );
      }


      

      $key=$req->group_key;
      $activity_catalogue = ActivityCatalogue::where('key', $key)->first();
      
      

      if(!$activity_catalogue)
        return redirect()->back()->with(
          'danger', "Clave de grupo incorrecta."
        );


      //dd($activity_catalogue->activity_catalogue_id);
     
     // $activity = Activity::where('activity_catalogue_id', $activity_catalogue->activity_catalogue_id)
     //                     ->where('activity_id', $activity_id)
     //                     ->first();

      $activity = Activity::where('activity_catalogue_id', $activity_catalogue->activity_catalogue_id)
                          ->first();


      if(!$activity)
        return redirect()->back()->with(
          'danger', "Clave de grupo incorrecta."
        );

      $participant = Participant::where('student_id', 
        $professor->student_id)
      ->where('activity_id', $activity->activity_id)
      ->get()
      ->first();


      if(!$participant)
        return redirect()->back()->with('danger', 'Participante no encontrado');

      $evaluation = ActivityEvaluation::where('participant_id', $participant->participant_id)
        ->get()
        ->first();

      if($evaluation)
        return redirect()->route('create.instructor-evaluation', $participant->participant_id)->with(
          'warning', "Evaluación de actividad contestada anteriormente. Continue con los instructores."
        );

      if($activity_catalogue->type == 'CO'){
        $activity_string_1 = 'de la conferencia';
        $activity_string_2 = 'la conferencia';
      } else if($activity_catalogue->type == 'SE') {
        $activity_string_1 = 'del seminario';
        $activity_string_2 = 'el seminario';
      } else if($activity_catalogue->type == 'CU') {
        $activity_string_1 = 'del curso';
        $activity_string_2 = 'el curso';
      } else if($activity_catalogue->type == 'CT') {
        $activity_string_1 = 'del curso-taller';
        $activity_string_2 = 'el curso-taller';
      } else if($activity_catalogue->type == 'TA') {
        $activity_string_1 = 'del taller';
        $activity_string_2 = 'el taller';
      } else if($activity_catalogue->type == 'EV') {
        $activity_string_1 = 'del evento';
        $activity_string_2 = 'el evento';
      } else if($activity_catalogue->type == 'FO') {
        $activity_string_1 = 'del foro';
        $activity_string_2 = 'el foro';
      } else if($activity_catalogue->type == 'DI') {
        $activity_string_1 = 'del módulo de diplomado';
        $activity_string_2 = 'el módulo de diplomado';
      } else {
        return redirect()->back()->with('danger', 'Error con el tipo de actividad.');
      }

      $data = array(
        'participant_name'  => $professor->name.' '.
                               $professor->last_name.' '.
                               $professor->mothers_last_name,
        'activity_string_1' => $activity_string_1,
        'activity_string_2' => $activity_string_2,
        'activity_id'       => $activity->activity_id,
        'activity_name'     => $activity_catalogue->name,
        'participant_id'    => $participant->participant_id
      );
      
      return view('pages.create-activity-evaluation')
           ->with('data', $data);

    } catch (\Illuminate\Database\QueryException $th) {
      if ($th->getCode() == 7)
        return redirect()
          ->back()
          ->with('danger', 'No hay conexión con la base de datos.');
      else
        return redirect()
          ->back()
          ->with('danger', 'Problema con la base de datos.');
    }
  }
  
  public function view($participant_id) {

    try {
      $activity_evaluation = ActivityEvaluation::where('participant_id', $participant_id)->first();
      
     
      if(!$activity_evaluation){
        return redirect()->back()->with('warning', 'El estudiante aún no ha evaluado la actividad.');
      }


      // $participant = DB::table('participant as pt')
      //  ->join('professor as p', 'p.professor_id', 'pt.professor_id')
      //  ->join('activity as a', 'a.activity_id', 'pt.activity_id')
      //  ->join('activity_catalogue as ac', 'ac.activity_catalogue_id',
      //          'a.activity_catalogue_id')
      //  ->select('pt.participant_id', 'pt.activity_id','p.name', 'p.last_name',
      //            'p.mothers_last_name','ac.name as activity_name', 
      //            'ac.type as activity_type')
      //  ->where('pt.participant_id', $activity_evaluation->participant_id)
      //  ->get()
      //  ->first();


      $participant = DB::table('participant as pt')
          ->join('student as s', 's.student_id', 'pt.student_id') // Cambio aquí
          ->join('activity as a', 'a.activity_id', 'pt.activity_id')
          ->join('activity_catalogue as ac', 'ac.activity_catalogue_id', 'a.activity_catalogue_id')
          ->select(
              'pt.participant_id',
              'pt.activity_id',
              's.name',                // Cambio aquí
              's.last_name',           // Cambio aquí
              's.mothers_last_name',   // Cambio aquí
              'ac.name as activity_name',
              'ac.type as activity_type'
          )
          ->where('pt.participant_id', $activity_evaluation->participant_id)
          ->get()
          ->first();


      //dd($participant);

      if(!$participant)
        return redirect()->back()->with('warning', 'Participante no encontrado');
      
      $participant->name = $participant->name     .' '.
                           $participant->last_name.' '.
                           $participant->mothers_last_name;

      if($participant->activity_type == 'CO'){
        $participant->activity_string_1 = 'de la conferencia';
        $participant->activity_string_2 = 'la conferencia';
      } else if($participant->activity_type == 'SE') {
        $participant->activity_string_1 = 'del seminario';
        $participant->activity_string_2 = 'el seminario';
      } else if($participant->activity_type == 'CU') {
        $participant->activity_string_1 = 'del curso';
        $participant->activity_string_2 = 'el curso';
      } else if($participant->activity_type == 'CT') {
        $participant->activity_string_1 = 'del curso-taller';
        $participant->activity_string_2 = 'el curso-taller';
      } else if($participant->activity_type == 'TA') {
        $participant->activity_string_1 = 'del taller';
        $participant->activity_string_2 = 'el taller';
      } else if($participant->activity_type == 'EV') {
        $participant->activity_string_1 = 'del evento';
        $participant->activity_string_2 = 'el evento';
      } else if($participant->activity_type == 'FO') {
        $participant->activity_string_1 = 'del foro';
        $participant->activity_string_2 = 'el foro';
      } else if($participant->activity_type == 'DI') {
        $participant->activity_string_1 = 'del módulo de diplomado';
        $participant->activity_string_2 = 'el módulo de diplomado';
      } else {
        return redirect()->back()->with('danger', 'Error con el tipo de actividad.');
      }

      unset(
        $participant->last_name, 
        $participant->mothers_last_name, 
        $participant->activity_type
      );

      return view('pages.view-activity-evaluation')
           ->with('activity_evaluation', $activity_evaluation)
           ->with('participant', $participant);

    } catch (\Illuminate\Database\QueryException $th) {
      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'No hay conexión con la base de datos.');
      else
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');
    }
  }
  
  public function store(Request $req, $participant_id) {
    try {
      
      if(ActivityEvaluation::where('participant_id', $participant_id)->get()->isNotEmpty())
        return redirect()
             ->route('search.evaluation')
             ->with('warning', 'La encuesta ya ha sido contestada.');

      $activity_evaluation = new ActivityEvaluation();
      $activity_evaluation->activity_evaluation_id = DB::select("select nextval('activity_evaluation_seq')")[0]->nextval;
      $activity_evaluation->participant_id = $participant_id;

      $activity_evaluation->question_1_1 = $req->question_1_1;
      $activity_evaluation->question_1_2 = $req->question_1_2;
      $activity_evaluation->question_1_3 = $req->question_1_3;
      $activity_evaluation->question_1_4 = $req->question_1_4;
      $activity_evaluation->question_1_5 = $req->question_1_5;
      $activity_evaluation->question_2_1 = $req->question_2_1;
      $activity_evaluation->question_2_2 = $req->question_2_2;
      $activity_evaluation->question_2_3 = $req->question_2_3;
      $activity_evaluation->question_2_4 = $req->question_2_4;
      $activity_evaluation->question_3_1 = $req->question_3_1;
      $activity_evaluation->question_3_2 = $req->question_3_2;
      $activity_evaluation->question_3_3 = $req->question_3_3;
      $activity_evaluation->question_3_4 = $req->question_3_4;
      $activity_evaluation->question_4   = $req->question_4;
      $activity_evaluation->question_5   = isset($req->question_5) ? implode('',$req->question_5) : NULL;
      $activity_evaluation->question_6_1 = $req->question_6_1;
      $activity_evaluation->question_6_2 = $req->question_6_2;
      $activity_evaluation->question_6_3 = $req->question_6_3;
      $activity_evaluation->question_7_1 = isset($req->question_7_1) ? implode('',$req->question_7_1) : NULL;
      $activity_evaluation->question_7_2 = $req->question_7_2;
      $activity_evaluation->question_8_1 = $req->question_8_1;
      $activity_evaluation->question_8_2 = $req->question_8_2;
      
      $activity_evaluation->save();

      return redirect()
           ->route('create.instructor-evaluation', $participant_id)
           ->with('success', 'Evaluación de actividad creada correctamente. Continue con los instructores.');

    } catch (\Illuminate\Database\QueryException $th) {
      if ($th->getCode() == 7)
        return redirect()
          ->route('search.evaluation')
          ->with('danger', 'No hay conexión con la base de datos.');
      elseif ($th->getCode() == 23502)
        return 
             redirect()
             ->route('search.evaluation')
             ->with('danger', 'Campos erróneos. Intente de nuevo.');
      else
        return redirect()
          ->route('search.evaluation')
          ->with('danger', 'Problema con la base de datos.');
    }
  }
}

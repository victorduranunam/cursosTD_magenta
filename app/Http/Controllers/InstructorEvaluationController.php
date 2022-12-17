<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstructorEvaluation;
use Illuminate\Support\Facades\DB;
use App\Models\Participant;
use App\Models\Instructor;

class InstructorEvaluationController extends Controller
{

  public function view($participant_id) {
    try{
      $participant = Participant::findOrFail($participant_id);
      $participant->name = $participant->getFullName();
      $participant->activity_name = $participant->getActivityName();
      $instructors = Instructor::where('instructor.activity_id',$participant->activity_id)
                               ->get();
      foreach($instructors as $instructor)
        $instructor->evaluation = InstructorEvaluation::where('instructor_id', 
                                                        $instructor->instructor_id
                                                      )->first();
      return view('pages.view-instructor-evaluation')
            ->with('participant', $participant)
            ->with('instructors',$instructors);
    } catch(\Illuminate\Database\QueryException $th){
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

  //TODO, CHECAR LOS DEMAS METODOS, SERAN PARA EL PARTICIPANTE
  public function create($participant_id) {
    try{
      $participant = Participant::findOrFail($participant_id);
      $participant->name = $participant->getFullName();
      $participant->activity_name = $participant->getActivityName();
      $instructors = Instructor::where('instructor.activity_id',$participant->activity_id)
                               ->get();
      foreach($instructors as $instructor)
        $instructor->evaluation = InstructorEvaluation::where('instructor_id', 
                                                        $instructor->instructor_id
                                                      )->first();
      return view('pages.create-instructor-evaluation')
            ->with('participant', $participant)
            ->with('instructors',$instructors);
    } catch(\Illuminate\Database\QueryException $th){
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
  
  public function store(Request $req, $instructor_id) {
    try{
      $instructor_evaluation = new InstructorEvaluation(); 
      $instructor_evaluation->instructor_evaluation_id = DB::select("select nextval('instructor_evaluation_seq')")[0]->nextval;
      $instructor_evaluation->question_1 = $req->question_1;
      $instructor_evaluation->question_2 = $req->question_2;
      $instructor_evaluation->question_3 = $req->question_3;
      $instructor_evaluation->question_4 = $req->question_4;
      $instructor_evaluation->question_5 = $req->question_5;
      $instructor_evaluation->question_6 = $req->question_6;
      $instructor_evaluation->question_7 = $req->question_7;
      $instructor_evaluation->question_8 = $req->question_8;
      $instructor_evaluation->question_9 = $req->question_9;
      $instructor_evaluation->question_10 = $req->question_10;
      $instructor_evaluation->question_11 = $req->question_11;
      $instructor_evaluation->instructor_id = $instructor_id;
      $instructor_evaluation->participant_id = $req->participant_id;

      $instructor_evaluation->save();

      return redirect()
          ->route('create.instructor-evaluation', $instructor_evaluation->participant_id)
          ->with('success', 'Evaluación guardada correctamente');

    }catch (\Illuminate\Database\QueryException $th) {
      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'No hay conexión con la base de datos.');

      elseif($th->getCode() == 23502)
        return redirect()
          ->back()
          ->with('danger', 'Todas las preguntas son obligatorias.');
      else
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');  
    }
  }

  public function update(Request $req, $instructor_evaluation_id) {
    try{

      $instructor_evaluation = InstructorEvaluation::findOrFail($instructor_evaluation_id); 
      $instructor_evaluation->question_1 = $req->question_1;
      $instructor_evaluation->question_2 = $req->question_2;
      $instructor_evaluation->question_3 = $req->question_3;
      $instructor_evaluation->question_4 = $req->question_4;
      $instructor_evaluation->question_5 = $req->question_5;
      $instructor_evaluation->question_6 = $req->question_6;
      $instructor_evaluation->question_7 = $req->question_7;
      $instructor_evaluation->question_8 = $req->question_8;
      $instructor_evaluation->question_9 = $req->question_9;
      $instructor_evaluation->question_10 = $req->question_10;
      $instructor_evaluation->question_11 = $req->question_11;

      $instructor_evaluation->save();
      
      return redirect()
          ->route('create.instructor-evaluation', $instructor_evaluation->participant_id)
          ->with('success', 'Evaluación modificada correctamente');
  }catch (\Illuminate\Database\QueryException $th) {
      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'No hay conexión con la base de datos.');
          
      elseif($th->getCode() == 23502)
        return redirect()
          ->back()
          ->with('danger', 'Todas las preguntas son obligatorias.');
      else
        return redirect()
        ->route('home')
        ->with('danger', 'Problema con la base de datos.');  
    }
  }

  public function delete($instructor_evaluation_id) {
    try {
      $instructor_evaluation = InstructorEvaluation::findOrFail($instructor_evaluation_id);
      $participant = Participant::findOrFail($instructor_evaluation->participant_id);
      $instructor_evaluation->delete();

      return redirect()
           ->route('view.participants', $participant->activity_id)
           ->with('success', 'Evaluación eliminada correctamente.');

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
}

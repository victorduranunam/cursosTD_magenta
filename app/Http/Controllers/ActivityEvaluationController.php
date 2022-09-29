<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityEvaluation;
use App\Models\Participant;
use Illuminate\Support\Facades\DB;



class ActivityEvaluationController extends Controller
{
  public function index($participant_id) {
    try {
      $activity_evaluation = ActivityEvaluation::where('participant_id', $participant_id)->first();
      
      if($activity_evaluation)
        return redirect()->route('edit.activity-evaluation', $activity_evaluation->activity_evaluation_id);
  
      return redirect()->route('create.activity-evaluation', $participant_id);

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

  public function create($participant_id) {    
    try {
      
      $participant = Participant::findOrFail($participant_id);
      $participant->name = $participant->getFullName();
      $participant->activity_name = $participant->getActivityName();
      return view('pages.create-activity-evaluation')
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
  
  public function edit($activity_evaluation_id) {

    try {
      $activity_evaluation = ActivityEvaluation::findOrFail($activity_evaluation_id);
      $activity_evaluation->participant = Participant::findOrFail($activity_evaluation->participant_id);
      $activity_evaluation->participant->name = $activity_evaluation->participant->getFullName();
      $activity_evaluation->participant->activity_name = $activity_evaluation->participant->getActivityName();
      return view('pages.update-activity-evaluation')
           ->with('activity_evaluation', $activity_evaluation);

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
             ->route('view.activity-evaluation', $participant_id);

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
           ->route('edit.activity-evaluation', $activity_evaluation->activity_evaluation_id)
           ->with('success', 'Evaluación creada correctamente.');

    } catch (\Illuminate\Database\QueryException $th) {
      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'No hay conexión con la base de datos.');
      elseif ($th->getCode() == 23502)
        return redirect()
             ->back()
             ->with('danger', 'Solamente las preguntas abiertas son opcionales');
      else
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');
    }
  }

  public function update(Request $req, $activity_evaluation_id) {
    try {
      $activity_evaluation = ActivityEvaluation::findOrFail($activity_evaluation_id);

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
           ->route('edit.activity-evaluation', $activity_evaluation->activity_evaluation_id)
           ->with('success', 'Evaluación modificada correctamente');

    } catch (\Illuminate\Database\QueryException $th) {
      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'No hay conexión con la base de datos.');
      elseif ($th->getCode() == 23502)
        return redirect()
             ->back()
             ->with('danger', 'Solamente las preguntas abiertas son opcionales');
      else
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');
    }
  }

  public function delete($activity_evaluation_id) {
    try {
      $activity_evaluation = ActivityEvaluation::findOrFail($activity_evaluation_id);
      $participant = Participant::findOrFail($activity_evaluation->activity_evaluation_id);
      $activity_evaluation->delete();

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

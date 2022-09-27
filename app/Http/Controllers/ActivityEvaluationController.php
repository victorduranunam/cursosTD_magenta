<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityEvaluation;


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
    return 'en edit';
  }
  
  public function store(Request $req, $participant_id) {
    
  }

  public function update(Request $req, $activity_evaluation_id) {
    
  }

  public function delete($activity_evaluation_id) {
    
  }
}

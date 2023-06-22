<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Activity;
use App\Models\Professor;
use App\Models\Participant;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ParticipantController extends Controller
{
    public function index($activity_id){
      try{   
        
        $activity = Activity::join('activity_catalogue','activity_catalogue.activity_catalogue_id','=','activity.activity_catalogue_id')
                              ->where('activity.activity_id', $activity_id)
                              ->first(['activity.activity_id','activity_catalogue.name']);
        
        $participants = Participant::join('professor','professor.professor_id','=','participant.professor_id')
                                    ->where('participant.activity_id', $activity_id)
                                    ->orderByRaw('unaccent(lower(professor.name || professor.last_name || professor.mothers_last_name))')
                                    ->get(['participant.*', 'professor.name', 'professor.last_name', 'professor.mothers_last_name']);
        
        foreach($participants as $participant)
          $participant->summary = $participant->getGradeSummary();

        return view("pages.view-participants")
              ->with("participants",$participants)
              ->with('activity',$activity);

    }catch (\Illuminate\Database\QueryException $th) {
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

    public function search(Request $req, $activity_id) {

      try {

        $instructors = Instructor::where('instructor.activity_id',$activity_id)
          ->get();

        $activity = Activity::findOrFail($activity_id);

        $count = Participant::select('participant_id')
          ->where('activity_id', $activity_id)
          ->where('canceled',false)
          ->count();

        $query = NULL;
        $words = str_replace(' ','',$req->words);

        if ( $req->search_type === 'name' )
          $query = 'unaccent(concat(name,last_name,mothers_last_name)) ILIKE '.
                   'unaccent(\'%'.$words.'%\') OR '.
                   'unaccent(concat(last_name,mothers_last_name,name)) ILIKE '.
                   'unaccent(\'%'.$words.'%\')';
  
        elseif ( $req->search_type === 'email' )
          $query = 'email LIKE \'%'.$words.'%\'';
          
        elseif ( $req->search_type === 'rfc' )
          $query = 'rfc LIKE \'%'.$words.'%\'';
  
        elseif ( $req->search_type === 'worker_number' )
          $query = 'worker_number LIKE \'%'.$words.'%\'';
  
        if ( $query ) {
          
          // Get participants and instructors, they can't be part of the result
          $professorsNotAvailable = DB::select(
            'select pr.professor_id
            from participant pa
            join professor pr on pr.professor_id = pa.professor_id 
            where pa.activity_id = :activity_id
            union
            select pr.professor_id
            from instructor i
            join professor pr on pr.professor_id = i.professor_id 
            where i.activity_id = :activity_id', ['activity_id' => $activity_id]
          );

          // Get professors - professorsNotAvailable
          $professors = Professor::whereNotIn('professor_id', 
            array_map( function ($professor) {
              return (int)$professor->professor_id;
            } ,$professorsNotAvailable))
            ->whereRaw($query)
            ->get();

        } else
          $professors = collect();

        return view("pages.create-participant")
        ->with("professors",$professors)
        ->with("instructors",$instructors)
        ->with('activity',$activity)
        // ->with('max_count',$max_count)
        ->with('count',$count);

      } catch(\Illuminate\Database\QueryException $th) {

        return dd($th);
        return redirect()
              ->route('home')
              ->with('danger', 'Problema con la base de datos.');
      }
    }

    public function create($activity_id) {
        try{   
          
          $professorsNotAvailable = DB::select(
            'select pr.professor_id
            from participant pa
            join professor pr on pr.professor_id = pa.professor_id 
            where pa.activity_id = :activity_id
            union
            select pr.professor_id
            from instructor i
            join professor pr on pr.professor_id = i.professor_id 
            where i.activity_id = :activity_id', ['activity_id' => $activity_id]
          );

          // Get professors - professorsNotAvailable
          $professors = Professor::whereNotIn('professor_id', 
            array_map( function ($professor) {
              return (int)$professor->professor_id;
            } ,$professorsNotAvailable))
            ->get();

            $instructors = Instructor::where('instructor.activity_id',$activity_id)
              ->get();

            $activity = Activity::findOrFail($activity_id);

            $count = Participant::select('participant_id')
                ->where('activity_id', $activity_id)
                ->count() - Participant::select('participant_id')
                ->where('activity_id', $activity_id)
                ->where('canceled',true)
                ->count();

            return view("pages.create-participant")
              ->with("professors",$professors)
              ->with("instructors",$instructors)
              ->with('activity',$activity)
              ->with('count',$count);

        }catch (\Illuminate\Database\QueryException $th) {
          return dd($th);
          return redirect()
            ->route('home')
            ->with('danger', 'Problema con la base de datos.');
        }
      }

    public function edit($participant_id){

      $participant = Participant::findOrFail($participant_id);

      return view('pages.update-participant')
        ->with('participant', $participant);
    }

    public function store(Request $re, $professor_id){
        try{
            $participant = new Participant();
            $participant->participant_id = DB::select("select nextval('participant_seq')")[0]->nextval;
            $participant->professor_id = $professor_id;
            $participant->activity_id = $re->activity_id;

            $max_count = Activity::select('max_quota')
                ->where('activity_id',$re->activity_id)
                ->get()->first();
            
            $count = Participant::select('participant_id')
                ->where('activity_id', (int)$re->activity_id)
                ->count() - Participant::select('participant_id')
                ->where('activity_id', (int)$re->activity_id)
                ->where('canceled',true)
                ->count();

            if ($count >= $max_count->max_quota)
              $participant->additional = true;
            $participant->save();

            return redirect()
                ->back()
                ->with('success', 'Participante inscrito correctamente');
        }catch (\Illuminate\Database\QueryException $th) {

            if ($th->getCode() == 7)
                return redirect()
                ->route('home')
                ->with('danger', 'No hay conexión con la base de datos.');
            else
              return redirect()
                ->back()
                ->with('danger', 'Error al almacenar participante.');
        }
    }

    public function update(Request $re, $participant_id){
      try{
          $participant = Participant::findOrFail($participant_id);

          $participant->additional   = $re->additional   ? TRUE : FALSE;
          $participant->attendance   = $re->attendance   ? TRUE : FALSE;
          $participant->accredited   = $re->accredited   ? TRUE : FALSE;
          $participant->confirmation = $re->confirmation ? TRUE : FALSE;
          $participant->canceled     = $re->canceled     ? TRUE : FALSE;
          $participant->mistimed     = $re->mistimed     ? TRUE : FALSE;

          $participant->discount = $re->discount;
          $participant->deposit  = $re->deposit;
          $participant->nac      = $re->nac;
          $participant->grade    = $re->grade;
          $participant->comment  = $re->comment;

          $participant->save();

          return redirect()
            ->back()
            ->with('success', 'Cambios guardados correctamente.');
      } catch(\Illuminate\Database\QueryException $th) {
          
          if ($th->getCode() == 7)
              return redirect()
                  ->route('home')
                  ->with('danger', 'No hay conexión con la base de datos.');

          elseif ($th->getCode() == 23514) {
            $msj = '';
            if ($re->discount < 0 || $re->discount > 100)
              $msj = 'El descuento es un porcentaje decimal entre 0 y 100. ';
            if ($re->accredited and $re->nac)
              $msj = $msj . 'Si el participante acreditó, no debe haber causa de no acreditación. ';
            if ($re->canceled && ($re->accredited || $re->grade || $re->nac ))
              $msj = $msj . 'Si el participante canceló, no debe de acreditar, tener calificación o tener causa de no acreditación.';
            
            return redirect()
              ->back()
              ->with('danger', $msj);
          }

          elseif ($th->getCode() == 22003)
              return redirect()
                ->back()
                ->with('danger', 'El monto del descuento no debe superar tres digitos enteros y no más de dos dígitos decimales');

          else
              return dd($th);
              return redirect()
                  ->back()
                  ->with('danger', 'Error al almacenar participante.');
      }
    }

    
  
     public function delete($participant_id){
        try {

            $participant = Participant::findOrFail($participant_id);
            $activity_id = $participant->activity_id;
            $participant->delete();
        
            return redirect()
                ->route('view.participants', $activity_id)
                ->with('success', 'Participante eliminado correctamente.');
        
            } catch (\Illuminate\Database\QueryException $th) {
        
            if ($th->getCode() == 7)
                return redirect()
                ->route('home')
                ->with('danger', 'No hay conexión con la base de datos.');
            else
                return redirect()
                ->back()
                ->with('warning', 'Error al eliminar el participante');
            }
      }

    public function searchEvaluation(){
      return view("pages.search-evaluation");
    }
}

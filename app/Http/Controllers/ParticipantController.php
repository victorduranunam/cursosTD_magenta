<?php

namespace App\Http\Controllers;
use App\Models\Instructor;
use App\Models\Activity;
use App\Models\Professor;
use App\Models\Participant;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index($activity_id){
        return "aun no...";
    }

    public function create($activity_id){
        try{   
            $professors = Professor::whereNotIn('professor_id',Instructor::select('professor_id')->where('activity_id',$activity_id)->get())
                                    ->whereNotIn('professor_id',Participant::select('professor_id')->where('activity_id',$activity_id)->get())
                                    ->orderBy('last_name')
                                    ->get(['professor_id','name','last_name','mothers_last_name','email','rfc','worker_number']);

            $instructors = Instructor::join('professor','professor.professor_id','=','instructor.professor_id')
                                    ->where('instructor.activity_id',$activity_id)
                                    ->orderBy('last_name')
                                    ->get(['professor.name', 'professor.last_name', 'professor.mothers_last_name']);
           
            $activity = Activity::join('activity_catalogue','activity_catalogue.activity_catalogue_id','=','activity.activity_catalogue_id')
                                ->where('activity.activity_id',$activity_id)
                                ->first(['activity.activity_id','activity_catalogue.name']);

            return view("pages.create-participant")
              ->with("professors",$professors)
              ->with("instructors",$instructors)
              ->with('activity',$activity);

        }catch (\Illuminate\Database\QueryException $th) {
          return dd($th);
          return redirect()
            ->route('home')
            ->with('danger', 'Problema con la base de datos.');
        }
      }

    public function edit($activity_id){
        try{   
            $participants = Participant::select('*')->where('participant.activity_id',$activity_id)
                                    ->get();
            $instructors = Instructor::join('professor','professor.professor_id','=','instructor.professor_id')
                                    ->where('instructor.activity_id',$activity_id)
                                    ->orderBy('last_name')
                                    ->get();
           
            $activity = Activity::join('activity_catalogue','activity_catalogue.activity_catalogue_id','=','activity.activity_catalogue_id')
                                ->where('activity.activity_id',$activity_id)
                                ->first(['activity.activity_id','activity_catalogue.name']);

            return $participants;
            return view("pages.view-participants")
            ->with("participants",$participants)
            ->with("instructors",$instructors)
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

    public function store(Request $re, $professor_id){
        try{
            $participant = new Participant();
            $participant->participant_id = DB::select("select nextval('participant_seq')")[0]->nextval;
            $participant->professor_id = $professor_id;
            $participant->activity_id = $re->activity_id;
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
  
    //  public function delete($participant_id){
    //     return "aun no...";
    //     try {
    //         $participant = Participant::findOrFail($participant_id);
    //         $participant->delete();
        
    //         return redirect()
    //             ->route('view.activities')
    //             ->with('success', 'Eliminado correctamente.');
        
    //         } catch (\Illuminate\Database\QueryException $th) {
        
    //         if ($th->getCode() == 7)
    //             return redirect()
    //             ->route('home')
    //             ->with('danger', 'No hay conexión con la base de datos.');
    //         else
    //             return redirect()
    //             ->back()
    //             ->with('warning', 'Error al eliminar el participante');
    //         }
    //   }
}

<?php

namespace App\Http\Controllers;
use App\Models\Instructor;
use App\Models\Activity;
use App\Models\Professor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index($activity_id){

      // Probar
      try{   
            $professors = Professor::select('professor_id','name','last_name','mothers_last_name','email','rfc','worker_number')
                                   ->where('is_instructor',true)
                                   ->whereNotIn('professor_id',Instructor::select('professor_id')->where('activity_id',$activity_id)->get())
                                   ->whereNotIn('professor_id',Participant::select('professor_id')->where('activity_id',$activity_id)->get())
                                   ->orderByRaw('unaccent(lower(name || last_name || mothers_last_name))')
                                   ->get();

            $instructors = Instructor::join('professor','professor.professor_id','=','instructor.professor_id')
                                     ->where('instructor.activity_id',$activity_id)
                                     ->orderByRaw('unaccent(lower(name || last_name || mothers_last_name))')
                                     ->get();
           
            $activity = Activity::join('activity_catalogue','activity_catalogue.activity_catalogue_id','=','activity.activity_catalogue_id')
                                ->where('activity.activity_id',$activity_id)
                                ->get(['activity.activity_id','activity_catalogue.name']);

            return view("pages.view-instructors")
            ->with("professors",$professors)
            ->with("instructors",$instructors)
            ->with('activity',$activity[0]);
        }catch (\Illuminate\Database\QueryException $th) { 
            return redirect()
              ->route('home')
              ->with('danger', 'Problema con la base de datos.');
          }
    }

    public function search($activity_id) {
      try {

        // Falta codigo de query
        $professors = Professor::select('professor_id','name','last_name','mothers_last_name','email','rfc','worker_number')
                               ->where('is_instructor',true)
                               ->whereNotIn('professor_id',Instructor::select('professor_id')->where('activity_id',$activity_id)->get())
                               ->whereNotIn('professor_id',Participant::select('professor_id')->where('activity_id',$activity_id)->get())
                               ->whereRaw($query)
                               ->orderByRaw('unaccent(lower(name || last_name || mothers_last_name))')
                               ->get();

        $instructors = Instructor::join('professor','professor.professor_id','=','instructor.professor_id')
                                 ->where('instructor.activity_id',$activity_id)
                                 ->orderByRaw('unaccent(lower(name || last_name || mothers_last_name))')
                                 ->get();
     
        // Qué sería mejor? pasar el objeto actividad y preguntar por su relacion en la vista
        // o pasar directamente el texto y preguntar por aqui por su nombre?

        // Al final del dia lo que se debe evitar simplemente es ejecutar una consulta por registro
        // No la forma en la que pasamos los datos a la vista, porque de todas formas haremos la consulta
        $activity = Activity::findOrFail($activity_id);

        return view("pages.view-instructors")
              ->with("professors",$professors)
              ->with("instructors",$instructors)
              ->with('activity',$activity);

      } catch (\Illuminate\Database\QueryException $th) {
        
        return dd($th);
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');
      }
      
    }

    public function store(Request $re, $professor_id){
      
        try{
            $instructor = new Instructor();
            $instructor->instructor_id = DB::select("select nextval('instructor_seq')")[0]->nextval;
            $instructor->professor_id = $professor_id;
            $instructor->activity_id = $re->activity_id;
            $instructor->save();
            return redirect()
                ->back()
                ->with('success', 'Instructores asignados correctamente');
        }catch (\Illuminate\Database\QueryException $th) {
            if ($th->getCode() == 7)
              return redirect()
                ->route('home')
                ->with('danger', 'No hay conexión con la base de datos.');
            else
              return dd($th);
          }
    }

    public function delete($instructor_id){
        try {
            $instructor = Instructor::findOrFail($instructor_id);
            $instructor->delete();
      
            return redirect()
              ->route('view.activities')
              ->with('success', 'Eliminado correctamente.');
      
          } catch (\Illuminate\Database\QueryException $th) {
      
            if ($th->getCode() == 7)
              return redirect()
                ->route('home')
                ->with('danger', 'No hay conexión con la base de datos.');
            else
              return redirect()
                ->back()
                ->with('warning', 'Error al eliminar el instructor');
          }
    }
}

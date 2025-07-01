<?php

namespace App\Http\Controllers;
use App\Models\Instructor;
use App\Models\Activity;
use App\Models\Professor;
use App\Models\Participant;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index($activity_id){

      // Probar
      try {

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
            
          return view("pages.view-instructors")
            ->with("professors", $professors)
            ->with("instructors", $instructors)
            ->with('activity', $activity);

        }catch (\Illuminate\Database\QueryException $th) { 
           dd($th);
            return redirect()
              ->route('home')
              ->with('danger', 'Problema con la base de datos.');
          }
    }

    public function search(Request $req, $activity_id) {
      try {

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

          $instructors = Instructor::where('instructor.activity_id',$activity_id)
            ->get();
           
          $activity = Activity::findOrFail($activity_id);
            
          return view("pages.view-instructors")
            ->with("professors", $professors)
            ->with("instructors", $instructors)
            ->with('activity', $activity);

      } catch (\Illuminate\Database\QueryException $th) {

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
            elseif ($th->getCode() == 23505)
              return redirect()
                ->back()
                ->with('warning', 'El instructor ya está asignado.');
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

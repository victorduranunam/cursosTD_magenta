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
        try{
            $professors = Professor::select('professor_id','name','last_name','mothers_last_name','email','rfc','worker_number')
                                    ->where('is_instructor',true)
                                    ->get();

            $instructors = Instructor::join('professor','professor.professor_id','=','instructor.professor_id')
                                    ->where('instructor.activity_id',$activity_id)
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

    public function store(Request $req){
        try{
            
            $instructor = new Instructor();
            $instructor->instructor_id = DB::select("select nextval('instructor_seq')")[0]->nextval;
            $instructor->professor_id = $req->professor_id;
            $instructor->activity_id = $req->activity_id;
            $instructor->save();
            return redirect()
                ->route('view.activities')
                ->with('success', 'Instructores asignados correctamente');
        }catch (\Illuminate\Database\QueryException $th) {
            if ($th->getCode() == 7)
              return redirect()
                ->route('home')
                ->with('danger', 'Problema con la base de datos.');
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
                ->with('danger', 'Problema con la base de datos.');
            else
              return redirect()
                ->back()
                ->with('warning', 'Error al eliminar el instructor');
          }
    }
}

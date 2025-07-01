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

  public function index($activity_id)
{
    try {
        // Obtener IDs de profesores que ya están asignados como instructores
        $professorsNotAvailable = DB::select(
            'SELECT pr.professor_id
             FROM instructor i
             JOIN professor pr ON pr.professor_id = i.professor_id
             WHERE i.activity_id = :activity_id',
            ['activity_id' => $activity_id]
        );

        // Convertir los resultados a un array plano de IDs
        $excludedIds = array_map(
            fn($p) => (int) $p->professor_id,
            $professorsNotAvailable
        );

        // Obtener profesores que NO están en la lista de instructores de esa actividad
        $professors = Professor::when(
                count($excludedIds) > 0,
                fn($query) => $query->whereNotIn('professor_id', $excludedIds),
                fn($query) => $query // si no hay instructores, traer todos
            )
            ->get();

        // Obtener instructores asignados a esta actividad
        $instructors = Instructor::where('activity_id', $activity_id)->get();

        // Obtener la actividad
        $activity = Activity::findOrFail($activity_id);

        // Enviar datos a la vista
        return view("pages.view-instructors", [
            "professors" => $professors,
            "instructors" => $instructors,
            "activity" => $activity,
        ]);

    } catch (\Illuminate\Database\QueryException $th) {
        // Mostrar error en pantalla y detener flujo
        dd($th->getMessage(), $th->getTraceAsString());
    }
}



public function search(Request $req, $activity_id) {
    try {
        $query = null;
        $words = str_replace(' ', '', $req->words);

        if ($req->search_type === 'name') {
            $query = "unaccent(concat(name,last_name,mothers_last_name)) ILIKE unaccent('%$words%') OR " .
                     "unaccent(concat(last_name,mothers_last_name,name)) ILIKE unaccent('%$words%')";
        } elseif ($req->search_type === 'email') {
            $query = "email LIKE '%$words%'";
        } elseif ($req->search_type === 'rfc') {
            $query = "rfc LIKE '%$words%'";
        } elseif ($req->search_type === 'worker_number') {
            $query = "worker_number LIKE '%$words%'";
        }

        if ($query) {
            // Profesores que ya están asignados como instructores a esta actividad
            $professorsNotAvailable = DB::select(
                'SELECT pr.professor_id
                 FROM instructor i
                 JOIN professor pr ON pr.professor_id = i.professor_id
                 WHERE i.activity_id = :activity_id',
                ['activity_id' => $activity_id]
            );

            // Convertir a arreglo plano de IDs
            $excludedIds = array_map(
                fn($professor) => (int)$professor->professor_id,
                $professorsNotAvailable
            );

            // Buscar profesores disponibles que no estén ya asignados
            $professors = Professor::whereNotIn('professor_id', $excludedIds)
                ->whereRaw($query)
                ->get();
        } else {
            $professors = collect(); // colección vacía
        }

        $instructors = Instructor::where('activity_id', $activity_id)->get();
        $activity = Activity::findOrFail($activity_id);

        return view("pages.view-instructors")
            ->with("professors", $professors)
            ->with("instructors", $instructors)
            ->with("activity", $activity);

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

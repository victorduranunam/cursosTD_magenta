<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Professor;
use App\Models\ProfessorPosition;
use App\Models\WorkPosition;




class ProfessorPositionController extends Controller
{
  public function index($professor_id)
  {
    $callback = function ($item) { 
      return $item->work_position_id; 
    };

    try {

        $professor = Professor::findOrFail($professor_id);

        $professor->positions = ProfessorPosition::where('professor_id', $professor_id)
                                ->select('professor_position_id', 'work_position_id')
                                ->get();

        $positions = WorkPosition::whereNotIn('work_position_id',$professor->positions->map($callback))
                              ->get();

        return view("pages.view-professor-positions")
            ->with("positions",$positions)
            ->with("professor",$professor);

    } catch (\Illuminate\Database\QueryException $th) {
      if($th->getCode() == 7)
        return redirect()
             ->route('home')
             ->with('danger', 'No hay conexión con la base de datos.');
      else
        return redirect()
            ->route('home')
            ->with('danger', 'Problema con la base de datos.');
    }
  }

  public function store(Request $req, $professor_id){
    try{ 

      $professor_position = new ProfessorPosition();
      $professor_position->professor_position_id = DB::select("select nextval('professor_position_seq')")[0]->nextval;
      $professor_position->professor_id = $professor_id;
      $professor_position->work_position_id = $req->work_position_id;
      $professor_position->save();

      return redirect()
           ->back()
           ->with('success', 'Puesto de trabajo asignado correctamente');


    } catch (\Illuminate\Database\QueryException $th) {

      if($th->getCode() == 23505)
        return redirect()
             ->back()
             ->with('danger', 'No se puede asignar más de una vez el mismo puesto de trabajo.');
      
      elseif($th->getCode() == 7)
        return redirect()
             ->route('home')
             ->with('danger', 'No hay conexión con la base de datos.');
      else 
        return redirect()
             ->back()
             ->with('danger', 'Problema con la base de datos.');
    }
  }

  public function delete($professor_position_id){
    try{ 
      
      $professor_position = ProfessorPosition::findOrFail($professor_position_id);
      $professor_position->delete();

      return redirect()
           ->back()
           ->with('success', 'Puesto de trabajo desasignado correctamente');


    } catch (\Illuminate\Database\QueryException $th) {
      if($th->getCode() == 7)
        return redirect()
             ->route('home')
             ->with('danger', 'No hay conexión con la base de datos.');
      else 
        return redirect()
             ->back()
             ->with('danger', 'Problema con la base de datos.');
    }
  }
}

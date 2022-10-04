<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\ProfessorDivision;
use App\Models\Professor;
use Illuminate\Support\Facades\DB;

class ProfessorDivisionController extends Controller
{
  public function index($professor_id)
  {
    $callback = function ($item) { 
      return $item->division_id; 
    };

    try {

        $professor = Professor::findOrFail($professor_id);

        $professor->divisions = ProfessorDivision::join('division', 'division.division_id', '=', 'professor_division.division_id')
                                ->where('professor_id', $professor_id)
                                ->select('professor_division_id', 'division.division_id', 'division.name')
                                ->orderByRaw('unaccent(lower(division.name))')
                                ->get();

        $divisions = Division::whereNotIn('division_id',$professor->divisions->map($callback))
                              ->orderByRaw('unaccent(name)')
                              ->get();

        return view("pages.view-professor-divisions")
            ->with("divisions",$divisions)
            ->with("professor",$professor);

    } catch (\Illuminate\Database\QueryException $th) {

      return dd($th);
        return redirect()
            ->route('home')
            ->with('danger', 'Problema con la base de datos.');
    }
  }

  public function store(Request $req, $professor_id){
    try{ 

      $professor_division = new ProfessorDivision();
      $professor_division->professor_division_id = DB::select("select nextval('professor_division_seq')")[0]->nextval;
      $professor_division->professor_id = $professor_id;
      $professor_division->division_id = $req->division_id;
      $professor_division->save();

      return redirect()
           ->back()
           ->with('success', 'División asignada correctamente');


    } catch (\Illuminate\Database\QueryException $th) {

      if($th->getCode() == 23505)
        return redirect()
             ->back()
             ->with('danger', 'No se puede asignar más de una vez la misma división.');
      
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

  public function delete($professor_division_id){
    try{ 
      
      $professor_division = ProfessorDivision::findOrFail($professor_division_id);
      $professor_division->delete();

      return redirect()
           ->back()
           ->with('success', 'División desasignada correctamente');


    } catch (\Illuminate\Database\QueryException $th) {
        return redirect()
             ->back()
             ->with('danger', 'Problema con la base de datos');
    }
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkPosition;
use Illuminate\Support\Facades\DB;

class WorkPositionController extends Controller
{

  public function index()
  {
    try {

      $work_positions = WorkPosition::orderByRaw('unaccent(lower(name))')->get();

      return view("pages.view-work-positions")
        ->with("work_positions", $work_positions);

    } catch (\Illuminate\Database\QueryException $th) {
      
      return redirect()
        ->route('home')
        ->with('danger', 'Problema con la base de datos.');
    }
  }

  public function search (Request $req) {
    try {

      $query = NULL;

      if ( $req->search_type === 'name' OR 
           $req->search_type === 'abbreviation' )

        $query = 'unaccent('.$req->search_type.') ILIKE unaccent(\'%'
               . $req->words . '%\')';

      if ( $query ) {

        $work_positions = WorkPosition::whereRaw($query)
          ->orderByRaw('unaccent(lower(name))')
          ->get();

      } else {

        $work_positions = collect();

      }

      return view("pages.view-work-positions")
           ->with("work_positions", $work_positions);
      
    } catch (\Illuminate\Database\QueryException $th) {
      
      return redirect()
              ->route('home')
              ->with('danger', 'Problema con la base de datos.');

    }

  }

  public function store (Request $req)
  {
    try {
      $work_position = new WorkPosition();
      $work_position->work_position_id = DB::select("select nextval('work_position_seq')")[0]->nextval;
      $work_position->name = $req->name;
      $work_position->abbreviation = $req->abbreviation;
      $work_position->save();

      return redirect()
        ->route('view.work-positions')
        ->with('success', 'Categoría creada correctamente');

    } catch (\Illuminate\Database\QueryException $th) {
      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'No hay conexión con la base de datos.');
      else
        return redirect()
          ->back()
          ->with('warning', 'Error al almacenar, verifique sus datos.')
          ->withInput();
    }
  }

  public function update(Request $req, $work_position_id)
  {
    
    try {
     
      $work_position = WorkPosition::findOrFail($work_position_id);
      $work_position->name = $req->name;
      $work_position->abbreviation = $req->abbreviation;
      $work_position->save();

      return redirect()
        ->route('view.work-positions', $work_position->work_position_id)
        ->with('success', 'Cambios realizados.');

    } catch (\Illuminate\Database\QueryException $th) {

      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'No hay conexión con la base de datos.');
      else
        return redirect()
          ->back()
          ->with('work_position', $work_position)
          ->with('warning', 'Error al almacenar, verifique sus datos.');
    }
  }

  public function delete($work_position_id)
  {
    try {
      
      $work_position = WorkPosition::findOrFail($work_position_id);
      $work_position->delete();

      return redirect()
        ->route('view.work-positions')
        ->with('success', 'Eliminado correctamente.');

    } catch (\Illuminate\Database\QueryException $th) {

      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'No hay conexión con la base de datos.');
      else
        return redirect()
          ->back()
          ->with('warning', 'Error al eliminar la sede.');
    }
  }
}

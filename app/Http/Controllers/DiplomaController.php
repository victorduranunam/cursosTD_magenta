<?php

namespace App\Http\Controllers;
use App\Models\Diploma;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DiplomaController extends Controller
{
  public function index()
  {
    try {
      $diplomas = Diploma::all();
      return view("pages.view-diplomas")
        ->with("diplomas", $diplomas);
    } catch (\Illuminate\Database\QueryException $th) {
      return redirect()
        ->route('home')
        ->with('danger', 'Problema con la base de datos.');
    }
  }

  public function store(Request $req){
    try {
        $diploma = new Diploma();
        $diploma->diploma_id = DB::select("select nextval('diploma_seq')")[0]->nextval;
        $diploma->name = $req->name;
        $diploma->save();

        return redirect()
          ->route('view.diplomas')
          ->with('success','Diplomado creado correctamente');
    }catch (\Illuminate\Database\QueryException $th){
        if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');
      else
        return redirect()
          ->back()
          ->with('warning', 'Error al almacenar, verifique sus datos.')
          ->withInput();
    }
  }

  public function update(Request $req, $diploma_id){
    try {

      $diploma = Diploma::findOrFail($diploma_id);
      $diploma->name = $req->name;
      $diploma->save();

      return redirect()
        ->route('view.diplomas')
        ->with('success', 'Cambios realizados.');

    } catch (\Illuminate\Database\QueryException $th) {
      
      if($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');
      
      else
        return redirect()
          ->back()
          ->with('diploma',$diploma)
          ->with('warning', 'Error al almacenar, verifique sus datos.');

    }
  }

  public function delete($diploma_id)
  {
    try {
      $diploma = Diploma::findOrFail($diploma_id);
      $diploma->delete();

      return redirect()
        ->route('view.diplomas')
        ->with('success', 'Eliminado correctamente.');

    } catch (\Illuminate\Database\QueryException $th) {

      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');
      else
        return redirect()
          ->back()
          ->with('warning', 'Error al eliminar el diplomado.');
    }
  }

}

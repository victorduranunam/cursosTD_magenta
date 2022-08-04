<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;
use Illuminate\Support\Facades\DB;

class CareerController extends Controller
{
  public function index()
  {
    try {
      $careers = Career::all()
        ->sortBy('name');
      return view("pages.view-careers")
        ->with("careers", $careers);
    } catch (\Illuminate\Database\QueryException $th) {
      return redirect()
        ->route('home')
        ->with('danger', 'Problema con la base de datos.');
    }
  }

  public function create()
  {
    return view("pages.create-career");
  }

  public function store(Request $req)
  {
    try {
      $career = new Career();
      $career->career_id = DB::select("select nextval('career_seq')")[0]->nextval;
      $career->name = $req->name;
      $career->key = $req->key;
      $career->save();

      return redirect()
        ->route('view.careers')
        ->with('success', 'Carrera creada correctamente');
    } catch (\Illuminate\Database\QueryException $th) {
      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');
      elseif ($th->getCode() == 23505)
        return redirect()
          ->back()
          ->with('career', $career)
          ->with('warning', 'Error al almacenar, recuerde que la clave debe ser única para cada carrera.');
      else
        return redirect()
          ->back()
          ->with('warning', 'Error al almacenar, verifique sus datos.')
          ->withInput();
    }
  }

  public function edit($career_id)
  {
    try {
      $career = Career::findOrFail($career_id);
      return view("pages.update-career")
        ->with("career", $career);
    } catch (\Illuminate\Database\QueryException $th) {
      return redirect()
        ->route('view.careers')
        ->with('danger', 'Problema con la base de datos.');
    }
  }

  public function update(Request $req, $career_id)
  {
    try {
      $career = career::findOrFail($career_id);
      $career->name = $req->name;
      $career->key = $req->key;
      $career->save();

      return redirect()
        ->route('edit.career', $career->career_id)
        ->with('success', 'Cambios realizados.');
    } catch (\Illuminate\Database\QueryException $th) {
      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');
      elseif ($th->getCode() == 23505)
        return redirect()
          ->back()
          ->with('career', $career)
          ->with('warning', 'Error al almacenar, recuerde que la clave debe ser única para cada carrera.');
      else
        return redirect()
          ->back()
          ->with('career', $career)
          ->with('warning', 'Error al almacenar, verifique sus datos.');
    }
  }

  public function delete($career_id)
  {
    try {
      $career = Career::findOrFail($career_id);
      $career->delete();

      return redirect()
        ->route('view.careers')
        ->with('success', 'Eliminado correctamente.');
    } catch (\Illuminate\Database\QueryException $th) {

      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');
      else
        return redirect()
          ->back()
          ->with('warning', 'Error al eliminar el salón.');
    }
  }
}

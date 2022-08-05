<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityCatalogue;
use Illuminate\Support\Facades\DB;

class ActivityCatalogueController extends Controller
{
  public function index()
  {
    try {

      $activities_cat = ActivityCatalogue::all()
        ->sortBy('key');

      return view("pages.view-activities-catalogue")
        ->with("activities_cat", $activities_cat);

    } catch (\Illuminate\Database\QueryException $th) {
      
      return redirect()
        ->route('home')
        ->with('danger', 'Problema con la base de datos.');
    }
  }

  public function create()
  {
    return view("pages.create-activity-catalogue");
  }

  public function store(Request $req)
  {
    try {
      
      $activity_cat = new ActivityCatalogue();
      $activity_cat->activit_catalogue_id = DB::select("select nextval('activity_catalogue_seq')")[0]->nextval;
      $activity_cat->key = $req->key;
      $activity_cat->name = $req->name;
      $activity_cat->hours = $req->hours;
      $activity_cat->type = $req->type;
      $activity_cat->creation_date = $req->creation_date;
      $activity_cat->department_id = $req->department_id;
      
      if($req->institution)
        $activity_cat->institution = $req->institution;
      if($req->aimed_at)
        $activity_cat->aimed_at = $req->aimed_at;
      if($req->objective)
        $activity_cat->objective = $req->objective;
      if($req->content)
        $activity_cat->content = $req->content;
      if($req->background)
        $activity_cat->background = $req->background;
      if($req->type === 'DI'){
        if(!$req->module OR !$req->diploma_id)
          return redirect()
            ->back()
            ->with('warning', 'Error al almacenar, verifique haber ingresado el número de módulo y el diplomado asociado.')
            ->withInput();
        $activity_cat->diploma_id = $req->diploma_id;
        $activity_cat->module = $req->module;
      }
      
      $activity_cat->save();

      return redirect()
        ->route('view.activities.catalogue')
        ->with('success', 'Catálogo de curso creado correctamente');

    } catch (\Illuminate\Database\QueryException $th) {
      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');

      elseif ($th->getCode() == 23505)
        return redirect()
          ->back()
          ->with('activity_cat', $activity_cat)
          ->with('warning', 'Error al almacenar, recuerde que la clave debe ser única para cada catálogo de curso.');
      else
        return redirect()
          ->back()
          ->with('warning', 'Error al almacenar, verifique sus datos.')
          ->withInput();
    }
  }

  public function edit($activity_catalogue_id)
  {
    try {
      
      $activity_cat = ActivityCatalogue::findOrFail($activity_catalogue_id);

      return view("pages.update-activity-catalogue")
        ->with("activity_cat", $activity_cat);

    } catch (\Illuminate\Database\QueryException $th) {
      
      return redirect()
        ->route('view.activities.catalogue')
        ->with('danger', 'Problema con la base de datos.');
    }
  }

  public function update(Request $req, $activity_catalogue_id)
  {
    
    try {
     
      $activity_cat = ActivityCatalogue::findOrFail($activity_catalogue_id);
      
      $activity_cat->key = $req->key;
      $activity_cat->name = $req->name;
      $activity_cat->hours = $req->hours;
      $activity_cat->type = $req->type;
      $activity_cat->creation_date = $req->creation_date;
      $activity_cat->department_id = $req->department_id;
      $activity_cat->institution = $req->institution;
      $activity_cat->aimed_at = $req->aimed_at;
      $activity_cat->objective = $req->objective;
      $activity_cat->content = $req->content;
      $activity_cat->background = $req->background;
      
      if($req->type === 'DI'){
        if(!$req->module OR !$req->diploma_id)
          return redirect()
            ->back()
            ->with('warning', 'Error al almacenar, verifique haber ingresado el número de módulo y el diplomado asociado.')
            ->withInput();
        $activity_cat->module = $req->module;
        $activity_cat->diploma_id = $req->diploma_id;
      }
      else {
        $activity_cat->module = NULL;
        $activity_cat->diploma_id = NULL;
      }

      $activity_cat->save();

      return redirect()
        ->route('edit.activity.catalogue', $activity_cat->activity_catalogue_id)
        ->with('success', 'Cambios realizados.');

    } catch (\Illuminate\Database\QueryException $th) {
      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');

      elseif ($th->getCode() == 23505)
        return redirect()
          ->back()
          ->with('activity_cat', $activity_cat)
          ->with('warning', 'Error al almacenar, recuerde que la clave debe ser única para cada catálogo de curso.');

      else
        return redirect()
          ->back()
          ->with('activity_cat', $activity_cat)
          ->with('warning', 'Error al almacenar, verifique sus datos.');
    }
  }

  public function delete($activity_catalogue_id)
  {
    try {
      
      $activity_cat = ActivityCatalogue::findOrFail($activity_catalogue_id);
      $activity_cat->delete();

      return redirect()
        ->route('view.activities.catalogue')
        ->with('success', 'Eliminado correctamente.');

    } catch (\Illuminate\Database\QueryException $th) {

      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');
      else
        return redirect()
          ->back()
          ->with('warning', 'Error al eliminar el catálogo de curso.');
    }
  }
}

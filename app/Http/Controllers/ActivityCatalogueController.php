<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityCatalogue;
use App\Models\Diploma;
use App\Models\Department;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ActivityCatalogueController extends Controller
{

  public function index()
  {
    try {
      
      $activities_cat = ActivityCatalogue
                      ::where('department_id', Auth::user()->department_id)
                      ->orderByRaw('unaccent(lower(key))')
                      ->get();

      return view("pages.view-activities-catalogue")
        ->with("activities_cat", $activities_cat);

    } catch (\Illuminate\Database\QueryException $th) {

        if ($th->getCode() == 7)
          return redirect()
            ->route('home')
            ->with('danger', 'No hay conexión con la base de datos.');
        else
          return redirect()
            ->route('home')
            ->with('danger', 'Problema con la base de datos.');
    }
  }

  public function search(Request $req) 
  {
    try {
      
      if ( $req->search_type === 'name' ) {
        $activities_cat = ActivityCatalogue::whereRaw(
            'unaccent(lower(name)) ILIKE unaccent(lower(\'%'.$req->words.'%\'))
            and department_id = '.Auth::user()->department_id
          )
          ->orderByRaw('unaccent(lower(key))')
          ->get();
      } elseif ( $req->search_type === 'key' ) {
        $activities_cat = ActivityCatalogue::whereRaw(
          'unaccent(lower(key)) ILIKE unaccent(lower(\'%'.$req->words.'%\'))
          and department_id = '.Auth::user()->department_id
        )
        ->orderByRaw('unaccent(lower(key))')
        ->get();
      } else {
        $activities_cat = NULL;
      }
  
      return view("pages.view-activities-catalogue")
          ->with("activities_cat", $activities_cat);
    
    } catch (\Illuminate\Database\QueryException $th) {
      
      if ($th->getCode() == 7)
          return redirect()
            ->route('home')
            ->with('danger', 'No hay conexión con la base de datos.');
        else
          return redirect()
            ->route('home')
            ->with('danger', 'Problema con la base de datos.');
    }
  }

  public function create() 
  {
    $diplomas = Diploma::all()
      ->sortBy('name');
    $departments = Department::where('department_id',Auth::user()->department_id)
      ->get()
      ->sortBy('name');
    if($departments->isEmpty())
      return redirect()
        ->route('home')
        ->with('danger', 'Es necesario crear un departamento antes de crear un Catálogo de Actividades.');
    return view("pages.create-activity-catalogue")
      ->with('diplomas', $diplomas)
      ->with('departments', $departments);
  }

  public function store(Request $req)
  {
    try {

      $activity_cat = new ActivityCatalogue();
      $activity_cat->activity_catalogue_id = DB::select(
        "select nextval('activity_catalogue_seq')")[0]->nextval;
      $activity_cat->key = $req->key;
      $activity_cat->name = $req->name;
      $activity_cat->hours = $req->hours;
      $activity_cat->type = $req->type;
      $activity_cat->creation_date = $req->creation_date;
      $activity_cat->department_id = $req->department_id;
      
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
        if(ActivityCatalogue::where('module', $req->module)->where('diploma_id', $req->diploma_id)->get()->isNotEmpty())
          return redirect()
            ->back()
            ->with('warning', 'Error al almacenar, el número de módulo no debe repetirse para el mismo diplomado.')
            ->withInput();
        $activity_cat->diploma_id = $req->diploma_id;
        $activity_cat->module = $req->module;
      }
      
      $activity_cat->save();

      return redirect()
        ->route('view.activities.catalogue')
        ->with('success', 'Catálogo de Actividades creado correctamente');

    } catch (\Illuminate\Database\QueryException $th) {
      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'No hay conexión con la base de datos.');

      elseif ($th->getCode() == 23505)
        return redirect()
          ->back()
          ->with('activity_cat', $activity_cat)
          ->with('warning', 'Error al almacenar, recuerde que la clave debe ser'
          .' única para cada Catálogo de Actividades.');
      else
        return redirect()
            ->back()
            ->with('danger', 'Problema al almacenar datos.');
    }
  }

  public function edit($activity_catalogue_id)
  {
    try {
      
      $activity_cat = ActivityCatalogue::findOrFail($activity_catalogue_id);

      $diplomas = Diploma::all()
        ->sortBy('name');

      $departments = Department::where(
          'department_id',$activity_cat->department_id
        )->get()->sortBy('name');

      return view("pages.update-activity-catalogue")
        ->with("activity_cat", $activity_cat)
        ->with('diplomas', $diplomas)
        ->with('departments', $departments);

    } catch (\Illuminate\Database\QueryException $th) {
      
      if ($th->getCode() == 7)
          return redirect()
            ->route('home')
            ->with('danger', 'No hay conexión con la base de datos.');
      else
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
        if(ActivityCatalogue::where('module', $req->module)
                            ->where('diploma_id', $req->diploma_id)
                            ->where('activity_catalogue_id', '<>', $activity_cat->activity_catalogue_id)
                            ->get()
                            ->isNotEmpty())
          return redirect()
            ->back()
            ->with('warning', 'Error al almacenar, el número de módulo no debe repetirse para el mismo diplomado.')
            ->withInput();
        $activity_cat->diploma_id = $req->diploma_id;
        $activity_cat->module = $req->module;
      }
      
      $activity_cat->save();

      return redirect()
        ->route('edit.activity.catalogue', $activity_cat->activity_catalogue_id)
        ->with('success', 'Cambios realizados.');

    } catch (\Illuminate\Database\QueryException $th) {
      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'No hay conexión con la base de datos.');

      elseif ($th->getCode() == 23505)
        return redirect()
          ->back()
          ->with('activity_cat', $activity_cat)
          ->with('warning', 'Error al almacenar, recuerde que la clave debe ser única para cada Catálogo de Actividades.');

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
          ->with('danger', 'No hay conexión con la base de datos.');
      else
        return redirect()
          ->back()
          ->with('warning', 'Error al eliminar el Catálogo de Actividades.');
    }
  }
}

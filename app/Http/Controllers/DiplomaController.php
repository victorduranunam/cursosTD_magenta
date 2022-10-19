<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Diploma;
use App\Models\Professor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DiplomaController extends Controller
{
  public function index()
  {
    try {
      $diplomas = Diploma::orderByRaw('unaccent(lower(name))')->get();
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
          ->with('danger', 'No hay conexión con la base de datos.');
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
          ->with('danger', 'No hay conexión con la base de datos.');
      
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
          ->with('danger', 'No hay conexión con la base de datos.');
      else
        return redirect()
          ->back()
          ->with('warning', 'Error al eliminar el diplomado.');
    }
  }

  //TODO: Enviar a la vista, hacer mas pruebas, ya funcionaba
  public function downloadDiplomas(Request $req, $diploma_id){
    try {

      $diploma = Diploma::findOrFail($diploma_id);
      $diploma->modules = Activity::join('activity_catalogue as ac',
                                            'ac.activity_catalogue_id',
                                            '=',
                                            'activity.activity_catalogue_id')
                                     ->where('ac.diploma_id', $diploma_id)
                                     ->where('ac.type', 'DI')
                                     ->where('activity.year', $req->year_search)
                                     ->get();

      if($diploma->modules->isEmpty())
        return redirect()
             ->back()
             ->with('warning', 'No hay módulos asignados a este diplomado.'
                              .' Primero asigne algunos.');

      $diploma->participants = collect([]);

      foreach($diploma->modules as $module){

        $module->participants = $module->getParticipants();

        foreach($module->participants as $participant){
          if( $diploma->participants->doesntContain('professor_id',$participant->professor_id) && $participant->accredited)
            $diploma->participants->push(collect([
              'professor_id'      => $participant->professor_id,
              'name'              => $participant->name,
              'last_name'         => $participant->last_name,
              'mothers_last_name' => $participant->mothers_last_name,
              'grades'            => array ($participant->grade)
            ]));
          elseif ($diploma->participants->has($participant->professor_id) && $participant->accredited){
            $tmp = $diploma->participants->where('professor_id', $participant->professor_id)->first()['grades'];
            $tmp[] = $participant->grade;
            $diploma->participants->where('professor_id', $participant->professor_id)->first()['grades'] = $tmp;
          }
          else
            continue;
        }
      }

      foreach($diploma->participants as $key => $participant){
        if(count($participant['grades']) != $diploma->modules->count())
          $diploma->participants->pull($key);
        else
          $participant['average'] = array_sum($participant['grades']) / $diploma->modules->count();
      }

      return $diploma;

    } catch (\Illuminate\Database\QueryException $th) {
      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'No hay conexión con la base de datos.');
      else
        return dd($th);
        return redirect()
          ->back()
          ->with('warning', 'Error al generar los diplomas. '
                           .'Problema con la base de datos.');
    }
  }
}

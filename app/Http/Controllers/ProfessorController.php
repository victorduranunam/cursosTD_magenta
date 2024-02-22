<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use DB;
use PDF;

class ProfessorController extends Controller
{
  public function index()
  {
      try {
          $professors = Professor::orderByRaw('unaccent(lower(name || last_name || mothers_last_name))')
          ->get();

          return view("pages.view-professors")
              ->with("professors",$professors);
          
      } catch (\Illuminate\Database\QueryException $th) {
          return redirect()
              ->route('home')
              ->with('danger', 'Problema con la base de datos.');
      }
  }

  public function search(Request $req)
  {
    try {

      $query = NULL;
      
      if ( $req->search_type === 'name' ) {

        $words = str_replace(' ','',$req->words);

        $query = 'unaccent(concat(name,last_name,mothers_last_name)) ILIKE '.
                 'unaccent(\'%'.$words.'%\') OR '.
                 'unaccent(concat(last_name,mothers_last_name,name)) ILIKE '.
                 'unaccent(\'%'.$words.'%\')';

      } elseif ( $req->search_type === 'email' ) {

        $query = 'email LIKE \'%'.$req->words.'%\'';
        
      } elseif ( $req->search_type === 'rfc' ) {

        $query = 'rfc LIKE \'%'.$req->words.'%\'';

      } elseif ( $req->search_type === 'worker_number' ) {

        $query = 'worker_number LIKE \'%'.$req->words.'%\'';

      }

      if ( $query ) {
        
        $professors = Professor::whereRaw($query)
          ->orderByRaw( 'unaccent(lower(concat(' .
                          'name, last_name, mothers_last_name' .
                        ')))'
                      )
          ->get();

      } else {
        
        $professors = collect();

      }
  
      return view("pages.view-professors")
          ->with("professors", $professors);

    } catch (\Illuminate\Database\QueryException $th) {

      return redirect()
              ->route('home')
              ->with('danger', 'Problema con la base de datos.');

    }
  }

  public function create(){
      return view ("pages.create-professor");
  }

  public function store(Request $req){
      try {
          $professor = new professor();
          $professor->professor_id = DB::select("select nextval('professor_seq')")[0]->nextval;
          $professor->name = $req->name;
          $professor->last_name = $req->last_name;
          $professor->mothers_last_name = $req->mothers_last_name;
          $professor->rfc = $req->rfc;
          $professor->worker_number = $req->worker_number;
          $professor->birthdate = $req->birthdate;
          $professor->phone_number = $req->phone_number;
          $professor->degree = $req->degree;
          $professor->email = $req->email;
          $professor->gender = $req->gender;
          $professor->semblance = $req->semblance;
          $professor->is_instructor = $req->is_instructor;
          $professor->provenance = $req->provenance;
          $professor->save();

          return redirect()
            ->route('view.professors')
            ->with('success', 'Profesor creado correctamente');

      } catch (\Illuminate\Database\QueryException $th) {
          if($th->getCode() == 7)
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

  public function edit($professor_id){
      try {
          $professor = Professor::findOrFail($professor_id);
          return view("pages.update-professor")
            ->with("professor",$professor);
      } catch (\Illuminate\Database\QueryException $th) {
          return redirect()
            ->route('view.professors')
            ->with('danger','Problema con la base de datos.');
      }
  }

  public function update(Request $req, $professor_id){
      try {
          $professor = Professor::findOrFail($professor_id);
          $professor->name = $req->name;
          $professor->last_name = $req->last_name;
          $professor->mothers_last_name = $req->mothers_last_name;
          $professor->rfc = $req->rfc;
          $professor->worker_number = $req->worker_number;
          $professor->birthdate = $req->birthdate;
          $professor->phone_number = $req->phone_number;
          $professor->degree = $req->degree;
          $professor->email = $req->email;
          $professor->gender = $req->gender;
          $professor->semblance = $req->semblance;
          $professor->is_instructor = $req->is_instructor;
          $professor->provenance = $req->provenance;
          $professor->save();

          return redirect()
            ->route('edit.professor',$professor->professor_id)
            ->with('success', 'Cambios realizados.');
            
      } catch (\Illuminate\Database\QueryException $th) {
          if($th->getCode() == 7)
              return redirect()
                ->route('home')
                ->with('danger', 'No hay conexión con la base de datos.');
          else
              return redirect()
                ->back()
                ->with('professor',$professor)
                ->with('warning', 'Error al almacenar, verifique sus datos.');
      }
  }

  public function delete($professor_id){
      try {
        $professor = Professor::findOrFail($professor_id);
        $professor->delete();
        
        return redirect()
          ->route('view.professors')
          ->with('success', 'Eliminado correctamente.');
  
      } catch (\Illuminate\Database\QueryException $th) {
        
        if($th->getCode() == 7)
          return redirect()
            ->route('home')
            ->with('danger', 'No hay conexión con la base de datos.');
        else
          return redirect()
            ->back()
            ->with('warning', 'Error al eliminar el profesor.');
      }
  }

  public function downloadRecord($professor_id){
    try {

      $professor = Professor::findOrFail($professor_id);

      $professor->activities = DB::table('participant as p')
        ->join('activity as a', 'a.activity_id', '=', 'p.activity_id')
        ->join('activity_catalogue as ac', 'ac.activity_catalogue_id', '=', 
                'a.activity_catalogue_id')
        ->where('p.professor_id', $professor_id)
        ->where('p.accredited', TRUE)
        ->select('ac.name', 'ac.hours', 'a.year', 'a.num', 'a.type')
        ->get();

      $pdf = PDF::loadView('docs.professor-record', 
        [
          'professor' => $professor
        ])
        ->setPaper('letter');

      return $pdf->download('HistorialProfesor'.$professor_id.'.pdf');

    } catch(\Illuminate\Database\QueryException $th) {
      if($th->getCode() == 7)
          return redirect()
            ->route('home')
            ->with('danger', 'No hay conexión con la base de datos.');
        else
          return redirect()
            ->back()
            ->with('warning', 'Error al generar el reporte.');
    }
  }
}

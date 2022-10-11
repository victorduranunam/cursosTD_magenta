<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrator;
use Illuminate\Support\Facades\DB;

class AdministratorController extends Controller
{
  public function index()
  {
      try {

        $administrators = Administrator::orderByRaw('unaccent(lower(last_name || mothers_last_name || name))')
          ->get();

        return view("pages.view-administrators")
          ->with("administrators", $administrators);

      } catch (\Illuminate\Database\QueryException $th) {
        
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');
      }
  }

  public function create() {
    return view ("pages.create-administrator");
  }

  public function store(Request $req){
    try{

      $administrator = new Administrator();
      $administrator->administrator_id = DB::select("select nextval('administrator_seq')")[0]->nextval;
      $administrator->name = $req->name;
      $administrator->last_name = $req->last_name;
      if($req->mothers_last_name)
        $administrator->mothers_last_name = $req->mothers_last_name;
      if($req->degree)
        $administrator->degree = $req->degree;
      if($req->gender)
        $administrator->gender = $req->gender;
      
      // Double if for skipping the query when is not required.
      if ( $req->job === 'S' )
        if(Administrator::where('job', 'S')->first())
          return redirect()
            ->back()
            ->withInput()
            ->with('danger', 'No es posible crear a más de un '      .
            'Secretario de Apoyo a la Docencia. ' .
            'Por favor elimine al administrador con el puesto que '.
            'desea crear para continuar o simplemente edítelo en lugar de ' .
            'crear uno nuevo.');
      if ( $req->job === 'O' )
        if(Administrator::where('job', 'O')->first())
          return redirect()
            ->back()
            ->withInput()
            ->with('danger', 'No es posible crear a más de un '      .
            'Coordinador General. ' .
            'Por favor elimine al administrador con el puesto que '.
            'desea crear para continuar o simplemente edítelo en lugar de ' .
            'crear uno nuevo.');
      if ( $req->job === 'D' )
        if(Administrator::where('job', 'D')->first())
          return redirect()
            ->back()
            ->withInput()
            ->with('danger', 'No es posible crear a más de un Director. '.
            'Por favor elimine al administrador con el puesto que '.
            'desea crear para continuar o simplemente edítelo en lugar de ' .
            'crear uno nuevo.');

      $administrator->job = $req->job;
      $administrator->save();

      return redirect()
        ->route('view.administrators')
        ->with('success', 'Administrador creado correctamente');

    } catch (\Illuminate\Database\QueryException $th) {
      if($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'No hay conexión con la base de datos.');
      else
        return dd($th);
        return redirect()
          ->back()
          ->with('warning', 'Error al almacenar, verifique sus datos.')
          ->withInput();
    }
  }

  public function edit($administrator_id){
    
    try {
      
      $administrator = Administrator::findOrFail($administrator_id);
      
      return view("pages.update-administrator")
        ->with("administrator", $administrator);

    } catch (\Illuminate\Database\QueryException $th) {
      
      return redirect()
        ->route('view.administrators')
        ->with('danger', 'Problema con la base de datos');
    }
  }

  public function update(Request $req, $administrator_id){
    
    try {

      $administrator = Administrator::findOrFail($administrator_id);
      $administrator->name = $req->name;
      $administrator->last_name = $req->last_name;
      $administrator->mothers_last_name = $req->mothers_last_name;
      if($req->degree)
        $administrator->degree = $req->degree;
      if($req->gender)
        $administrator->gender = $req->gender;
      $administrator->job = $req->job;
      $administrator->save();

      return redirect()
        ->route('edit.administrator', $administrator->administrator_id)
        ->with('success', 'Cambios realizados.');

    } catch (\Illuminate\Database\QueryException $th) {
      
      if($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'No hay conexión con la base de datos.');
      else
        return redirect()
          ->back()
          ->with('administrator', $administrator)
          ->with('warning', 'Error al almacenar, verifique sus datos.');
    }
  }

  public function delete($administrator_id){
    
    try {
      
      $administrator = Administrator::findOrFail($administrator_id);
      $administrator->delete();
      
      return redirect()
        ->route('view.administrators')
        ->with('success', 'Eliminado correctamente.');

    } catch (\Illuminate\Database\QueryException $th) {
      
      if($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'No hay conexión con la base de datos.');
      else
        return redirect()
          ->back()
          ->with('warning', 'Error al eliminar al administrador.');
    }
  }
}

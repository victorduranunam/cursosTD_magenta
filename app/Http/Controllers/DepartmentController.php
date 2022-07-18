<?php
//TODO:Verificar reglas de negocio, quien puede ser coordinador de que
namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
  public function index()
  {
      try {

        $departments = Department::where('abbreviation', '<>', 'CDD')
          ->get()
          ->sortByDesc('name');

        return view("pages.view-departments")
          ->with("departments", $departments);

      } catch (\Illuminate\Database\QueryException $th) {
        
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');
      }
  }

  public function create() {
    $administrators = Administrator::where('job', 'C')
      ->orderByRaw('last_name || mothers_last_name || name')
      ->get();
    return view ("pages.create-department")
      ->with('administrators', $administrators);
  }

  public function store(Request $req){
    
    try{

      $department = new Department();
      $department->department_id = DB::select("select nextval('department_seq')")[0]->nextval;
      $department->name = $req->name;
      $department->abbreviation = $req->abbreviation;
      $department->administrator_id = $req->administrator_id;
      $department->save();

      return redirect()
        ->route('view.departments')
        ->with('success', 'Coordinación creada correctamente');

    } catch (\Illuminate\Database\QueryException $th) {
      if($th->getCode() == 7)
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

  public function edit($department_id){
    
    try {
      
      $department = Department::findOrFail($department_id);
      $administrators = Administrator::where('job', 'C')
        ->orderByRaw('last_name || mothers_last_name || name')
        ->get();
      
      return view("pages.update-department")
        ->with("department", $department)
        ->with('administrators', $administrators);

    } catch (\Illuminate\Database\QueryException $th) {
      
      return redirect()
        ->route('view.departments')
        ->with('danger', 'Problema con la base de datos');
    }
  }

  public function update(Request $req, $department_id){
    
    try {

      $department = Department::findOrFail($department_id);
      $department->name = $req->name;
      $department->abbreviation = $req->abbreviation;
      $department->administrator_id = $req->administrator_id;
      $department->save();

      return redirect()
        ->route('edit.department', $department->department_id)
        ->with('success', 'Cambios realizados.');

    } catch (\Illuminate\Database\QueryException $th) {
      
      if($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');
      else
        return redirect()
          ->back()
          ->with('department', $department)
          ->with('warning', 'Error al almacenar, verifique sus datos.');
    }
  }

  public function delete($department_id){
    
    try {
      
      $department = Department::findOrFail($department_id);
      $department->delete();
      
      return redirect()
        ->route('view.departments')
        ->with('success', 'Eliminado correctamente.');

    } catch (\Illuminate\Database\QueryException $th) {
      
      if($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');
      else
        return redirect()
          ->back()
          ->with('warning', 'Error al eliminar la coordinación.');
    }
  }
}

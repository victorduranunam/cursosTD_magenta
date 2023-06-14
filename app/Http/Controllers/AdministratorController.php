<?php
namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Department;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends Controller
{
  public function auth(Request $req) {
    try{

      $user = array(
        'username' => $req->username,
        'password' => $req->password
      );
    
      if (Auth::attempt($user))

        return redirect()
             ->route('home')
             ->with('success', 'Bienvenid@');
      
      return redirect()
           ->route('login')
           ->with('danger', 'Credenciales incorrectas. Intente de nuevo.');

    } catch(\Illuminate\Database\QueryException $th){
      
      echo($th);
      return redirect()
           ->route('login')
           ->with('warning', 'Problema con la base de datos.');
    }
  
  }

  public function logout(){
    
    Auth::logout();
    
    return redirect()
         ->route('welcome');
  }

  public function index()
  {
      try {

        $administrators = DB::table('administrator as a')
        ->leftJoin('department as d', 'a.department_id', '=', 'd.department_id')
        ->orderByRaw(
            "unaccent(lower(concat(' ', a.last_name, a.mothers_last_name, a.name)))"
          )
        ->select('a.administrator_id', 'a.name', 'a.last_name', 
          'a.mothers_last_name', 'd.abbreviation as department_abbreviation')
        ->get();

        return view("pages.view-administrators")
          ->with("administrators", $administrators);

      } catch (\Illuminate\Database\QueryException $th) {
        return $th;
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

      } elseif ( $req->search_type === 'username' ) {

        $query = 'username LIKE \'%'.$req->words.'%\'';

      }

      if ( $query ) {
        
        $administrators = Administrator::whereRaw($query)
          ->orderByRaw( 'unaccent(lower(concat(' .
                          'name, last_name, mothers_last_name' .
                        ')))'
                      )
          ->get();

      } else {
        
        $administrators = collect();

      }
  
      return view("pages.view-administrators")
          ->with("administrators", $administrators);

    } catch (\Illuminate\Database\QueryException $th) {

      return redirect()
              ->route('home')
              ->with('danger', 'Problema con la base de datos.');

    }
  }

  public function create() {

    return view ("pages.create-administrator")
         ->with('departments', DB::table('department')
                                 ->select('department_id', 'name')
                                 ->get());

  }

  public function store(Request $req){
    try{
      $administrator = new Administrator();
      
      $administrator->administrator_id = DB::select(
        "select nextval('administrator_seq')")[0]
        ->nextval;

      $administrator->name = $req->name;
      $administrator->last_name = $req->last_name;
      $administrator->username = $req->username;
      $administrator->password = Hash::make($req->password);
      $administrator->admin = $req->admin;
      $administrator->mothers_last_name = $req->mothers_last_name;
      $administrator->degree = $req->degree;
      
      if($administrator->depertment_id === '')
        $administrator->department_id  = NULL;
      else
        $administrator->department_id  = $req->department_id;

      if($administrator->gender === '')
        $administrator->gender  = NULL;
      else
        $administrator->gender  = $req->gender;

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
           ->with('departments', DB::table('department')
                                   ->select('department_id', 'name')
                                   ->get())
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
      $administrator->degree = $req->degree;
      $administrator->username = $req->username;
      $administrator->password = Hash::make($req->password, ['rounds'=> 10]);
      $administrator->admin = $req->admin;

      if($administrator->depertment_id === '')
        $administrator->department_id  = NULL;
      else
        $administrator->department_id  = $req->department_id;

      if($administrator->gender === '')
        $administrator->gender  = NULL;
      else
        $administrator->gender  = $req->gender;

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

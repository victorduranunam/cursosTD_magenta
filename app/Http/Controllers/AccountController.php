<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Models\Department;

class AccountController extends Controller
{
  public function auth(Request $req) {
    try{
      $user = array(
        'username' => $req->username,
        'password' => $req->password
      );
    
      if (Auth::attempt($user))
        return redirect()->route('home')->with('success', 'Bienvenid@');
      
      return redirect()->route('login')->with('danger', 'Credenciales incorrectas. Intente de nuevo.');

    } catch(\Illuminate\Database\QueryException $th){
      return redirect()->route('login')->with('warning', 'Problema con la base de datos.');
    }
  
  }

  public function logout(){
    Auth::logout();
    return redirect()
      ->route('welcome');
  }

  public function index(){

    $accounts = Account::all();

    return view('pages.view-accounts')
           ->with('accounts', $accounts);
  }

  public function create() {

    $departments = Department::all();
    return view('pages.create-account')
         ->with('departments', $departments);
  }

  public function store(Request $req) {
    try{

      $account = new Account();
      $account->username = $req->username;
      $account->name = $req->name;
      $account->password = Hash::make($req->password);
      $account->admin = $req->admin;
      $account->department_id  = $req->department_id;
      $account->save();

    } catch(\Illuminate\Database\QueryException $th) {
          
      if ($th->getCode() == 7)
          return redirect()
              ->route('home')
              ->with('danger', 'No hay conexión con la base de datos.');

      elseif ($th->getCode() == 23514) {

        return redirect()
          ->back()
          ->with('danger', 'El nombre de usuario debe ser único');
      }

      else
          return redirect()
              ->back()
              ->with('danger', 'Error al almacenar cuenta de usuario.');
    }
  }

  public function edit($account_id) {

    $account = Account::findOrFail($account_id);
    $departments = Department::all();

    return view('pages.update-account')
         ->with('departments', $departments)
         ->with('account', $account);

  }

  public function update(Request $req, $account_id) {
    try{

      $account = Account::findOrFail($account_id);
      $account->username = $req->username;
      $account->name = $req->name;
      $account->password = Hash::make($req->password, ['rounds'=> 10]);
      $account->admin = $req->admin;
      $account->department_id  = $req->department_id;
      $account->save();

      return redirect()
           ->route('edit.account', $account_id)
           ->with('success', 'Cambios realizados exitosamente');

    } catch(\Illuminate\Database\QueryException $th) {
          
      if ($th->getCode() == 7)
          return redirect()
              ->route('home')
              ->with('danger', 'No hay conexión con la base de datos.');

      elseif ($th->getCode() == 23514) {

        return redirect()
          ->back()
          ->with('danger', 'El nombre de usuario debe ser único');
      }

      else
          return redirect()
              ->back()
              ->with('danger', 'Error al actualizar cuenta de usuario.');
    }
  }

  public function delete($account_id) {
    try{

      $account = Account::findOrFail($account_id);
      $account->delete();

      return redirect()
              ->route('view.accounts')
              ->with('success', 'Cuenta de usuario eliminada correctamente.');

    } catch(\Illuminate\Database\QueryException $th) {
          
      if ($th->getCode() == 7)
          return redirect()
              ->route('home')
              ->with('danger', 'No hay conexión con la base de datos.');

      else
          return redirect()
              ->back()
              ->with('danger', 'Error al eliminar cuenta de usuario.');
    }
  }
}

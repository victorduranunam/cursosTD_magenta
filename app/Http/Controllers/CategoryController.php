<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
  public function index()
  {
    try {

      $categories = Category::all()
        ->sortBy('name');

      return view("pages.view-categories")
        ->with("categories", $categories);

    } catch (\Illuminate\Database\QueryException $th) {
      
      return redirect()
        ->route('home')
        ->with('danger', 'Problema con la base de datos.');
    }
  }

  public function create()
  {
    return view("pages.create-category");
  }

  public function store(Request $req)
  {
    try {
      $category = new Category();
      $category->category_id = DB::select("select nextval('category_seq')")[0]->nextval;
      $category->name = $req->name;
      $category->abbreviation = $req->abbreviation;
      $category->save();

      return redirect()
        ->route('view.categories')
        ->with('success', 'Categoría creada correctamente');

    } catch (\Illuminate\Database\QueryException $th) {
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

  public function edit($category_id)
  {
    try {
      
      $category = Category::findOrFail($category_id);

      return view("pages.update-category")
        ->with("category", $category);

    } catch (\Illuminate\Database\QueryException $th) {
      
      return redirect()
        ->route('view.categories')
        ->with('danger', 'Problema con la base de datos.');
    }
  }

  public function update(Request $req, $category_id)
  {
    
    try {
     
      $category = Category::findOrFail($category_id);
      $category->name = $req->name;
      $category->abbreviation = $req->abbreviation;
      $category->save();

      return redirect()
        ->route('edit.category', $category->category_id)
        ->with('success', 'Cambios realizados.');

    } catch (\Illuminate\Database\QueryException $th) {
      if ($th->getCode() == 7)
        return redirect()
          ->route('home')
          ->with('danger', 'Problema con la base de datos.');
      else
        return redirect()
          ->back()
          ->with('category', $category)
          ->with('warning', 'Error al almacenar, verifique sus datos.');
    }
  }

  public function delete($category_id)
  {
    try {
      
      $category = Category::findOrFail($category_id);
      $category->delete();

      return redirect()
        ->route('view.categories')
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

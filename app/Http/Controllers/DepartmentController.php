<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use phpDocumentor\Reflection\Types\Null_;

class DepartmentController extends Controller
{
    public function index()
    {
        try {
          $departments = Department::where('abbreviation', '<>', 'CDD')->get();
          return view("pages.view-departments")
            ->with("departments", $departments);
        } catch (\Illuminate\Database\QueryException $th) {
          return view("pages.home")
            ->with('danger', 'Problema con la base de datos.');
        }
    }

    public function create(){
      $department = new Department();
      return $department;
    }

    public function update($department_id){
      $department = Department::findOrFail($department_id);
      return $department;
    }

    public function delete($department_id){
      $department = Department::findOrFail($department_id);
      return $department;
    }
}

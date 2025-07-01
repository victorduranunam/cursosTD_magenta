<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use DB;
use PDF;


class StudentController extends Controller
{

    public function index2()
    {
        return view('pages.view-students'); // O solo un texto para prueba temporal
        //return "Sí entró al método index del StudentController ";
    }

  public function index()
  {
      try {
          $Students = Student::orderByRaw('unaccent(lower(name || last_name || mothers_last_name))')
          ->get();

          return view("pages.view-students")
              ->with("Students",$Students);
          
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
        
        $Students = Student::whereRaw($query)
          ->orderByRaw( 'unaccent(lower(concat(' .
                          'name, last_name, mothers_last_name' .
                        ')))'
                      )
          ->get();

      } else {
        
        $Students = collect();

      }
  
      return view("pages.view-students")
          ->with("Students", $Students);

    } catch (\Illuminate\Database\QueryException $th) {

      return redirect()
              ->route('home')
              ->with('danger', 'Problema con la base de datos.');

    }
  }

  public function create(){
      return view ("pages.create-student");
  }

  public function store(Request $req){
      try {
          $Student = new Student();
          $Student->student_id = DB::select("select nextval('Student_seq')")[0]->nextval;
          $Student->name = $req->name;
          $Student->last_name = $req->last_name;
          $Student->mothers_last_name = $req->mothers_last_name;
          $Student->rfc = $req->rfc;
          $Student->worker_number = $req->worker_number;
          $Student->student_number = $req->student_number;
          $Student->phone_number = $req->phone_number;
          $Student->degree = $req->degree;
          $Student->email = $req->email;
          $Student->gender = $req->gender;
          $Student->save();

          return redirect()
            ->route('view.student')
            ->with('success', 'Alumno creado correctamente');

      } catch (\Illuminate\Database\QueryException $th) {

         dd($th->getMessage());

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

  public function edit($Student_id){
      try {
          $Student = Student::findOrFail($Student_id);
          return view("pages.update-student")
            ->with("Student",$Student);
      } catch (\Illuminate\Database\QueryException $th) {
          return redirect()
            ->route('view.Student')
            ->with('danger','Problema con la base de datos.');
      }
  }

  public function update(Request $req, $Student_id){
      try {
          $Student = Student::findOrFail($Student_id);
          //$Student->Student_id = $req->Student_id;
          $Student->name = $req->name;
          $Student->last_name = $req->last_name;
          $Student->mothers_last_name = $req->mothers_last_name;
          $Student->rfc = $req->rfc;
          $Student->worker_number = $req->worker_number;
          $Student->student_number = $req->student_number;
          $Student->phone_number = $req->phone_number;
          $Student->degree = $req->degree;
          $Student->email = $req->email;
          $Student->gender = $req->gender;
          $Student->save();

          return redirect()
            ->route('edit.student',$Student_id)
            ->with('success', 'Cambios realizados.');
            
      } catch (\Illuminate\Database\QueryException $th) {
          if($th->getCode() == 7)
              return redirect()
                ->route('home')
                ->with('danger', 'No hay conexión con la base de datos.');
          else
              return redirect()
                ->back()
                ->with('Student',$Student)
                ->with('warning', 'Error al almacenar, verifique sus datos.');
      }
  }

  public function delete($Student_id){
      try {
        $Student = Student::findOrFail($Student_id);
        $Student->delete();
        
        return redirect()
          ->route('view.student')
          ->with('success', 'Eliminado correctamente.');
  
      } catch (\Illuminate\Database\QueryException $th) {
        
        if($th->getCode() == 7)
          return redirect()
            ->route('home')
            ->with('danger', 'No hay conexión con la base de datos.');
        else
          return redirect()
            ->back()
            ->with('warning', 'Error al eliminar al estudiante.');
      }
  }

  public function downloadRecord($Student_id){
    try {

      $Student = Student::findOrFail($Student_id);

      $Student->activities = DB::table('participant as p')
        ->join('activity as a', 'a.activity_id', '=', 'p.activity_id')
        ->join('activity_catalogue as ac', 'ac.activity_catalogue_id', '=', 
                'a.activity_catalogue_id')
        ->where('p.Student_id', $Student_id)
        ->where('p.accredited', TRUE)
        ->select('ac.name', 'ac.hours', 'a.year', 'a.num', 'a.type')
        ->get();

      $pdf = PDF::loadView('docs.Student-record', 
        [
          'Student' => $Student
        ])
        ->setPaper('letter');

      return $pdf->download('HistorialStudent'.$Student_id.'.pdf');

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

<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Administrator;
use App\Models\Diploma;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;
use ZipArchive;

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


  public function createDiplomaCertificates(Request $req, $diploma_id) {

    try {
      $diploma = Diploma::findOrFail($diploma_id);

      return view('pages.create-diploma-certificates')
        ->with('diploma', $diploma);


    } catch (\Throwable $th) {
      
      return dd($th);
    
    }

  }

  public function downloadDiplomaCertificates(Request $req, $diploma_id) {
    try {

      $diploma = Diploma::findOrFail($diploma_id);

      $modules = Activity::join('activity_catalogue as ac',
                                            'ac.activity_catalogue_id',
                                            '=',
                                            'activity.activity_catalogue_id')
                                     ->where('ac.diploma_id', $diploma_id)
                                     ->where('ac.type', 'DI')
                                     ->where('activity.year', $req->year_search)
                                     ->select('activity.activity_id', 'ac.name',
                                              'ac.hours', 'ac.module')
                                     ->get();

      if($modules->isEmpty())
        return redirect()
             ->back()
             ->with('warning', 'No hay módulos asignados a este diplomado.'
                              .' Primero asigne algunos.');

      $diploma->duration = $modules->sum('hours');

      $diploma->participants = collect([]);

      foreach($modules as $module) {

        foreach($module->getParticipants() as $participant) {

          if( $diploma->participants->doesntContain('professor_id',$participant->professor_id) && $participant->accredited)

            $diploma->participants->push(collect([
              'professor_id'      => $participant->professor_id,
              'name'              => $participant->name,
              'last_name'         => $participant->last_name,
              'mothers_last_name' => $participant->mothers_last_name,
              'grades'            => collect([[
                'name' => $module->name,
                'number' => $module->module,
                'grade' => $participant->grade
              ]])
            ]));

          elseif ($diploma->participants->has($participant->professor_id) && $participant->accredited) {

            $tmp = $diploma->participants->where('professor_id', $participant->professor_id)->first()['grades'];
            $tmp[] = [
              'name' => $module->name,
              'number' => $module->module,
              'grade' => $participant->grade
            ];
            $diploma->participants->where('professor_id', $participant->professor_id)->first()['grades'] = $tmp;

          } else

            continue;
        }

      }

      if($diploma->participants->isEmpty())
        return redirect()
             ->back()
             ->with('warning','No hay participantes inscritos a todos los'.
                             ' módulos que ameriten constancia. Al menos'.
                             ' uno debe haber participado en todos los módulos'.
                             ' y haberlos acreditado.');

      foreach($diploma->participants as $key => $participant){
        if(count($participant['grades']) != $modules->count())
          $diploma->participants->pull($key);

        else
          $participant['average'] = $participant['grades']->sum('grade')
                                  / $modules->count();
      }

      $zip = new ZipArchive();

      $fileName = 'Diplomas_'
                .$diploma->getFileName()
                .'.zip';


      if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
        foreach($diploma->participants as $ix => $participant) {
          $participant['key'] = $req->key.sprintf("%03s", $ix+1);
          $pdfname = strval($ix+1)
                    .'_Diploma_'
                    .$participant['name']
                    .$participant['last_name']
                    .$participant['mothers_last_name']
                    .'.pdf';

          $pdf = PDF::loadView('docs.diploma', [
            'diploma_name'     => $diploma->name,
            'diploma_duration' => $diploma->duration,
            'participant'      => $participant,
            'signatures'       => $req->signatures,
            'page'             => isset($req->page) ? $req->page : '',
            'certificate_date' => isset($req->certificate_date) ? $req->certificate_date : '',
            'book'             => isset($req->book) ? $req->book : '',

            'first_name_signature'    => isset($req->first_name_signature)    ? $req->first_name_signature    : NULL,
            'second_name_signature'   => isset($req->second_name_signature)   ? $req->second_name_signature   : NULL,
            'third_name_signature'    => isset($req->third_name_signature)    ? $req->third_name_signature    : NULL,
            'fourth_name_signature'   => isset($req->fourth_name_signature)   ? $req->fourth_name_signature   : NULL,
            'fifth_name_signature'    => isset($req->fifth_name_signature)    ? $req->fifth_name_signature    : NULL,
            
            'first_degree_signature'  => isset($req->first_degree_signature)  ? $req->first_degree_signature  : NULL,
            'second_degree_signature' => isset($req->second_degree_signature) ? $req->second_degree_signature : NULL,
            'third_degree_signature'  => isset($req->third_degree_signature)  ? $req->third_degree_signature  : NULL,
            'fourth_degree_signature' => isset($req->fourth_degree_signature) ? $req->fourth_degree_signature : NULL,
            'fifth_degree_signature'  => isset($req->fifth_degree_signature)  ? $req->fifth_degree_signature  : NULL
          ])->setPaper('letter','landscape');

          $zip->addFromString($pdfname, $pdf->download($pdfname));

        }
    
        $zip->close();
      } else 
        return 'Error con zip';
      
      return response()
           ->download(public_path($fileName))
           ->deleteFileAfterSend(public_path($fileName));

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

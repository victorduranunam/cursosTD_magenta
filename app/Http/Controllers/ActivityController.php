<?php

namespace App\Http\Controllers;
use App\Models\Activity;
use App\Models\ActivityCatalogue;
use App\Models\Department;
use App\Models\Instructor;
use App\Models\Participant;
use App\Models\SeminarTopic;
use App\Models\Venue;
use App\Exports\DBExport;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;
use ZipArchive;
use App\Exports\KeysExport;
use Maatwebsite\Excel\Facades\Excel;

class ActivityController extends Controller
{
    public function index(){
        try {
          $activities = Activity::join('activity_catalogue', 'activity_catalogue.activity_catalogue_id', '=', 'activity.activity_catalogue_id')
                                ->select('activity.*', 'activity_catalogue.name as catalogue_name')
                                ->orderByRaw('unaccent(lower(activity_catalogue.name))')
                                ->get();

          return view("pages.view-activities")
            ->with("activities", $activities);
    
        } catch (\Illuminate\Database\QueryException $th) {
          if ($th->getCode() == 7)
            return redirect()
              ->route('home')
              ->with('danger', 'No hay conexión con la base de datos.');
          else
            return redirect()
              ->route('home')
              ->with('danger', 'Problema con la base de datos.');
        }
    }

    public function create($activity_catalogue_id){  
      try{

        $activity_cat = ActivityCatalogue::findOrFail($activity_catalogue_id);
        $venues = Venue::all();

        return view('pages.create-activity')
            ->with("activity_cat", $activity_cat)
            ->with("venues",$venues);

        } catch (\Illuminate\Database\QueryException $th){
            
          if ($th->getCode() == 7)
            return redirect()
              ->route('home')
              ->with('danger', 'No hay conexión con la base de datos.');
          
          else
            return redirect()
              ->route('view.activities.catalogue')
              ->with('danger','Problema con la base de datos.');
        }

    }

    public function store(Request $req){
        try{
          // 
            $activity = new Activity(); 
            $activity->activity_id = DB::select("select nextval('activity_seq')")[0]->nextval;
            $activity->year = $req->year;
            $activity->num = $req->num;
            $activity->type = $req->type;
            $activity->start_time = $req->start_time;
            $activity->end_time = $req->end_time;
            $activity->manual_date = $req->manual_date;
            $activity->days_week = implode('', $req->days_week);
            $activity->ctc = $req->ctc;
            $activity->cost = $req->cost;
            $activity->max_quota = $req->max_quota;
            $activity->min_quota = $req->min_quota;
            $activity->activity_catalogue_id = $req->activity_catalogue_id;
            $activity->venue_id = $req->venue_id;
            $activity->save();
            return redirect()
                ->route('view.activities')
                ->with('success', 'Actividad creada correctamente');
        }catch (\Illuminate\Database\QueryException $th) {
            if ($th->getCode() == 7)
              return redirect()
                ->route('home')
                ->with('danger', 'No hay conexión con la base de datos.');
            else
            //23502->not nulls
              return dd($th);   
          }

    }

    public function edit($activity_id){
      try{
        $activity = Activity::findOrFail($activity_id);
        $venues = Venue::all();

        return view("pages.update-activity")
          ->with("activity",$activity)
          ->with("venues",$venues);
      }catch (\Illuminate\Database\QueryException $th) {
        return redirect()
          ->route('view.activities')
          ->with('danger', 'Problema con la base de datos.');
      }

    }

    public function update(Request $req, $activity_id){
      try{
        $activity = Activity::findOrFail($activity_id);

        $activity->year = $req->year;
        $activity->num = $req->num;
        $activity->type = $req->type;
        $activity->start_time = $req->start_time;
        $activity->end_time = $req->end_time;
        $activity->manual_date = $req->manual_date;
        $activity->days_week = implode('', $req->days_week);
        $activity->ctc = $req->ctc;
        $activity->cost = $req->cost;
        $activity->max_quota = $req->max_quota;
        $activity->min_quota = $req->min_quota;
        $activity->venue_id = $req->venue_id;
        $activity->save();
        return redirect()
        ->route('edit.activity', $activity->activity_id)
        ->with('success', 'Cambios realizados.');

      }catch (\Illuminate\Database\QueryException $th) {
        if ($th->getCode() == 7)
          return redirect()
            ->route('home')
            ->with('danger', 'No hay conexión con la base de datos.');
        else
          return redirect()
            ->back()
            ->with('activity', $activity)
            ->with('warning', 'Error al almacenar, verifique sus datos.');
      }
    }

    public function delete($activity_id){
      try {
      
        $activity = Activity::findOrFail($activity_id);
        $activity->delete();
  
        return redirect()
          ->route('view.activities')
          ->with('success', 'Eliminado correctamente.');
  
      } catch (\Illuminate\Database\QueryException $th) {
  
        if ($th->getCode() == 7)
          return redirect()
            ->route('home')
            ->with('danger', 'No hay conexión con la base de datos.');
        else
          return redirect()
            ->back()
            ->with('warning', 'Error al eliminar la Actividad.');
      }
    }

    
    public function createCertificates($activity_id){
      try{
        
        $activity = Activity::findOrFail($activity_id);

        return view('pages.create-activity-certificates')
             ->with('activity', $activity);

      } catch(\Illuminate\Database\QueryException $th) {
        if ($th->getCode() == 7)
          return redirect()
            ->route('home')
            ->with('danger', 'No hay conexión con la base de datos.');
        else
          return redirect()
            ->back()
            ->with('warning', 'Error al eliminar la Actividad.');
      }
    }
    
    public function createRecognitions($activity_id){
      try{
        
        $activity = Activity::findOrFail($activity_id);
        $activity->catalogue_type = ActivityCatalogue::findOrFail($activity->activity_catalogue_id)
                                           ->getType();

        return view('pages.create-activity-recognitions')
             ->with('activity', $activity);

      } catch(\Illuminate\Database\QueryException $th) {
        if ($th->getCode() == 7)
          return redirect()
            ->route('home')
            ->with('danger', 'No hay conexión con la base de datos.');
        else
          return redirect()
            ->back()
            ->with('warning', 'Error al eliminar la Actividad.');
      }
    }

    public function downloadCertificates(Request $req, $activity_id){
      
      try {

        $zip = new ZipArchive();
        
        $activity = Activity::findOrFail($activity_id);
        $activity->certificate_date = $req->certificate_date;
        $activity->save();
        $activity->participants = Participant::where('activity_id', $activity_id)
                                ->where('accredited', TRUE)
                                ->get();
        
        if($activity->participants->isEmpty())
          return redirect()
                ->back()
                ->with('warning', 'No existen participantes acreditados para generar constancias de esta actividad.');
               
        $fileName = 'Constancias_'.$activity->getFileName().'.zip';

        $count = 0;
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        {
          foreach($activity->participants as $participant){
            $count += 1;
            $participant->key = $req->key.sprintf("%03s", $count);
            $participant->save();
            $participant->name = $participant->getFullNameFile();

            $pdfname = strval($count).'_Constancia_'.$participant->name.'.pdf';  
            $pdf = PDF::loadView('docs.certificate', 
            [
              'activity_name' => $activity->getName(),
              'activity_manual_date' => $activity->manual_date,
              'activity_hours' => $activity->getHours(),
              'activity_certificate_date' => $activity->certificate_date,
              'participant_name' => $participant->getFullName(),
              'participant_key' => $participant->key,
              'text' => $req->text == 'custom' ? $req->custom_text : $req->text,
              'signatures' => $req->signatures,

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
            ])
            ->setPaper('letter','landscape');
            $zip->addFromString($pdfname, $pdf->download($pdfname));
          }
    
          $zip->close();
        }
        return response()->download(public_path($fileName))->deleteFileAfterSend(public_path($fileName));

      } catch(\Illuminate\Database\QueryException $th){
        if ($th->getCode() == 7)
          return redirect()
            ->route('home')
            ->with('danger', 'No hay conexión con la base de datos.');

        else if ($th->getCode() == 23505)
          return redirect()
            ->back()
            ->with('danger', 'El folio ya existe para otras constancias.');
        else
          return redirect()
            ->back()
            ->with('warning', 'Error al generar la constancia.');
      }
    }
    
    public function downloadRecognitions(Request $req, $activity_id){

      try {

        $zip = new ZipArchive();
        
        $activity = Activity::findOrFail($activity_id);
        $activity->recognition_date = $req->recognition_date;
        $activity->save();
        $activity->instructors = Instructor::where('activity_id', $activity_id)
                               ->get();
        $activity->catalogue_type = ActivityCatalogue::findOrFail($activity->activity_catalogue_id)
                                                     ->getType();

        if($activity->catalogue_type == 'Seminario'){

          $activity->topics = SeminarTopic::where('activity_id', $activity->activity_id)->get();
          
          if($activity->topics->isEmpty())
          return redirect()
          ->back()
          ->with('warning', 'No existen temas de seminario asignados para generar reconocimientos de esta actividad.'); 
        }
      
        if($activity->instructors->isEmpty())
          return redirect()
                ->back()
                ->with('warning', 'No existen instructores asignados para generar reconocimientos de esta actividad.');
               
        $fileName = 'Reconocimientos_'.$activity->getFileName().'.zip';

        $count = 0;
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        {
          foreach($activity->instructors as $instructor){
            $count += 1;
            $instructor->key = $req->key.sprintf("%03s", $count);
            $instructor->save();
            $instructor->name = $instructor->getFullNameFile();
            $instructor->topics = SeminarTopic::where('instructor_id', $instructor->instructor_id)->get();

            $pdfname = strval($count).'_Reconocimiento_'.$instructor->name.'.pdf';  
            $pdf = PDF::loadView('docs.recognition', 
            [
              'activity_name' => $activity->getName(),
              'activity_manual_date' => $activity->manual_date,
              'activity_hours' => $activity->getHours(),
              'activity_recognition_date' => $activity->recognition_date,
              'activity_catalogue_type' => $activity->catalogue_type,
              'instructor_name' => $instructor->getRecognitionName(),
              'instructor_key' => $instructor->key,
              'instructor_topics' => $instructor->topics,
              'text' => $req->text == 'custom' ? $req->custom_text : $req->text,
              'signatures' => $req->signatures,

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
            ])
            ->setPaper('letter','landscape');
            $zip->addFromString($pdfname, $pdf->download($pdfname));
          }
    
          $zip->close();
        }
        return response()->download(public_path($fileName))->deleteFileAfterSend(public_path($fileName));
      } catch(\Illuminate\Database\QueryException $th){
        if ($th->getCode() == 7)
          return redirect()
            ->route('home')
            ->with('danger', 'No hay conexión con la base de datos.');
        else if ($th->getCode() == 23505)
          return redirect()
            ->back()
            ->with('danger', 'El folio ya existe para otros reconocimientos.');
        else
          return dd($th);
          return redirect()
            ->back()
            ->with('warning', 'Error al generar los reconocimientos.');
      }
    }
    
    
    public function downloadPromo($activity_id){
      try {
        
        $activity = Activity::findOrFail($activity_id);
        $activity->catalogue = ActivityCatalogue::findOrFail($activity->activity_catalogue_id);
        $activity->instructors = Instructor::where('activity_id', $activity->activity_id)->get();
        $activity->venue = Venue::findOrFail($activity->venue_id);

        $pdf = PDF::loadView('docs.activity-promo', 
          [
            'activity' => $activity
          ])
          ->setPaper('letter');
        return $pdf->download('Publicidad_'.$activity->catalogue->name.'.pdf');

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

    public function downloadExport(){
      return Excel::download(new DBExport, 'exportacion_magestic.xlsx');
    }

    public function downloadKeysBook(){
      return Excel::download(new KeysExport, 'libro_folios.xlsx');
    }

    public function downloadGeneralRecord(Request $req){

      try{
        $activities = Activity::where('activity.type', $req->type_search)
                               ->where('activity.num', $req->num_search)
                               ->where('activity.year', $req->year_search)
                               ->get();
        
        if($activities->isEmpty())
          return redirect()
              ->back()
              ->with('danger', 'No se encontraron actividades en el periodo seleccionado.');

        foreach($activities as $activity){
          
          $activity->instructors = $activity->getInstructorsName();
          $activity->name        = $activity->getName();
          $activity->key         = $activity->getKey();
          $activity->venue       = $activity->getVenueName();
          $activity->hours       = $activity->getHours();
        }
        
        $pdf = PDF::loadView('docs.activities-general-record',
          [
            'activities' => $activities,
            'year' => $req->year_search,
            'num' => $req->num_search,
            'type' => $req->type_search
          ]
          )->setPaper('letter','landscape');

        return $pdf->download('Reporte_General_Actividades_'.$req->year_search.
                                                             $req->num_search.
                                                             $req->type_search.
                                                             '.pdf');
      } catch(\Illuminate\Database\QueryException $th){
        if($th->getCode() == 7)
            return redirect()
              ->route('home')
              ->with('danger', 'No hay conexión con la base de datos.');
          else
            return dd($th);
            return redirect()
              ->back()
              ->with('warning', 'Error al generar el reporte.');
      }

    }

    public function downloadSuggestionsRecord(Request $req){
      try{

        $departments = Department::all();

        foreach($departments as $key_dept => $department){
          $department->activities = Activity::join('activity_catalogue as ac', 'ac.activity_catalogue_id', '=', 'activity.activity_catalogue_id')
                                            ->where('ac.department_id', $department->department_id)
                                            ->where('activity.type', $req->type_search)
                                            ->where('activity.num', $req->num_search)
                                            ->where('activity.year', $req->year_search)
                                            ->get();

          foreach($department->activities as $key_act => $activity ){
            $activity->suggestions = $activity->getParticipantsSuggestions();
            if($activity->suggestions->isEmpty()){
              $department->activities->pull($key_act);
              continue;
            }
            $activity->name        = $activity->getName();
          }

          if($department->activities->isEmpty()){
            $departments->pull($key_dept);
            continue;
          }
          
        }

        if($departments->isEmpty())
          return redirect()
               ->back()
               ->with('danger', 'No se encontraron actividades con sugerencias en el periodo seleccionado.');

        
        $pdf = PDF::loadView('docs.activities-suggestions-record',
          [
            'departments' => $departments,
            'year' => $req->year_search,
            'num' => $req->num_search,
            'type' => $req->type_search
          ]
          )->setPaper('letter');

        return $pdf->download('Reporte_Sugerencias_Actividades_'.
                               $req->year_search.
                               $req->num_search.
                               $req->type_search.
                               '.pdf');

      } catch(\Illuminate\Database\QueryException $th){
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

    public function downloadIdentifiers($activity_id){
      
      try {

        $activity = Activity::findOrFail($activity_id);
        $activity->participants = $activity->getParticipantsNames();
        $activity->name = $activity->getName();

        if($activity->participants->isEmpty())
          return redirect()
               ->back()
               ->with('danger', 'No hay participantes inscritos en la actividad. Primero inscriba algunos');

        $pdf = PDF::loadView('docs.activity-identifiers',
          [
            'participants' => $activity->participants,
            'manual_date' => $activity->manual_date,
            'activity_name' => $activity->name
          ]
          )->setPaper('letter');

        return $pdf->download('Identificadores_'.$activity->getFileName().'.pdf');


      } catch(\Illuminate\Database\QueryException $th){

        if($th->getCode() == 7)
            return redirect()
              ->route('home')
              ->with('danger', 'No hay conexión con la base de datos.');
          else
            return dd($th);
            return redirect()
              ->back()
              ->with('warning', 'Error al generar el reporte.');
      }
      
      return 'Identificadores';
    }
    public function downloadVerifyDataSheet($activity_id){
        return 'Verificacion de datos';
    }

    public function downloadAttendanceSheet($activity_id){
      return 'Hoja de asistencia';
  }

  }

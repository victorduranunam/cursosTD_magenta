<?php

namespace App\Http\Controllers;
use App\Models\Activity;
use App\Models\ActivityCatalogue;
use App\Models\Instructor;
use App\Models\Participant;
use App\Models\Venue;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;
use ZipArchive;

class ActivityController extends Controller
{
    public function index(){
        try {
          $activities = Activity::all();
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
            $activity->start_date = $req->start_date;
            $activity->end_date = $req->end_date;
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
        $activity->start_date = $req->start_date;
        $activity->end_date = $req->end_date;
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
               
        $fileName = 'Constancias_'.$activity->getCertificateName().'.zip';

        $count = 0;
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        {
          foreach($activity->participants as $participant){
            $count += 1;
            $participant->key = $req->key.sprintf("%03s", $count);
            $participant->save();
            $participant->name = $participant->getFullNameCertificate();

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
              'fifth_degree_signature'  => isset($req->fifth_degree_signature)  ? $req->fifth_degree_signature  : NULL,
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
        else
          return redirect()
            ->back()
            ->with('warning', 'Error al generar la constancia.');
      }
    }
    
    public function downloadRecognitions($activity_id){
      
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
  }

<?php

namespace App\Http\Controllers;
use App\Models\Activity;
use App\Models\ActivityCatalogue;
use App\Models\Venue;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

}

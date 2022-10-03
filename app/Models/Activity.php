<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table = "activity";
    protected $fillable = [
        'activity_id', 
        'year', 
        'num', 
        'type', 
        'start_date', 
        'end_date',
        'manual_date', 
        'days_week', 
        'ctc', 
        'cost', 
        'max_quota', 
        'min_quota',
        'certificate_date',
        'recognition_date',
        'venue_id', 
        'activity_catalogue_id'
    ];
    protected $primaryKey = 'activity_id';
    public $timestamps = false;

    public function getName(){
      $activity = ActivityCatalogue::where('activity_catalogue_id',$this->activity_catalogue_id)
                                  ->first();
      return $activity->name;
    }

    public function getType(){
      $activity = ActivityCatalogue::where('activity_catalogue_id',$this->activity_catalogue_id)
                                  ->first();
      return $activity->type;
    }

    public function getFileName(){
      $activity = ActivityCatalogue::where('activity_catalogue_id',$this->activity_catalogue_id)
                                    ->first();
      return str_replace(' ', '_',$activity->name);
  }

    public function getInstructors(){
        $professors = Professor::join('instructor','instructor.professor_id','=','professor.professor_id')
                                ->where('instructor.activity_id',$this->activity_id)
                                ->get();
        
        if($professors->isEmpty())
          return 'No hay instructores asignados.';
        
        $professor_name="";

        if ( count($professors) == 1 ){
            $p=Professor::find($professors[0]->professor_id);
            $professor_name.=$p->name." ";
            $professor_name.=$p->last_name." ";
            $professor_name.=$p->mothers_last_name;
            return $professor_name;
        }
        foreach($professors as $p){
            $p=Professor::find($p->professor_id);
            $professor_name.=$p->name." ";
            $professor_name.=$p->last_name." ";
            $professor_name.=$p->mothers_last_name." / ";
        }
        $professor_name= substr($professor_name, 0, -2);
        return $professor_name;
    }

    public function getPeriod(){
        return $this->year."-".$this->num.$this->type;
    }

    public function getHours(){
      $activity = ActivityCatalogue::where('activity_catalogue_id',$this->activity_catalogue_id)
                                  ->first();
      return $activity->hours;
    }
}

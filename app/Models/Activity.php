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
        'start_time', 
        'end_time',
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

    public function getDepartmentName(){
      $activity = ActivityCatalogue::join('department as d', 'd.department_id', '=', 'activity_catalogue.department_id')
                                  ->where('activity_catalogue_id',$this->activity_catalogue_id)
                                  ->select('d.name as department_name')
                                  ->first();
      return $activity->department_name;
    }

    public function getKey(){
      $activity = ActivityCatalogue::where('activity_catalogue_id',$this->activity_catalogue_id)
                                  ->first();
      return $activity->key;
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

    public function getInstructorsName(){
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

    public function getVenueName(){
      $venue = Venue::where('venue_id', $this->venue_id)
                    ->first();
      
      return $venue->name;
    }

    public function getParticipantsSuggestions(){
      $participants = Participant::join('activity_evaluation as ae', 
                                        'ae.participant_id',
                                        '=',
                                        'participant.participant_id')
                                 ->join('professor as p',
                                        'p.professor_id',
                                        '=',
                                        'participant.professor_id')
                                 ->where('activity_id', $this->activity_id)
                                 ->whereNotNull('ae.question_6_2')
                                 ->select('p.name', 'p.last_name', 
                                          'p.mothers_last_name', 
                                          'ae.question_6_2')
                                 ->get();
      return $participants;
    }

    public function getInstructors(){
       return Professor::join('instructor','instructor.professor_id','=','professor.professor_id')
                             ->where('instructor.activity_id',$this->activity_id)
                             ->get()
                             ->sortBy(function($value){
                                return $value->last_name.$value->mothers_last_name.$value->name;
                              }, SORT_NATURAL);
    }

    public function getParticipants(){
      return Professor::join('participant','participant.professor_id','=','professor.professor_id')
                      ->where('participant.activity_id',$this->activity_id)
                      ->get()
                      ->sortBy(function($value){
                          return $value->last_name.$value->mothers_last_name.$value->name;
                        }, SORT_NATURAL);
    }

    public function getParticipantsNames(){
      return Professor::join('participant','participant.professor_id','=','professor.professor_id')
                      ->where('participant.activity_id',$this->activity_id)
                      ->select('professor.name')
                      ->get()
                      ->sortBy('name', SORT_NATURAL);
    }
}

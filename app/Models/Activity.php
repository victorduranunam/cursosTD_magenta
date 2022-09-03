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
        'sem_year', 
        'sem_num', 
        'sem_type', 
        'start_date', 
        'end_date',
        'manual_date', 
        'days_week', 
        'ctc', 
        'cost', 
        'max_quota', 
        'min_quota', 
        'venue_id', 
        'activity_catalogue_id'
    ];
    protected $primaryKey = 'activity_id';
    public $timestamps = false;
    protected $casts = [
        'day' => 'array'
    ];
    public function getName(){
        $activities = Activity::join('activity_catalogue','activity_catalogue.activity_catalogue_id','=','activity.activity_catalogue_id')
                                    ->where('activity_catalogue.activity_catalogue_id',$this->activity_catalogue_id)
                                    ->get(['activity_catalogue.name']);
        return $activities[0]->name;
    }

    public function getProfessors(){
        $professors = Professor::join('instructor','instructor.professor_id','=','professor.professor_id')
                                ->where('instructor.activity_id',$this->activity_id)
                                ->get();
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
            $professor_name.=$p->mothers_last_name."\n";
        }
        $professor_name= substr($professor_name, 0, -1);
        return $professor_name;
    }

    public function getSemester(){
        return $this->sem_year."-".$this->sem_num." ".$this->sem_type;
    }
}

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
        'day', 
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

    public function getProfessors(){
        $professors = Professor::join('instructor','instructor.professor_id','=','professor.professor_id')
                                ->where('instructor.activity_id',$this->activity_id)
                                ->where('professor.professor_id', '<>', NULL)
                                ->get();
        //return $professors;
        $cadena="";

        if ( count($professors) == 1 ){
            $p=Professor::find($professors[0]->professor_id);
            $cadena.=$p->name." ";
            $cadena.=$p->last_name." ";
            $cadena.=$p->mothers_last_name;
            return $cadena;
        }
        foreach($professors as $p){
            $p=Professor::find($p->professor_id);
            $cadena.=$p->name." ";
            $cadena.=$p->last_name." ";
            $cadena.=$p->mothers_last_name."\n";
        }
        $cadena= substr($cadena, 0, -1);
        return $cadena;
    }
}

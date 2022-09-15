<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $table = "participant";
    protected $fillable = [
        'participant_id',
        'additional',
        'attendance',
        'accredited',
        'confirmation',
        'canceled',
        'discount',
        'deposit',
        'mistimed',
        'nac',
        'grade',
        'comment',
        'key',
        'send_date',
        'professor_id',
        'activity_id'
    ];

    protected $primaryKey = 'participant_id';
    public $timestamps = false;

    public function getGradeSummary(){
      $summary = '';
      
      if((!$this->accredited and !$this->grade))
        
        $summary = 'El participante no ha sido evaluado. ';

      elseif($this->canceled)
        $summary = 'El participante canceló. ';

      else{

        if($this->grade != NULL)
          $summary = $summary.'Calificación: '.$this->grade.'. ';
        if($this->accredited == true)
          $summary = $summary. 'Acreditó. ';
        if($this->accredited == false and $this->nac)
          $summary = $summary.'No acreditó: '.$this->nac.' ';
        if($this->accredited == false and !$this->nac)
          $summary = $summary. 'No acreditó: No hay causa. ';

      }

      if($this->additional)
        $summary = $summary. 'Fue inscrito con cupo excedido. ';

      if($this->mistimed)
        $summary = $summary. 'Inscrito después de iniciada la actividad. ';

      return $summary;
    }

    public function getActivityName(){
      return ActivityCatalogue::join('activity', 'activity.activity_catalogue_id', '=', 'activity_catalogue.activity_catalogue_id')
                               ->join('participant', 'participant.activity_id', '=', 'activity.activity_id')
                               ->where('participant.participant_id', $this->participant_id)
                               ->get(['activity_catalogue.name'])
                               ->first()
                               ->name;
      
    }

    public function getFullName(){
      return Professor::join('participant', 'professor.professor_id', '=', 'participant.professor_id')
                               ->where('participant.participant_id', $this->participant_id)
                               ->selectRaw("concat(professor.name, ' ',professor.last_name, ' ',professor.mothers_last_name) as full_name")
                               ->first()
                               ->full_name;
      
    }
}
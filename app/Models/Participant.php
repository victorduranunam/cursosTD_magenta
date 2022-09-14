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
        'wl_was',
        'wl_number',
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
      
      if($this->grade === NULL and $this->accredited === NULL)
        
        $summary =+ 'El participante no ha sido evaluado.';

      else{

        if($this->grade != NULL)
          $summary =+ 'Calificación: '.$this->grade.'. ';
        if($this->accredited == true)
          $summary =+ 'Acreditó.';
        if($this->accredited == false and $this->nac)
          $summary =+ 'No acreditó: '.$this->nac;
        if($this->accredited == false and !$this->nac)
          $summary =+ 'No acreditó: No hay causa.';

      }

      return $summary;
    }

    public function getWL(){
      $wl = '';
      
      if($this->wl_was === NULL and $this->wl_number === NULL)
        
        $wl =+ 'No se ha especificado lista de espera.';

      else{

        if($this->wl_was and $this->wl_number)
          $wl =+ 'Posición en lista de espera: '.$this->wl_number;
        if(!$this->wl_was)
          $wl =+ 'Inscrito';
      }

      return $wl;

    }
}
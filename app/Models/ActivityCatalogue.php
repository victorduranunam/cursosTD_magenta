<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityCatalogue extends Model
{
    use HasFactory;

    protected $table = "activity_catalogue";
    protected $fillable = [
        'activity_catalogue_id', 
        'key', 
        'name', 
        'hours',
        'type', 
        'aimed_at', 
        'objective',
        'content', 
        'background', 
        'creation_date', 
        'module',
        'department_id', 
        'diploma_id'
    ];

    protected $primaryKey = 'activity_catalogue_id';
    public $timestamps = false;

    public function getDepartmentName(){
      return Department::findOrFail($this->department_id)->name;
    }

    public function getDepartmentAbbreviation(){
      return Department::findOrFail($this->department_id)->abbreviation;
    }

    public function getType(){
      if($this->type == 'CU')
        return 'Curso';
      elseif($this->type == 'CT')
        return 'Curso - Taller';
      elseif($this->type == 'TA')
        return 'Taller';
      elseif($this->type == 'SE')
        return 'Seminario';
      elseif($this->type == 'FO')
        return 'Foro';
      elseif($this->type == 'EV')
        return 'Evento';
      elseif($this->type == 'DI')
        return 'Módulo de Diplomado';
      elseif($this->type == 'CO')
        return 'Conferencia';
    }

    public function getFileName(){
      if($this->name)
        return str_replace(' ', '_',$this->name);
      else
        return '-';
    }
}

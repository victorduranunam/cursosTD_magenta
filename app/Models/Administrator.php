<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    protected $table = "administrator";
    protected $fillable = [
        'administrator_id',
        'name',
        'last_name',
        'mothers_last_name',
        'degree',
        'gender',
        'job'
    ];

    protected $primaryKey = 'administrator_id';
    public $timestamps = false;

    public function getJob(){
      if($this->job === 'C' and $this->gender === 'F')
        return 'Coordinadora';
      if($this->job === 'C')
        return 'Coordinador';
      if($this->job === 'O' and $this->gender === 'F')
        return 'Coordinadora del Centro de Docencia';
      if($this->job === 'O')
        return 'Coordinador del Centro de Docencia';
      if($this->job === 'S' and $this->gender === 'F')
        return 'Secretaria de Apoyo a la Docencia';
      if($this->job === 'S')
        return 'Secretario de Apoyo a la Docencia';
      if($this->job === 'D' and $this->gender === 'F')
        return 'Directora';
      if($this->job === 'D')
        return 'Director';
      return '';
    }

    public function getFullName(){
      return $this->name.' '.$this->last_name.' '.$this->mothers_last_name;
    }
}

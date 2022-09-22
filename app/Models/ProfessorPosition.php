<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessorPosition extends Model
{
    use HasFactory;

    protected $table = "professor_position";
    protected $fillable = [
        'professor_position_id',
        'professor_id',
        'work_position_id'
    ];

    protected $primaryKey = 'professor_position_id';
    public $timestamps = false;

    public function getName(){
      return WorkPosition::findOrFail($this->work_position_id)->name;
    }

    public function getAbbreviation(){
      return WorkPosition::findOrFail($this->work_position_id)->abbreviation;
    }
}

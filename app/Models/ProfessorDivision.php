<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessorDivision extends Model
{
    use HasFactory;

    protected $table = "professor_division";
    protected $fillable = [
        'professor_division_id',
        'division_id',
        'professor_id'
    ];
    
    protected $primaryKey = 'professor_division_id';
    public $timestamps = false;


    public function getName(){
      return Division::findOrFail($this->division_id)->name;
    }

    public function getAbbreviation(){
      return Division::findOrFail($this->division_id)->abbreviation;
    }
}

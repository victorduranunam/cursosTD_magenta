<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $table = "instructor";
    protected $fillable = [
        'instructor_id',
        'key',
        'professor_id',
        'activity_id'
    ];

    protected $primaryKey = 'instructor_id';
    public $timestamps = false;

    public function getName(){
      $professor = Professor::findOrFail($this->professor_id);
      return $professor->name.' '.$professor->last_name.' '.$professor->mothers_last_name;
    }

    public function getRecognitionName(){
      $professor = Professor::findOrFail($this->professor_id);
      return $professor->degree.' '.$professor->name.' '.$professor->last_name.' '.$professor->mothers_last_name;
    }

    public function getSemblance(){
      $professor = Professor::findOrFail($this->professor_id);
      return $professor->semblance;
    }

    public function getFullNameFile(){
      return Professor::join('instructor', 'professor.professor_id', '=', 'instructor.professor_id')
                               ->where('instructor.instructor_id', $this->instructor_id)
                               ->selectRaw("concat(replace(professor.name, ' ', '_'), '_',professor.last_name, '_',professor.mothers_last_name) as full_name")
                               ->first()
                               ->full_name;
      
    }
}

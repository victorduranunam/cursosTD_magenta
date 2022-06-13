<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessorFaculty extends Model
{
    use HasFactory;

    protected $table = "professor_faculty";
    protected $fillable = [
        'professor_faculty_id',
        'professor_id',
        'faculty_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessorCareer extends Model
{
    use HasFactory;

    protected $table = "professor_career";
    protected $fillable = [
        'professor_career_id',
        'career_id',
        'professor_id'
    ];

    protected $primaryKey = 'professor_career_id';
    public $timestamps = false;
}

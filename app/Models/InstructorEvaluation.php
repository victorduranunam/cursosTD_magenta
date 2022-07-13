<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorEvaluation extends Model
{
    use HasFactory;

    protected $table = "instructor_evaluation";
    protected $fillable = [
        'instructor_evaluation_id',
        'question_1',
        'question_2',
        'question_3',
        'question_4',
        'question_5',
        'question_6',
        'question_7',
        'question_8',
        'question_9',
        'question_10',
        'question_11',
        'instructor_id',
        'participant_id'
    ];

    protected $primaryKey = 'instructor_evaluation_id';
}

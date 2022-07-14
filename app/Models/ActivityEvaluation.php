<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityEvaluation extends Model
{
    use HasFactory;

    protected $table = "activity_evaluation";
    protected $fillable = [
        'activity_evaluation_id',
        'question_1_1',
        'question_1_2',
        'question_1_3',
        'question_1_4',
        'question_1_5',
        'question_2_1',
        'question_2_2',
        'question_2_3',
        'question_2_4',
        'question_3_1',
        'question_3_2',
        'question_3_3',
        'question_3_4',
        'question_4',
        'question_5',
        'question_6',
        'question_7',
        'question_8',
        'question_9',
        'question_10',
        'sem_schedule',
        'int_schedule',
        'participant_id'
    ];

    protected $primaryKey = 'activity_evaluation_id';
    public $timestamps = false;
}

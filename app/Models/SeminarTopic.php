<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeminarTopic extends Model
{
    use HasFactory;

    protected $table = "seminar_topic";
    protected $fillable = [
        'seminar_topic_id',
        'name',
        'hours',
        'ex_date',
        'instructor_id',
        'activity_id'
    ];

    protected $primaryKey = 'seminar_topic_id';
    public $timestamps = false;
}

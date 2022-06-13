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
        'send_date',
        'professor_id',
        'activity_id'
    ];
}

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
        'numeric',
        'professor_id',
        'work_position_id'
    ];

    protected $primaryKey = 'professor_position_id';
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = "student";

    protected $fillable = [
        'student_id',
        'name',
        'last_name',
        'mothers_last_name',
        'rfc',
        'worker_number',
        'student_number',
        'phone_number',
        'degree',
        'email',
        'gender'
    ];


    protected $primaryKey = 'student_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;


    /**
     * Retorna el nombre completo del estudiante.
     */
    public function getFullName()
    {
        return trim("{$this->name} {$this->last_name} {$this->mothers_last_name}");
    }



}






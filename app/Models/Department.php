<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = "department";
    protected $fillable = [
        'department_id',
        'abbreviation',
        'name',
        'administrator_id'
    ];
    protected $primaryKey = 'department_id';
}

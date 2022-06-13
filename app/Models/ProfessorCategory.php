<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessorCategory extends Model
{
    use HasFactory;

    protected $table = "professor_category";
    protected $fillable = [
        'professor_category_id',
        'numeric',
        'professor_id',
        'category_id'
    ];
}

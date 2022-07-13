<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    protected $table = "administrator";
    protected $fillable = [
        'administrator_id',
        'name',
        'last_name',
        'mothers_last_name',
        'degree',
        'gender',
        'job'
    ];

    protected $primaryKey = 'administrator_id';
}

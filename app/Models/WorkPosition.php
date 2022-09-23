<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkPosition extends Model
{
    use HasFactory;

    protected $table = "work_position";
    protected $fillable = [
        'work_position_id',
        'name',
        'abbreviation'
    ];

    protected $primaryKey = 'work_position_id';
    public $timestamps = false;
}

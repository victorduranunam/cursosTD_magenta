<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $table = "career";
    protected $fillable = [
        'career_id',
        'name',
        'key'
    ];

    protected $primaryKey = 'career_id';
    public $timestamps = false;
}

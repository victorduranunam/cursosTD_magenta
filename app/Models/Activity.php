<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table = "activity";
    protected $fillable = [
        'activity_id', 
        'sem_year', 
        'sem_num', 
        'sem_type', 
        'start_date', 
        'end_date',
        'manual_date', 
        'day', 
        'ctc', 
        'cost', 
        'max_quota', 
        'min_quota', 
        'venue_id', 
        'activity_catalogue_id'
    ];
    protected $primaryKey = 'activity_id';
    public $timestamps = false;
}

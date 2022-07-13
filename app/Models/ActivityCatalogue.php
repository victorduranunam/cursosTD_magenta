<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityCatalogue extends Model
{
    use HasFactory;

    protected $table = "activity_catalogue";
    protected $fillable = [
        'activity_catalogue_id', 
        'key', 
        'name', 
        'hours',
        'type', 
        'institution', 
        'aimed_at', 
        'objective',
        'content', 
        'background', 
        'creation_date', 
        'module',
        'department_id', 
        'diploma_id'
    ];

    protected $primaryKey = 'activity_catalogue_id';
}

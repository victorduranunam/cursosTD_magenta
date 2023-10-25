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
        'name'
    ];
    protected $primaryKey = 'department_id';
    public $timestamps = false;

    public function getFileName(){
      $department = Department::findOrFail($this->department_id);
      return str_replace(' ', '_',$department->name);
    }

    public function activitiesCatalogue() {

      return $this->hasMany(ActivityCatalogue::class, 'department_id');
    }
}

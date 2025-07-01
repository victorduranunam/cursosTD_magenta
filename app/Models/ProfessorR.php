<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $table = "professor";
    protected $fillable = [
        'professor_id',
        'name',
        'last_name',
        'mothers_last_name',
        'rfc',
        'worker_number',
        'birthdate',
        'phone_number',
        'degree',
        'email',
        'gender',
        'semblance',
        'is_instructor',
        'provenance'
    ];

    protected $primaryKey = 'professor_id';
    public $timestamps = false;

    public function getFullName(){
        return $this->name.' '.$this->last_name.' '.$this->mothers_last_name;
      }

    public function participants () {
      return $this->hasMany(Participant::class, 'professor_id');
    }
}

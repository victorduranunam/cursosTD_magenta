<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diploma extends Model
{
    use HasFactory;

    protected $table = "diploma";
    protected $fillable = [
        'diploma_id',
        'name'
    ];

    protected $primaryKey = 'diploma_id';
    public $timestamps = false;

    public function getFileName(){
      $diploma = Diploma::findOrFail($this->diploma_id);
      return str_replace(' ', '_',$diploma->name);
  }
}

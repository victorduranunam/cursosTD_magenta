<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Administrator extends Authenticatable
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
        'username',
        'password',
        'admin',
        'department_id'
    ];

    protected $primaryKey = 'administrator_id';
    public $timestamps = false;

    public function getFullName(){
      return $this->name.' '.$this->last_name.' '.$this->mothers_last_name;
    }

    public function getSigningName(){
      return $this->degree.' '.$this->name.' '.$this->last_name.' '.$this->mothers_last_name;
    }

    public function getDepartment() {
      if($this->department_id)
        return Department::findOrFail('department_id',$this->department_id);
      else
        return NULL;
    }
}

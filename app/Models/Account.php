<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use HasFactory;

    protected $table = "account";
    protected $fillable = [
        'account_id', 
        'name', 
        'username', 
        'password', 
        'admin', 
        'department_id'
    ];
    
    protected $primaryKey = 'account_id';
    public $timestamps = false;

    public function getDepartments() {
      if($this->admin)
        $departments = Department::select('department_id','name')->get();
      else
        $departments = Department::select('department_id','name')
                     ->where('department_id', $this->department_id)
                     ->get();
      return $departments;
    }
}

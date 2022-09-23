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
}

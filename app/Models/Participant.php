<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $table = "participant";
    protected $fillable = [
        'participant_id',
        'additional',
        'attendance',
        'accredited',
        'confirmation',
        'canceled',
        'free',
        'discount',
        'deposit',
        'wl_was',
        'wl_number',
        'nac',
        'grade',
        'comment',
        'key',
        'send_date',
        'professor_id',
        'activity_id'
    ];
}

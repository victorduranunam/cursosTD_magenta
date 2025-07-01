<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $table = "participant";

    protected $primaryKey = 'participant_id';
    public $timestamps = false;

    protected $fillable = [
        'participant_id',
        'additional',
        'attendance',
        'accredited',
        'confirmation',
        'canceled',
        'discount',
        'deposit',
        'mistimed',
        'nac',
        'grade',
        'comment',
        'key',
        'student_id',
        'activity_id'
    ];

    // Relaciones
    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function activity() {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    // Método para resumen de calificación
    public function getGradeSummary() {
        $summary = '';

        if ($this->canceled) {
            $summary = 'El participante canceló. ';
        } elseif (!$this->accredited && !$this->grade) {
            $summary = 'El participante no ha sido evaluado. ';
        } else {
            if (!is_null($this->grade)) {
                $summary .= 'Calificación: ' . $this->grade . '. ';
            }

            if ($this->accredited) {
                $summary .= 'Acreditó. ';
            } elseif (!$this->accredited && $this->nac) {
                $summary .= 'No acreditó: ' . $this->nac . '. ';
            } elseif (!$this->accredited) {
                $summary .= 'No acreditó: No hay causa. ';
            }
        }

        if ($this->additional) {
            $summary .= 'Fue inscrito con cupo excedido. ';
        }

        if ($this->mistimed) {
            $summary .= 'Inscrito después de iniciada la actividad. ';
        }

        return $summary;
    }



    public function getActivityName(){
            $registro = ActivityCatalogue::join('activity', 'activity.activity_catalogue_id', '=', 'activity_catalogue.activity_catalogue_id')
                                        ->join('participant', 'participant.activity_id', '=', 'activity.activity_id')
                                        ->where('participant.participant_id', $this->participant_id)
                                        ->select('activity_catalogue.name')
                                        ->first();

            return $registro ? $registro->name : 'Sin actividad';
    }




    public function getFullName(){
            $registro = Student::join('participant', 'student.student_id', '=', 'participant.student_id')
                                ->where('participant.participant_id', $this->participant_id)
                                ->selectRaw("concat(student.name, ' ',student.last_name, ' ',student.mothers_last_name) as full_name")
                                ->first();

            return $registro ? $registro->full_name : 'Sin nombre';
     }




    public function getFullNameFile(){
        $registro = Student::join('participant', 'student.student_id', '=', 'participant.student_id')
                            ->where('participant.participant_id', $this->participant_id)
                            ->selectRaw("concat(replace(student.name, ' ', '_'), '_',student.last_name, '_',student.mothers_last_name) as full_name")
                            ->first();

        return $registro ? $registro->full_name : 'sin_nombre';
    }


}

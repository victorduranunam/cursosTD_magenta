<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ParticipantExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Participant::all();
    }

    public function title(): string
    {
        return 'Participantes';
    }

    public function headings(): array
    {
      return [
        'ID',
        'Adicional',
        'Asistió',
        'Acreditó',
        'Confirmó',
        'Canceló',
        'Descuento',
        'Depósito',
        'Extemporáneo',
        'Causa de no acreditación',
        'Calificación',
        'Comentario',
        'Folio',
        'Profesor ID',
        'Actividad ID'
    ];
    }
}
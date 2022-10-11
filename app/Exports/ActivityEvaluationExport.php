<?php

namespace App\Exports;

use App\Models\ActivityEvaluation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ActivityEvaluationExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return ActivityEvaluation::all();
    }

    public function title(): string
    {
        return 'Evaluaciones de actividades';
    }

    public function headings(): array
    {
      return [
        'ID',
        'Pregunta 1 1',
        'Pregunta 1 2',
        'Pregunta 1 3',
        'Pregunta 1 4',
        'Pregunta 1 5',
        'Pregunta 2 1',
        'Pregunta 2 2',
        'Pregunta 2 3',
        'Pregunta 2 4',
        'Pregunta 3 1',
        'Pregunta 3 2',
        'Pregunta 3 3',
        'Pregunta 3 4',
        'Pregunta 4',
        'Pregunta 5',
        'Pregunta 6 1',
        'Pregunta 6 2',
        'Pregunta 6 3',
        'Pregunta 7 1',
        'Pregunta 7 2',
        'Pregunta 8 1',
        'Pregunta 8 2',
        'Participante ID'
    ];
    }
}
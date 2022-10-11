<?php

namespace App\Exports;

use App\Models\InstructorEvaluation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class InstructorEvaluationExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return InstructorEvaluation::all();
    }

    public function title(): string
    {
        return 'Evaluaciones de Instructores';
    }

    public function headings(): array
    {
      return [
        'ID',
        'Pregunta 1',
        'Pregunta 2',
        'Pregunta 3',
        'Pregunta 4',
        'Pregunta 5',
        'Pregunta 6',
        'Pregunta 7',
        'Pregunta 8',
        'Pregunta 9',
        'Pregunta 10',
        'Pregunta 11',
        'Instructor ID',
        'Participante ID'
    ];
    }
}
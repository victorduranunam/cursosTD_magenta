<?php

namespace App\Exports;

use App\Models\ProfessorPosition;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ProfessorPositionExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return ProfessorPosition::all();
    }

    public function title(): string
    {
        return 'Puestos de trabajo de los Profesores';
    }

    public function headings(): array
    {
      return [
        'ID',
        'Profesor ID',
        'Puesto de trabajo ID'
    ];
    }
}
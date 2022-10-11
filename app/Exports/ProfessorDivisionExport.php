<?php

namespace App\Exports;

use App\Models\ProfessorDivision;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ProfessorDivisionExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return ProfessorDivision::all();
    }

    public function title(): string
    {
        return 'Divisiones de los Profesores';
    }

    public function headings(): array
    {
      return [
        'ID',
        'Division ID',
        'Profesor ID'
    ];
    }
}
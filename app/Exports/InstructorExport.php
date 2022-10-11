<?php

namespace App\Exports;

use App\Models\Instructor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class InstructorExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Instructor::all();
    }

    public function title(): string
    {
        return 'Instructores';
    }

    public function headings(): array
    {
      return [
        'ID',
        'Folio',
        'Profesor ID',
        'Actividad ID'
    ];
    }
}
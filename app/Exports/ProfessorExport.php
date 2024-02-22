<?php

namespace App\Exports;

use App\Models\Professor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ProfessorExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Professor::all();
    }

    public function title(): string
    {
        return 'Profesores';
    }

    public function headings(): array
    {
      return [
        'ID',
        'Nombre',
        'Apellido Paterno',
        'Apellido Materno',
        'RFC',
        'Numero de Trabajador',
        'Fecha de Nacimiento',
        'Teléfono',
        'Grado',
        'Email',
        'Género',
        'Semblanza',
        'Es instructor',
        'Proveniencia'
    ];
    }
}
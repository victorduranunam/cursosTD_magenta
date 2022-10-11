<?php

namespace App\Exports;

use App\Models\Administrator;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AdministratorExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Administrator::all();
    }

    public function title(): string
    {
        return 'Administradores';
    }

    public function headings(): array
    {
      return [
        'ID',
        'Nombre',
        'Apellido Paterno',
        'Apellido Materno',
        'Grado',
        'Género',
        'Tipo de Cargo de Trabajo'
    ];
    }
}
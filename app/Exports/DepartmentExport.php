<?php

namespace App\Exports;

use App\Models\Department;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class DepartmentExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Department::all();
    }

    public function title(): string
    {
        return 'Coordinaciones';
    }

    public function headings(): array
    {
      return [
        'ID',
        'Abreviatura',
        'Nombre',
        'Administrador ID'
    ];
    }
}
<?php

namespace App\Exports;

use App\Models\WorkPosition;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class WorkPositionExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return WorkPosition::all();
    }

    public function title(): string
    {
        return 'Puestos de Trabajo';
    }

    public function headings(): array
    {
      return [
        'ID',
        'Nombre',
        'Abreviación'
    ];
    }
}
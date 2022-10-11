<?php

namespace App\Exports;

use App\Models\Division;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class DivisionExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Division::all();
    }

    public function title(): string
    {
        return 'Divisiones';
    }

    public function headings(): array
    {
      return [
        'ID',
        'Nombre',
        'Abreviatura'
    ];
    }
}
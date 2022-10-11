<?php

namespace App\Exports;

use App\Models\Diploma;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class DiplomaExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Diploma::all();
    }

    public function title(): string
    {
        return 'Diplomados';
    }

    public function headings(): array
    {
      return [
        'ID',
        'Nombre'
    ];
    }
}
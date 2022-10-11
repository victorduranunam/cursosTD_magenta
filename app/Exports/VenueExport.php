<?php

namespace App\Exports;

use App\Models\Venue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class VenueExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Venue::all();
    }

    public function title(): string
    {
        return 'Sedes de actividades';
    }

    public function headings(): array
    {
      return [
        'ID',
        'Nombre',
        'Capacidad',
        'Ubicación'
    ];
    }
}
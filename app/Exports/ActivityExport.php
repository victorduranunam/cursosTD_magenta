<?php

namespace App\Exports;

use App\Models\Activity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ActivityExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Activity::all();
    }

    public function title(): string
    {
        return 'Actividades';
    }

    public function headings(): array
    {
      return [
        'ID',
        'Año',
        'Número de periodo',
        'Tipo de periodo',
        'Fecha de inicio',
        'Fecha de fin',
        'Fecha manual',
        'Días de la semana',
        'Créditos para acreditar',
        'Costo',
        'Cupo máximo',
        'Cupo mínimo',
        'Fecha de constancias',
        'Fecha de reconocimientos',
        'Sede ID',
        'Catálogo de Actividad ID'
    ];
    }
}
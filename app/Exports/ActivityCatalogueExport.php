<?php

namespace App\Exports;

use App\Models\ActivityCatalogue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ActivityCatalogueExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return ActivityCatalogue::all();
    }

    public function title(): string
    {
        return 'Cátalogo de Actividades';
    }

    public function headings(): array
    {
      return [
        'ID',
        'Clave',
        'Nombre',
        'Cantidad de horas',
        'Tipo',
        'Institucion',
        'Dirigido a',
        'Objetivo',
        'Contenido',
        'Antecedentes',
        'Fecha de creación',
        'Módulo',
        'Coordinación ID',
        'Diplomado ID'
    ];
    }
}
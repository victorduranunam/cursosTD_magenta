<?php

namespace App\Exports;

use App\Models\SeminarTopic;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class SeminarTopicExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return SeminarTopic::all();
    }

    public function title(): string
    {
        return 'Tópicos de seminario';
    }

    public function headings(): array
    {
      return [
        'ID',
        'Nombre',
        'Horas',
        'Fecha de impartición',
        'Instructor ID',
        'Actividad ID'
    ];
    }
}
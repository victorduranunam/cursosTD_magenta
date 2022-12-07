<?php

namespace App\Exports;

use App\Models\Account;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class AccountExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Account::all();
    }

    public function title(): string
    {
        return 'Cuentas de Usuario';
    }

    public function headings(): array
    {
      return [
        'ID',
        'Nombre',
        'Nombre de Usuario',
        'Contraseña (cifrada)',
        'Es administrador',
        'Departamento ID'
    ];
    }
}
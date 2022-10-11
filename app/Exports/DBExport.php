<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\ProfessorExport;

class DBExport implements WithMultipleSheets
{
    use Exportable;

    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new AccountExport();
        $sheets[] = new ActivityCatalogueExport();
        $sheets[] = new ActivityEvaluationExport();
        $sheets[] = new ActivityExport();
        $sheets[] = new AdministratorExport();
        $sheets[] = new DepartmentExport();
        $sheets[] = new DiplomaExport();
        $sheets[] = new DivisionExport();
        $sheets[] = new InstructorEvaluationExport();
        $sheets[] = new InstructorExport();
        $sheets[] = new ParticipantExport();
        $sheets[] = new ProfessorDivisionExport();
        $sheets[] = new ProfessorExport();
        $sheets[] = new ProfessorPositionExport();
        $sheets[] = new SeminarTopicExport();
        $sheets[] = new VenueExport();
        $sheets[] = new WorkPositionExport();

        return $sheets;
    }
}
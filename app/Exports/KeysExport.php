<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

use App\Models\Activity;
use App\Models\ActivityCatalogue;

class KeysExport implements FromView, ShouldAutoSize
{
    
    public function view(): View
    {
        $activities = Activity::all();
        foreach ($activities as $activity) {
          $activity->catalogue = ActivityCatalogue::findOrFail($activity->activity_catalogue_id);
          $activity->instructors = $activity->getInstructors();
          $activity->participants = $activity->getParticipants();
        }
    
        $activities = $activities->sortBy(function ($value, $key) {
          if ($value['type'] === 's')
            $x = 1;
          if ($value['type'] === 'i')
            $x = 2;
          if (is_null($value['key']) or $value['key'] === '' or $value['key'] === ' ')
            return '2'.$value['year'] . $value['num'] . $x . $value['catalogue']->name . $value['catalogue']->type;
          else
            return '1'.$value['year'] . $value['num'] .  $x . $value['catalogue']->name . $value['catalogue']->type . $value['key'];
        }, SORT_NATURAL);
        return view('docs.keys-export', ['activities' => $activities]);
    }
}

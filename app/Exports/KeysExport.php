<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

use App\Models\Activity;
use App\Models\Professor;
use App\Models\ActivityCatalogue;

class KeysExport implements FromView, ShouldAutoSize
{
    
    public function view(): View
    {
        $activities = Activity::all();
        foreach ($activities as $activity) {
          $activity->catalogue = ActivityCatalogue::findOrFail($activity->activity_catalogue_id);
          $activity->instructors = Professor::join('instructor','instructor.professor_id','=','professor.professor_id')
                                    ->where('instructor.activity_id',$activity->activity_id)
                                    ->get(['name','last_name','mothers_last_name','key'])
                                    ->sortBy(function($value){
                                      return $value->last_name.$value->mothers_last_name.$value->name;
                                    }, SORT_NATURAL);
          $activity->participants = Professor::join('participant','participant.professor_id','=','professor.professor_id')
                                      ->where('participant.activity_id',$activity->activity_id)
                                      ->get(['name','last_name','mothers_last_name','key'])
                                      ->sortBy(function($value){
                                          return $value->last_name.$value->mothers_last_name.$value->name;
                                        }, SORT_NATURAL);
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




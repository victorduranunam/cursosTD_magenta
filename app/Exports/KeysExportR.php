<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

use App\Models\Activity;
use App\Models\Professor;
use App\Models\ActivityCatalogue;
use DB;

class KeysExport implements FromView, ShouldAutoSize
{
    
    public function view(): View
    {
        $instructors = DB::table('instructor AS i')
                         ->join('professor AS p', 'p.professor_id', 'i.professor_id')
                         ->join('activity AS a', 'a.activity_id', 'i.activity_id')
                         ->join('activity_catalogue AS ac', 
                                'ac.activity_catalogue_id', 
                                'a.activity_catalogue_id')
                         ->select('ac.key AS key_catalogue', 'a.year', 'a.num',
                                  'a.type', 'p.name', 'p.last_name', 
                                  'p.mothers_last_name', 'i.key')
                         ->get();

        $participants = DB::table('participant AS p')
                          ->join('professor AS pr', 'pr.professor_id', 'p.professor_id')
                          ->join('activity AS a', 'a.activity_id', 'p.activity_id')
                          ->join('activity_catalogue AS ac', 
                                'ac.activity_catalogue_id', 
                                'a.activity_catalogue_id')
                          ->select('ac.key AS key_catalogue', 'a.year', 'a.num',
                                  'a.type', 'pr.name', 'pr.last_name', 
                                  'pr.mothers_last_name', 'p.key')
                          ->get();

        $data = $instructors->merge($participants);
    
        $data = $data->sortBy(function ($value, $key) {
          if ($value->type === 's')
            $x = 1;
          if ($value->type === 'i')
            $x = 2;
          if (is_null($value->key) or $value->key === '' or $value->key === ' ')
            return '2'.$value->year . $value->num . $x . $value->key_catalogue . $value->name . $value->last_name . $value->mothers_last_name;
          else
            return '1'.$value->year . $value->num . $x . $value->key_catalogue . $value->name . $value->last_name . $value->mothers_last_name;
        }, SORT_NATURAL);
        return view('docs.keys-export', ['rows' => $data]);
    }
}




<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ActivityCatalogue;
use App\Models\Activity;
use App\Models\Participant;
use App\Models\Instructor;

class VerifyUserDepartment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
      
      $user = Auth::user();
      if ($request->has('department_id')) {
        $department_id = $request->input('department_id');
      }elseif ($request->has('activity_catalogue_id')) {
        $department_id = ActivityCatalogue::findOrFail($request->has('activity_catalogue_id'))->department_id;
      }elseif ($request->has('activity_id')) {
        $department_id = Activity::findOrFail($request->has('activity_id'))->activity_catalogue->department_id;
      } elseif ($request->route()->hasParameter('activity_catalogue_id')) {
        $department_id = ActivityCatalogue::findOrFail($request->route('activity_catalogue_id'))->department_id;
      } elseif ($request->route()->hasParameter('activity_id')) {
        $department_id = Activity::findOrFail($request->route('activity_id'))->activity_catalogue->department_id;
      } elseif ($request->route()->hasParameter('participant_id')) {
        $department_id = Participant::findOrFail($request->route('participant_id'))
          ->activity->activity_catalogue->department_id;
      } elseif ($request->route()->hasParameter('instructor_id')) {
        $department_id = Instructor::findOrFail($request->route('instructor_id'))
          ->activity->activity_catalogue->department_id;
      } else {
          return redirect()->route('home')->with('danger', 'Error al verificar departamento del usuario');
      }

    if ($user->department_id !== $department_id) {
        return redirect()->route('home')->with('danger', 'No es posible almacenar u obtener información no asociada al departamento del usuario');
    }

    return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\ActivityCatalogue;
use App\Models\Activity;
use App\Models\Participant;
use App\Models\Instructor;

class VerifyUserDepartment
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        $department_id = null;

        // Revisión por inputs directos
        if ($request->filled('department_id')) {
            $department_id = $request->input('department_id');

        } elseif ($request->filled('activity_catalogue_id')) {
            $activityCatalogue = ActivityCatalogue::find($request->input('activity_catalogue_id'));
            if ($activityCatalogue) {
                $department_id = $activityCatalogue->department_id;
            }

        } elseif ($request->filled('activity_id')) {
            $activity = Activity::with('activity_catalogue')->find($request->input('activity_id'));
            if ($activity && $activity->activity_catalogue) {
                $department_id = $activity->activity_catalogue->department_id;
            }

        // Revisión por parámetros de ruta
        } elseif ($request->route()?->hasParameter('activity_catalogue_id')) {
            $activityCatalogue = ActivityCatalogue::find($request->route('activity_catalogue_id'));
            if ($activityCatalogue) {
                $department_id = $activityCatalogue->department_id;
            }

        } elseif ($request->route()?->hasParameter('activity_id')) {
            $activity = Activity::with('activity_catalogue')->find($request->route('activity_id'));
            if ($activity && $activity->activity_catalogue) {
                $department_id = $activity->activity_catalogue->department_id;
            }

        } elseif ($request->route()?->hasParameter('participant_id')) {
            $participant = Participant::with('activity.activity_catalogue')->find($request->route('participant_id'));
            if ($participant && $participant->activity && $participant->activity->activity_catalogue) {
                $department_id = $participant->activity->activity_catalogue->department_id;
            }

        } elseif ($request->route()?->hasParameter('instructor_id')) {
            $instructor = Instructor::with('activity.activity_catalogue')->find($request->route('instructor_id'));
            if ($instructor && $instructor->activity && $instructor->activity->activity_catalogue) {
                $department_id = $instructor->activity->activity_catalogue->department_id;
            }
        }

        // Si no se pudo obtener el departamento
        if (is_null($department_id)) {
            Log::warning('No se pudo verificar el departamento en la solicitud.', [
                'request_data' => $request->all(),
                'route_parameters' => $request->route()?->parameters() ?? [],
                'user_id' => $user->id,
            ]);
            return redirect()->route('home')->with('danger', 'Error al verificar el departamento del usuario');
        }

        // Comparar con el departamento del usuario
        if ($user->department_id !== $department_id) {
            Log::warning('Usuario no autorizado a acceder a departamento.', [
                'user_department_id' => $user->department_id,
                'target_department_id' => $department_id,
                'user_id' => $user->id,
            ]);
            //return redirect()->route('home')->with('danger', 'No puedes acceder a información de otro departamento.');
            return $next($request);
        }

        return $next($request);
    }
}

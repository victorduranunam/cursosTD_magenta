@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Actualizar Actividad <i class="bi bi-journals"></i></h3>
    <h4> {!! $activity->getName() !!} </h4>
  </div>
  @include('partials.messages')
  <div class="card-body"><br>
    <form method="POST" action="{!! route('update.activity', $activity->activity_id) !!}">
      @csrf
      @method('put')
      <div class="row">
        <div class="col-xl-2">
          <label class="form-label" for="year">*Periodo:</label>
          <input required class="form-control" type="text" name="year" id="year" value="{!! $activity->year !!}">
        </div>
        <div class="col-xl-2 mt-auto">
              @if ($activity->num == '1')
              <select name="num" id="num" class="form-select">
                  <option value="1" selected>1 </option>
                  <option value="2">2 </option>
              </select>
              @else
              <select name="num" id="num" class="form-select">
                  <option value="1">1 </option>
                  <option value="2" selected>2 </option>
              </select>
              @endif
        </div>
        <div class="col-xl-2 mt-auto">
              @if ($activity->type == 's')
              <select name="type" id="type" class="form-select">
                  <option value="s" selected>Semestral</option>
                  <option value="i">Intersemestral</option>
              </select>
              @else
              <select name="type" id="type" class="form-select">
                  <option value="s">Semestral</option>
                  <option value="i" selected>Intersemestral</option>
              </select>
              @endif
        </div>
        <div class="col-xl-3">
          <label for="start_time" class="form-label">*Hora de inicio:</label>
          <input type="time" required class="form-control" name="start_time" id="start_time" value="{!! $activity->start_time !!}">
        </div>
        <div class="col-xl-3">
          <label for="end_time" class="form-label">*Hora de fin:</label>
          <input type="time" required class="form-control" name="end_time" id="end_time" value="{!! $activity->end_time !!}">
        </div>
      </div>

            <div class="row"> 
        
          <div class="col-xl-4">
              <label for="clave_grupo" class="form-label">*Clave del grupo:</label>
              <input type="text" required  class="form-control" name="clave_grupo" id="clave_grupo" placeholder="clave del grupo"  value="{!! $activity->clave_grupo !!}"   >
          </div>
        <div class="col-xl-4">
              <label for="fecha_inicial" class="form-label">*Fecha de inicio:</label>
              <input type="date" class="form-control" required name="fecha_inicial" 
                id="fecha_inicial" placeholder="22/07/22" 
                value="{!! $activity->fecha_inicial !!}"
              >
        </div>

        <div class="col-xl-4">
              <label for="fecha_final" class="form-label">*Fecha de termino:</label>
              <input type="date" class="form-control" required name="fecha_final" 
                id="fecha_final" placeholder="22/07/22" 
                value="{!! $activity->fecha_final !!}"
              >
        </div>
      </div>

      <div class="row">
        <div class="col-xl-12">
          <label for="days_week" class="form-label">*Días de la semana:</label><br>
          <div class="form-check form-check-inline">
            <label for="days_week" class="form-check-label">Lunes</label>
            @if (str_contains($activity->days_week,'L') == true)
            <input name="days_week[]" checked class="form-check-input" type="checkbox" id="days_week" value="L">
            @else
            <input name="days_week[]" class="form-check-input" type="checkbox" id="days_week" value="L">
            @endif
          </div>
          <div class="form-check form-check-inline">
            <label for="days_week" class="form-check-label">Martes</label>
            @if (str_contains($activity->days_week,'M') == true)
            <input name="days_week[]" checked class="form-check-input" type="checkbox" id="days_week" value="M">
            @else
            <input name="days_week[]" class="form-check-input" type="checkbox" id="days_week" value="M">
            @endif
          </div>
          <div class="form-check form-check-inline">
            <label for="days_week" class="form-check-label">Miércoles</label>
            @if (str_contains($activity->days_week,'I') == true)
            <input name="days_week[]" checked class="form-check-input" type="checkbox" id="days_week" value="I">
            @else
            <input name="days_week[]" class="form-check-input" type="checkbox" id="days_week" value="I">
            @endif
          </div>
          <div class="form-check form-check-inline">
            <label for="days_week" class="form-check-label">Jueves</label>
            @if (str_contains($activity->days_week,'J') == true)
            <input name="days_week[]" checked class="form-check-input" type="checkbox" id="days_week" value="J">
            @else
            <input name="days_week[]" class="form-check-input" type="checkbox" id="days_week" value="J">
            @endif
          </div>
          <div class="form-check form-check-inline">
            <label for="days_week" class="form-check-label">Viernes</label>
            @if (str_contains($activity->days_week,'V') == true)
            <input name="days_week[]" checked class="form-check-input" type="checkbox" id="days_week" value="V">
            @else
            <input name="days_week[]" class="form-check-input" type="checkbox" id="days_week" value="V">
            @endif
          </div>
          <div class="form-check form-check-inline">
            <label for="days_week" class="form-check-label">Sábado</label>
            @if (str_contains($activity->days_week,'S') == true)
            <input name="days_week[]" checked class="form-check-input" type="checkbox" id="days_week" value="S">
            @else
            <input name="days_week[]" class="form-check-input" type="checkbox" id="days_week" value="S">
            @endif
          </div>
          <div class="form-check form-check-inline">
            <label for="days_week" class="form-check-label">Domingo</label>
            @if (str_contains($activity->days_week,'D') == true)
            <input name="days_week[]" checked class="form-check-input" type="checkbox" id="days_week" value="D">
            @else
            <input name="days_week[]" class="form-check-input" type="checkbox" id="days_week" value="D">
            @endif
          </div>
        </div>
      </div>

    <div class="row">
      <div class="col-xl-6">
        <label for="manual_date" class="form-label">*Fecha manual:</label>
        <input type="text" required class="form-control" name="manual_date" id="manual_date" placeholder="Ej. Los días 5, 7 y 9 de Agosto" value="{!! $activity->manual_date !!}">
      </div>
      <div class="col-xl-6">
        <label for="venue_id" class="form-label">Sede:</label>
        <select name="venue_id" id="venue_id" class="form-select">
            @foreach($venues as $venue)
              <option 
              {!! $activity->venue_id ==  $venue->venue_id ? "selected" : ""!!} 
                value="{!! $venue->venue_id !!}">
                {!! $venue->name !!}
              </option>
              @endforeach
        </select>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-3">
        <label for="min_quota" class="form-label">*Cupo mínimo:</label>
        <input required type="number" min="1" class="form-control" name="min_quota" id="min_quota" placeholder="Ej. 5" value="{!! $activity->min_quota !!}">
      </div>
      <div class="col-xl-3">
        <label for="max_quota" class="form-label">*Cupo máximo:</label>
        <input required type="number" min="1" class="form-control" name="max_quota" id="max_quota" placeholder="Ej. 30" value="{!! $activity->max_quota !!}">
      </div>
      <div class="col-xl-3">
        <label for="ctc" class="form-label">Acreditación:</label>
        <input type="number" min="0" max="100" class="form-control" name="ctc" id="ctc" placeholder="Ej. 80" value="{!! $activity->ctc !!}">
      </div>
      <div class="col-xl-3">
        <label for="cost" class="form-label">*Costo:</label>
        <input type="text" required class="form-control" name="cost" id="cost" placeholder="Ej. 799.99" value="{!! $activity->cost !!}">
      </div>
    </div>

    <!--
    <div class="row">
      <div class="col-xl-3">
        <label for="group_key">Clave de grupo:</label>
        <input type="text" name="group_key" id="group_key" class="form-control" disabled value="{!! $activity->group_key !!}">
      </div>
    </div>
  -->
    <div class="row">
        <div class="d-grid gap-2 col-xl-2">
            <button type="submit" id='save-btn' class="btn btn-outline-success"> Guardar </button>
        </div>
    </div>
    </form>

    <form method="POST" action="{!! route("delete.activity", $activity->activity_id) !!}">
      @csrf
      @method('delete')
      <div class="row">
        <div class="col-2">
          <a href="{!! route("view.activities") !!}" class="btn btn-outline-warning">Regresar</a>
        </div>
        <div class="col-2">
          <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $activity->activity_id !!}">Eliminar</button>
        </div>
      </div>
      <div class="modal fade" id="myModal{!! $activity->activity_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Eliminar carrera</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>¿Está seguro de eliminar la actividad {!! $activity->getName() !!}?
                Esto borrará los registros que existan entre instructores y participantes
                con ella.
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cancelar</button>
              <input type="submit" value="Eliminar" class="btn btn-outline-danger">
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

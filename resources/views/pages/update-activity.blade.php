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
          <label class="form-label" for="sem_year">*Periodo:</label>
          <input required class="form-control" type="text" name="sem_year" id="sem_year" value="{!! $activity->sem_year !!}">
        </div>
        <div class="col-xl-2 mt-auto">
              @if ($activity->sem_num == '1')
              <select name="sem_num" id="sem_num" class="form-select">
                  <option value="1" selected>1 </option>
                  <option value="2">2 </option>
              </select>
              @else
              <select name="sem_num" id="sem_num" class="form-select">
                  <option value="1">1 </option>
                  <option value="2" selected>2 </option>
              </select>
              @endif
        </div>
        <div class="col-xl-2 mt-auto">
              @if ($activity->sem_type == 's')
              <select name="sem_type" id="sem_type" class="form-select">
                  <option value="s" selected>Semestral</option>
                  <option value="i">Intersemestral</option>
              </select>
              @else
              <select name="sem_type" id="sem_type" class="form-select">
                  <option value="s">Semestral</option>
                  <option value="i" selected>Intersemestral</option>
              </select>
              @endif
        </div>
        <div class="col-xl-3">
          <label for="start_date" class="form-label">*Fecha de inicio:</label>
          <input type="date" required class="form-control" name="start_date" id="start_date" value="{!! $activity->start_date !!}">
        </div>
        <div class="col-xl-3">
          <label for="end_date" class="form-label">*Fecha de fin:</label>
          <input type="date" required class="form-control" name="end_date" id="end_date" value="{!! $activity->end_date !!}">
        </div>
      </div>

      <div class="row">
        <div class="col-xl-12">
          <label for="day" class="form-label">*Días de la semana:</label><br>
          <div class="form-check form-check-inline">
            <label for="day" class="form-check-label">Lunes</label>
            @if (strpos($activity->day,'L') == true)
            <input name="day[]" checked class="form-check-input" type="checkbox" id="day" value="L">
            @else
            <input name="day[]" class="form-check-input" type="checkbox" id="day" value="L">
            @endif
          </div>
          <div class="form-check form-check-inline">
            <label for="day" class="form-check-label">Martes</label>
            @if (strpos($activity->day,'M') == true)
            <input name="day[]" checked class="form-check-input" type="checkbox" id="day" value="M">
            @else
            <input name="day[]" class="form-check-input" type="checkbox" id="day" value="M">
            @endif
          </div>
          <div class="form-check form-check-inline">
            <label for="day" class="form-check-label">Miércoles</label>
            @if (strpos($activity->day,'I') == true)
            <input name="day[]" checked class="form-check-input" type="checkbox" id="day" value="I">
            @else
            <input name="day[]" class="form-check-input" type="checkbox" id="day" value="I">
            @endif
          </div>
          <div class="form-check form-check-inline">
            <label for="day" class="form-check-label">Jueves</label>
            @if (strpos($activity->day,'J') == true)
            <input name="day[]" checked class="form-check-input" type="checkbox" id="day" value="J">
            @else
            <input name="day[]" class="form-check-input" type="checkbox" id="day" value="J">
            @endif
          </div>
          <div class="form-check form-check-inline">
            <label for="day" class="form-check-label">Viernes</label>
            @if (strpos($activity->day,'V') == true)
            <input name="day[]" checked class="form-check-input" type="checkbox" id="day" value="V">
            @else
            <input name="day[]" class="form-check-input" type="checkbox" id="day" value="V">
            @endif
          </div>
          <div class="form-check form-check-inline">
            <label for="day" class="form-check-label">Sábado</label>
            @if (strpos($activity->day,'S') == true)
            <input name="day[]" checked class="form-check-input" type="checkbox" id="day" value="S">
            @else
            <input name="day[]" class="form-check-input" type="checkbox" id="day" value="S">
            @endif
          </div>
          <div class="form-check form-check-inline">
            <label for="day" class="form-check-label">Domingo</label>
            @if (strpos($activity->day,'D') == true)
            <input name="day[]" checked class="form-check-input" type="checkbox" id="day" value="D">
            @else
            <input name="day[]" class="form-check-input" type="checkbox" id="day" value="D">
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
        <label for="venue_id" class="form-label">*Sede:</label>
        <select required name="venue_id" id="venue_id" class="form-select">
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
        <label for="min_quota" class="form-label">Cupo mínimo:</label>
        <input type="number" min="1" class="form-control" name="min_quota" id="min_quota" placeholder="Ej. 5" value="{!! $activity->min_quota !!}">
      </div>
      <div class="col-xl-3">
        <label for="max_quota" class="form-label">Cupo máximo:</label>
        <input type="number" min="1" class="form-control" name="max_quota" id="max_quota" placeholder="Ej. 30" value="{!! $activity->max_quota !!}">
      </div>
      <div class="col-xl-3">
        <label for="ctc" class="form-label">Acreditación:</label>
        <input type="number" min="0" max="100" class="form-control" name="ctc" id="ctc" placeholder="Ej. 80" value="{!! $activity->ctc !!}">
      </div>
      <div class="col-xl-3">
        <label for="cost" class="form-label">Costo:</label>
        <input type="text" required class="form-control" name="cost" id="cost" placeholder="Ej. 799.99" value="{!! $activity->cost !!}">
      </div>
    </div>

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
          <a href="{!! route("view.activities") !!}" class="btn btn-outline-warning">Cancelar</a>
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

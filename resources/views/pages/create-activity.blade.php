@extends('layouts.app')
@section('content')

<div class="card">
  <div class="card-header"><br>
    <h3>Crear Actividades <i class="bi bi-journals"></i></h3>
    <h4>{!! $activity_cat->name!!}</h4>
  </div>
  
  @include('partials.messages')

  <div class="card-body"><br>
    <form method="POST" action="{!! route('store.activity') !!}">
      @csrf
      @method('post')
      <div class="row">
        <input id="activity_catalogue_id" type="hidden" class="form-control" name="activity_catalogue_id" value="{{ $activity_cat->activity_catalogue_id}}" required>
        <div class="col-xl-2">
          <label for="year" class="form-label">*Periodo:</label>
          <input type="text" required class="form-control" name="year" id="year" placeholder="Ej. 2022" value="{!! old('year') !!}">
        </div>
        <div class="col-xl-2 mt-auto">
          <label for="num" class="form-label"></label>
          <select name="num" id="num" class="form-select">
            <option {!! old('num') == '1' ? "selected" : "" !!} value="1">1</option>
            <option {!! old('num') == '2' ? "selected" : "" !!} value="2">2</option>
          </select>
        </div>
        <div class="col-xl-2 mt-auto">
          <label for="type" class="form-label"></label>
          <select name="type" id="type" class="form-select">
            <option {!! old('type') == 's' ? "selected" : "" !!} value="s">Semestral</option>
            <option {!! old('type') == 'i' ? "selected" : "" !!} value="i">Intersemestral</option>
          </select>
        </div>
        <div class="col-xl-3">
          <label for="start_time" class="form-label">*Hora de inicio:</label>
          <input type="time" required class="form-control" name="start_time" id="start_time" value="{!! old('start_time') !!}">
        </div>
        <div class="col-xl-3">
          <label for="end_time" class="form-label">*Hora de fin:</label>
          <input type="time" required class="form-control" name="end_time" id="end_time" value="{!! old('end_time') !!}">
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12">
          <label for="days_week" class="form-label">*Días de la semana:</label><br>
          <div class="form-check form-check-inline">
            <label for="days_week" class="form-check-label">Lunes</label>
            <input name="days_week[]" class="form-check-input" type="checkbox" id="days_week" {!! old('days_week') == 'L' ? "selected" : "" !!} value="L">
          </div>
          <div class="form-check form-check-inline">
            <label for="days_week" class="form-check-label">Martes</label>
            <input name="days_week[]" class="form-check-input" type="checkbox" id="days_week" {!! old('days_week') == 'M' ? "selected" : "" !!} value="M">
          </div>
          <div class="form-check form-check-inline">
            <label for="days_week" class="form-check-label">Miércoles</label>
            <input name="days_week[]" class="form-check-input" type="checkbox" id="days_week" {!! old('days_week') == 'I' ? "selected" : "" !!} value="I">
          </div>
          <div class="form-check form-check-inline">
            <label for="days_week" class="form-check-label">Jueves</label>
            <input name="days_week[]" class="form-check-input" type="checkbox" id="days_week" {!! old('days_week') == 'J' ? "selected" : "" !!} value="J">
          </div>
          <div class="form-check form-check-inline">
            <label for="days_week" class="form-check-label">Viernes</label>
            <input name="days_week[]" class="form-check-input" type="checkbox" id="days_week" {!! old('days_week') == 'V' ? "selected" : "" !!} value="V">
          </div>
          <div class="form-check form-check-inline">
            <label for="days_week" class="form-check-label">Sábado</label>
            <input name="days_week[]" class="form-check-input" type="checkbox" id="days_week" {!! old('days_week') == 'S' ? "selected" : "" !!} value="S">
          </div>
          <div class="form-check form-check-inline">
            <label for="days_week" class="form-check-label">Domingo</label>
            <input name="days_week[]" class="form-check-input" type="checkbox" id="days_week" {!! old('days_week') == 'D' ? "selected" : "" !!} value="D">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6">
          <label for="manual_date" class="form-label">*Fecha manual:</label>
          <input type="text" required class="form-control" name="manual_date" id="manual_date" placeholder="Ej. Los días 5, 7 y 9 de Agosto" value="{!! old('manual_date') !!}">
        </div>
        <div class="col-xl-6">
          <label for="venue_id" class="form-label">*Sede:</label>
          <select name="venue_id" id="venue_id" class="form-select">
            @foreach($venues as $venue)
              <option {!! old('venue_id') == $venue->venue_id ? "selected" : "" !!} 
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
          <input required type="number" min="1" class="form-control" name="min_quota" id="min_quota" placeholder="Ej. 5" value="{!! old('min_quota') !!}">
        </div>
        <div class="col-xl-3">
          <label for="max_quota" class="form-label">Cupo máximo:</label>
          <input required type="number" min="1" class="form-control" name="max_quota" id="max_quota" placeholder="Ej. 30" value="{!! old('max_quota') !!}">
        </div>
        <div class="col-xl-3">
          <label for="ctc" class="form-label">Acreditación:</label>
          <input type="number" min="0" max="100" class="form-control" name="ctc" id="ctc" placeholder="Ej. 80" value="{!! old('ctc') !!}">
        </div>
        <div class="col-xl-3">
          <label for="cost" class="form-label">Costo:</label>
          <input type="text" required class="form-control" name="cost" id="cost" placeholder="Ej. 799.99" value="{!! old('cost') !!}">
        </div>
      </div>
      


      <div class="row">
        <div class="d-grid gap-2 col-xl-2" id='btn_save'>
          <button type="submit" id='save-btn' class="btn btn-outline-success"> Guardar </button>
        </div>
        <div class="col-xl-2">
          <a href="{!! route("view.activities.catalogue") !!}" class="btn btn-outline-warning">Cancelar</a>
        </div>
      </div>

    </form>
  </div>
</div>

@endsection

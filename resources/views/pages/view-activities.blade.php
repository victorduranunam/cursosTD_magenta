@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Actividades Programadas <i class="bi bi-journals"></i></h3>
    <div class="row justify-content-end">
      
      {{-- Program Activities --}}
      <div class="col-xl-3" style='width: auto'>
          <a href={!! route('view.activities.catalogue') !!} class="btn btn-outline-success">Programar Actividades</a>
      </div>

      {{-- Generate docs --}}
      <div class="col-xl-2" style='width: auto'>
        <div class="dropdown">
          <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
            Formatos
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
            <li><a class="dropdown-item" href="{!! route('download.activities-export') !!}">Exportación</a></li>
            <li><a class="dropdown-item" href="{!! route('download.activities-keys-book') !!}">Libro de Folios</a></li>
            <li><a class="dropdown-item" id="generalRecordRoute" name="{!! route('download.activities-general-record') !!}" onclick='selectGeneralRecordRouteActivityDocs()' data-bs-toggle="modal" data-bs-target="#myModalDocs">Reporte General</a></li>
            <li><a class="dropdown-item" id="suggetionsRecordRoute" name="{!! route('download.activities-suggestions-record') !!}" onclick='selectSuggestionsRecordRouteActivityDocs()' data-bs-toggle="modal" data-bs-target="#myModalDocs">Reporte de Sugerencias</a></li>
          </ul>
          <form method="GET" action="{!! route('view.activities') !!}" id='docsForm'>
            @csrf
            <div class="modal fade" id="myModalDocs" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="docsModalLabel">Escoger Periodo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-10">
                        <label for="period" class="form-label">Ingrese el periodo</label>
                        <input placeholder="Año" type="number" min="1900" max="2199" step="1" id="year_search" name="year_search" class="form-control">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <select class="form-select" name="num_search" id="num_search">
                          <option value="1">1</option>
                          <option value="2">2</option>
                        </select>
                      </div>
                      <div class="col-6">
                        <select class="form-select" name="type_search" id="type_search">
                          <option value="s">Semestral</option>
                          <option value="s">Intersemestral</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="submit" value="Generar" class="btn btn-outline-primary">
                    <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cancelar</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      {{-- Return --}}
      <div class="col-xl-2">
        <a href={!! route('home') !!} class="btn btn-outline-warning">Regresar</a>
      </div>

    </div>
  </div>

  @include('partials.messages')
  <div class="card-body"><br>
    @if($activities->isNotEmpty())
      
      <div class="row">
        <div class="col-xl-4">
          <h6>Nombre</h6>
        </div>
        <div class="col-xl-4">
          <h6>Instructor</h6>
        </div>
        <div class="col-xl-2">
          <h6>Periodo</h6>
        </div>
      </div>

      @foreach ($activities as $activity)
        <div class="row row-list">
          {{-- Nombre de la actividad --}}
          <div class="col-xl-4">
            {!! $activity->catalogue_name !!}
          </div>
          {{-- Instructores de la actividad --}}
          <div class="col-xl-4">
            {!! $activity->getInstructorsName() !!}
          </div>
          {{-- Semestre de la actividad --}}
          <div class="col-xl-2">
            {!! $activity->getPeriod() !!}
          </div>
          
          {{-- Opciones de la actividad --}}
          <div class="col-xl-2">
            <div class="dropdown">
              <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Opciones
              </button>
              <form method="POST" action="{!! route('delete.activity', $activity->activity_id) !!}">
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  @csrf
                  @method('delete')
                  <li><a class="dropdown-item" href={!! route('view.participants', $activity->activity_id) !!}>Ver participantes inscritos</a></li>
                  <li><a class="dropdown-item" href={!! route('create.participant', $activity->activity_id) !!}>Inscribir participantes</a></li>
                  <li><a class="dropdown-item" href={!! route('view.instructors', $activity->activity_id) !!}>Instructores</a></li>
                  <li><a class="dropdown-item" href={!! route('download.activity-promo', $activity->activity_id) !!}>Publicidad</a></li>
                  <li><a class="dropdown-item" href={!! route('edit.activity', $activity->activity_id) !!}>Actualizar</a></li>
                  {{-- TODO: reportes de evaluacion si son admins --}}
                  <div class="dropdown-divider"></div>
                  <li><button type=button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#myModal{!! $activity->activity_id !!}">Eliminar</button></li>
                </ul>
                <div class="modal fade" id="myModal{!! $activity->activity_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar actividad</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p>¿Está seguro de eliminar la actividad {!! $activity->catalogue_name !!}?
                          Esto borrará los registros que existan entre instructores y participantes
                          con ella. 
                        </p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" value="Eliminar" class="btn btn-outline-danger">
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        
        </div>
      @endforeach

    @elseif($activities->isEmpty())
      <div class="row">
        <div class="col-xl-6">
          No hay actividades en la base de datos.
        </div>
      </div>
    @endif

    
  </div>
</div>

@endsection
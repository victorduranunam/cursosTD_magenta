@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Actividades Programadas <i class="bi bi-journals"></i></h3>
    <div class="row justify-content-end">
      
      {{-- Program Activities --}}
      <div class="col-3" style='width: auto'>
          <a href={!! route('view.activities.catalogue') !!} class="btn btn-outline-success">Programar Actividades</a>
      </div>

      {{-- Search Activity --}}
      <div class="col-1">
        <a class="btn btn-outline-primary" onclick="blockSearchDiv()">Buscar</a>
      </div>

      {{-- Generate docs --}}
      <div class="col-2" style='width: auto'>
        <div class="dropdown">
          <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
            Formatos
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
            <li><a class="dropdown-item" href="{!! route('download.activities-export') !!}">Exportación</a></li>
            <li><a class="dropdown-item" href="{!! route('download.activities-keys-book') !!}">Libro de Folios</a></li>
            <li><a class="dropdown-item" id="generalReportRoute" name="{!! route('download.activities-general-record') !!}" onclick='selectGeneralReportRouteActivityDocs()' data-bs-toggle="modal" data-bs-target="#myModalDocs">Reporte General</a></li>
            <li><a class="dropdown-item" id="suggetionsReportRoute" name="{!! route('download.activities-suggestions-record') !!}" onclick='selectSuggestionsReportRouteActivityDocs()' data-bs-toggle="modal" data-bs-target="#myModalDocs">Reporte de Sugerencias</a></li>
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

    {{-- Form for search --}}
    <div id="search-div" style="display:none;">
      <form method="GET" action="{!! route('search.activities') !!}">
        @csrf
        @method('get')
        <div class="row">
          <label class="form-label" for="search-type-form">Buscar por:</label>
          <div class="col-3" id="search-type-form">
            <select class="form-select" name="search_type" id="search_type" onchange="changeSearchDiv()">
              <option selected value='name'>Nombre</option>
              <option value='instructor'>Instructor</option>
              <option value='period'>Periodo</option>
            </select>
          </div>
          <div class="col-2">
            <input type="submit" id='search-btn' class="btn btn-outline-success" value='Buscar'>
          </div>
        </div>
        <div class="row" id="words-form">
            <label>Buscar:</label>
            <div class="col-6">
              <input class="form-control" placeholder="Ingrese texto" type="text" name="words" id="words" value="{!! old('words') !!}">
            </div>
          </div>
          <div class="row" style="display:none" id="period-form">
            <label>Buscar:</label>
            <div class="col-2">
              <input  min=2000 class="form-control" type="number" name="sem_year" id="sem_year" value="{!! old('sem_year') !!}" placeholder="Año">
            </div>
            <div class="col-2">
              <select required class="form-control" name="sem_type" id="sem_type" value="{!! old('sem_type') !!}">
                <option value="i">Intersemestral</option>
                <option value="s">Semestral</option>
              </select>
            </div>
            <div class="col-2">
              <select class="form-control" name="sem_number" id="sem_number" value="{!! old('sem_number') !!}">
                <option value=1>1</option>
                <option value=2>2</option>
              </select>
            </div>
          </div>
        <hr>
      </form>
    </div>

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
            {!! $activity->activity_catalogue->name !!}
          </div>
          {{-- Instructores de la actividad --}}
          <div class="col-xl-4 mt-auto mb-auto">
            {!! $activity->getInstructorsName() !!}
          </div>
          {{-- Semestre de la actividad --}}
          <div class="col-xl-2 mt-auto mb-auto">
            {!! $activity->getPeriod() !!}
          </div>
          
          {{-- Opciones de la actividad --}}
          <div class="col-xl-2 mt-auto mb-auto">
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
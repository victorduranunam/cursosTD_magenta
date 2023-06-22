@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Ver Actividades en el Catálogo <i class="bi bi-journals"></i></h3>
    <div class="row justify-content-end">
      <div class="col-xl-3" style='width: auto'>
          <a href={!! route('create.activity.catalogue') !!} class="btn btn-outline-success">Alta de Actividad</a>
      </div>
      <div class="col-xl-1">
        <a class="btn btn-outline-primary" onclick="blockSearchDiv()">Buscar</a>
      </div>
      <div class="col-xl-2">
        <a href={!! route('home') !!} class="btn btn-outline-warning">Regresar</a>
      </div>
    </div>
  </div>

  @include('partials.messages')
    <div class="card-body"><br>

      {{-- Form for search --}}
      <div id="search-div" style="display:none;">
        <form method="GET" action="{!! route('search.activity.catalogue') !!}">
          @csrf
          @method('get')
          <div class="row">
            <div class="col-xl-6">
              <label class="form-label" for="words">Buscar actividad en catálogo:</label>
              <input placeholder="Ingrese texto" required class="form-control" type="text" name="words" id="words" value="{!! old('words') !!}">
            </div>
            <div class="col-xl-3">
              <label class="form-label" for="search-type">Buscar por:</label>
              <select class="form-select" name="search_type" id="search_type">
                <option selected value='name'>Nombre</option>
                <option value='key'>Clave</option>
              </select>
            </div>
            <div class="col-xl-2 mt-auto">
              <input type="submit" id='search-btn' class="btn btn-outline-success" value='Buscar'>
            </div>
          </div>
          <hr>
        </form>
      </div>

      @if($activities_cat->isNotEmpty())
        <div class="row">
          <div class="col-xl-2">
            <h6>Clave</h6>
          </div>
          <div class="col-xl-3">
            <h6>Nombre</h6>
          </div>
          <div class="col-xl-2">
            <h6>Departamento</h6>
          </div>
        </div>
        @foreach ($activities_cat as $activity_cat)
        <div class="row row-list">
          <div class="col-xl-2 mt-auto mb-auto">
            {!! $activity_cat->key !!}
          </div>
          <div class="col-xl-3 mt-auto mb-auto">
            {!! $activity_cat->name !!}
          </div>
          <div class="col-xl-1 mt-auto mb-auto" style="text-align:center;">
            {!! $activity_cat->getDepartmentAbbreviation() !!}
          </div>
          <div class="col-xl-2 mt-auto mb-auto">
            <a href={!! route('create.activity', $activity_cat->activity_catalogue_id) !!} class="btn btn-outline-primary">Programar</a>
          </div>
          <div class="col-xl-2 mt-auto mb-auto">
            <a href={!! route('edit.activity.catalogue', $activity_cat->activity_catalogue_id) !!} class="btn btn-outline-secondary">Actualizar</a>
          </div>
          <div class="col-xl-2 mt-auto mb-auto">
            <form method="POST" action="{!! route('delete.activity.catalogue', $activity_cat->activity_catalogue_id) !!}">
              @csrf
              @method('delete')
              <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $activity_cat->activity_catalogue_id !!}">Eliminar</a>
              <div class="modal fade" id="myModal{!! $activity_cat->activity_catalogue_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Eliminar Catálogo de Actividades</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro de eliminar el Catálogo de Actividades {!! $activity_cat->name !!}? 
                        Esto borrará todos los registros
                        que dependan de él, como Actividades programadas, evaluaciones, participantes e instructores. 
                        Si no quiere perder estos registros, primero modifíquelos o genere un reporte histórico.
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
        @endforeach
      @elseif($activities_cat->isEmpty())
        <div class="row">
          <div class="col-xl-6">
            No hay actividades para mostrar.
          </div>
        </div>
        @endif

      
    </div>
  </div>
@endsection
@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Ver Sedes <i class="bi bi-building"></i></h3>
    <div class="row justify-content-end">
      <div class="col-2">
        <a href={!! route('create.venue') !!} class="btn btn-outline-success">Alta de Sede</a>
      </div>
      <div class="col-1">
        <a class="btn btn-outline-primary" onclick="blockSearchDiv()">Buscar</a>
      </div>
      <div class="col-2">
        <a href={!! route('home') !!} class="btn btn-outline-warning">Regresar</a>
      </div>
    </div>
  </div>
  @include('partials.messages')
  <div class="card-body"><br>

    {{-- Form for search --}}
    <div id="search-div" style="display:none;">
      <form method="GET" action="{!! route('search.venues') !!}">
        @csrf
        @method('get')
        <div class="row">

          <div class="col-xl-6">
            <label class="form-label" for="words">Buscar sedes:</label>
            <input required class="form-control" type="text" name="words" 
              id="words" value="{!! old('words') !!}" >
          </div>

          <div class="col-xl-3">
            <label class="form-label" for="search-type">Buscar por:</label>
            <select class="form-select" name="search_type" id="search_type">
              <option selected value='name'>Nombre</option>
              <option value='location'>Locación</option>
            </select>
          </div>

          <div class="col-xl-2 mt-auto">
            <input type="submit" id='search-btn' class="btn btn-outline-success"
            value='Buscar'>
          </div>

        </div>
        <hr>
      </form>
    </div>

    @if($venues->isNotEmpty())

      <div class="row">
        <div class="col-xl-4">
          <h6>Nombre</h6>
        </div>
        <div class="col-xl-4">
          <h6>Locación</h6>
        </div>
      </div>


      @foreach ($venues as $venue)
        <div class="row row-list" style="margin: 1%">
          
          <div class="col-xl-4">
            {!! $venue->name !!}
          </div>

          <div class="col-xl-4">
            {!! $venue->location !!}
          </div>

          <div class="col-xl-2">
            <a href={!! route('edit.venue', $venue->venue_id) !!} class="btn btn-outline-info">Actualizar</a>
          </div>
          <div class="col-xl-2">
            <form method="POST" action="{!! route('delete.venue', $venue->venue_id) !!}">
              @csrf
              @method('delete')
              <a type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $venue->venue_id !!}">Eliminar</a>
              <div class="modal fade" id="myModal{!! $venue->venue_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Eliminar sede</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro de eliminar la sede {!! $venue->name !!}? 
                          Esto borrará todos los registros
                          que dependan de él, como Actividades.
                          Si no quiere perder estos registros primero modifíquelos.
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
    @elseif($venues->isEmpty())
      <div class="row">
        <div class="col-xl-6">
          No hay sedes en la base de datos.
        </div>
      </div>
    @endif
  </div>
</div>
@endsection
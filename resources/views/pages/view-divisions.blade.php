
@extends('layouts.app')
@section('content')

<div class="card">

  {{-- Header and Title--}}
  <div class="card-header"><br>
    <h3>Ver Divisiones <i class="bi bi-briefcase"></i></h3>
    <div class="row justify-content-end">
      <div class="col-1">
        <a class="btn btn-outline-success" onclick="blockCreateDiv()">Crear</a>
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
      <form method="GET" action="{!! route('search.divisions') !!}">
        @csrf
        @method('get')
        <div class="row">
          <div class="col-xl-6">
            <label class="form-label" for="words">Buscar división:</label>
            <input required class="form-control" type="text" name="words" id="words" value="{!! old('words') !!}">
          </div>
          <div class="col-xl-3">
            <label class="form-label" for="search-type">Buscar por:</label>
            <select class="form-select" name="search_type" id="search_type">
              <option selected value='name'>Nombre</option>
              <option value='abbreviation'>Abreviación</option>
            </select>
          </div>
          <div class="col-xl-2 mt-auto">
            <input type="submit" id='search-btn' class="btn btn-outline-success" value='Buscar'>
          </div>
        </div>
        <hr>
      </form>
    </div>

    {{-- Form for create --}}
    <div id="create-div" style="display:none;">
      <form method="POST" action="{!! route('store.division') !!}">
        <h5>Alta de división</h5>
        @csrf
        @method('post')
        <div class="row">
          <div class="col-xl-6">
            <label class="form-label" for="name">Nombre:</label>
            <input required class="form-control" type="text" name="name" id="name" value="{!! old('name') !!}">
          </div>
          <div class="col-xl-3">
            <label class="form-label" for="abbreviation">Abreviación:</label>
            <input required class="form-control" type="text" name="abbreviation" id="abbreviation" value="{!! old('abbreviation') !!}">
          </div>
          <div class="col-xl-2 mt-auto">
            <input type="submit" id='save-btn' class="btn btn-outline-success" value='Guardar'>
          </div>
        </div>
        <hr>
      </form>
    </div>

    {{-- List of elements --}}
    @if($divisions->isNotEmpty())

      <div class="row">
        <div class="col-xl-5">
          <h6>Nombre</h6>
        </div>
        <div class="col-xl-7">
          <h6>Abreviación</h6>
        </div>
      </div>

      @foreach ($divisions as $division)

        <div class="row row-list" style="margin: 1%">

          {{-- Name of the element --}}
          <div class="col-xl-5">
            {!! $division->name !!}
          </div>

          {{-- Abbreviation of the element --}}
          <div class="col-xl-3">
            {!! $division->abbreviation !!}
          </div>

          {{-- Form for update --}}
          <div class="col-xl-2 mt-auto mb-auto">
            <form method="POST" action="{!! route('update.division', $division->division_id) !!}">
              @csrf
              @method('put')
              <a type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#myModalu{!! $division->division_id !!}">Actualizar</a>
              <div class="modal fade" id="myModalu{!! $division->division_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Actualizar Division</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <label class="form-label" for="name">Nombre:</label>
                      <input required class="form-control" type="text" name="name" id="name" value="{!! $division->name !!}">
                      <label class="form-label" for="abbreviation">Abreviación:</label>
                      <input required class="form-control" type="text" name="abbreviation" id="abbreviation" value="{!! $division->abbreviation !!}">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cancelar</button>
                      <input type="submit" value="Guardar" class="btn btn-outline-success">
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>

          {{-- Form for delete --}}
          <div class="col-xl-2 mt-auto mb-auto">
            <form method="POST" action="{!! route('delete.division', $division->division_id) !!}">
              @csrf
              @method('delete')
              <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $division->division_id !!}">Eliminar</a>
              <div class="modal fade" id="myModal{!! $division->division_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Eliminar división</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro de eliminar la división {!! $division->name !!}?
                        Esto borrará los registros que relacionan a un profesor
                        con esta división.
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

    @elseif($divisions->isEmpty())
      
      <div class="row">
        <div class="col-xl-6">
          No hay divisiones en la base de datos.
        </div>
      </div>

    @endif

  </div>
</div>

@endsection
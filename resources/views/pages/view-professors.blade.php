@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Ver Profesores <i class="bi bi-person-lines-fill"></i></h3>
    <div class="row justify-content-end">
      <div class="col-2">
        <a href={!! route('create.professor') !!} class="btn btn-outline-success">Alta de profesor</a>
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
        <form method="GET" action="{!! route('search.professors') !!}">
          @csrf
          @method('get')
          <div class="row">
            <div class="col-xl-6">
              <label class="form-label" for="words">Buscar profesor:</label>
              <input required class="form-control" type="text" name="words" id="words" value="{!! old('words') !!}">
            </div>
            <div class="col-xl-3">
              <label class="form-label" for="search-type">Buscar por:</label>
              <select class="form-select" name="search_type" id="search_type">
                <option selected value='name'>Nombre</option>
                <option value='email'>Email</option>
                <option value='rfc'>RFC</option>
                <option value='worker_number'>Número de trabajador</option>
              </select>
            </div>
            <div class="col-xl-2 mt-auto">
              <input type="submit" id='search-btn' class="btn btn-outline-success" value='Buscar'>
            </div>
          </div>
          <hr>
        </form>
      </div>

      <div class="row">
        <div class="col-xl-3">
          <h6>Nombre</h6>
        </div>
        <div class="col-xl-3">
          <h6>Email</h6>
        </div>
        <div class="col-xl-2">
          <h6>RFC</h6>
        </div>
        <div class="col-xl-2">
          <h6>Número de trabajador</h6>
        </div>
      </div>

      @if( $professors->isNotEmpty() )

        @foreach ($professors as $professor)
      
          <div class="row row-list" style="margin: 1%">

            <div class="col-xl-3 mt-auto mb-auto">
              {!! $professor->getFullName() !!}
            </div>
            <div class="col-xl-3 mt-auto mb-auto">
              {!! $professor->email !!}
            </div>
            <div class="col-xl-2 mt-auto mb-auto">
              {!! $professor->rfc !!}
            </div>
            <div class="col-xl-2 mt-auto mb-auto">
              {!! $professor->worker_number !!}
            </div>
            
            <div class="col-xl-2 mt-auto mb-auto">
              <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle mt-1" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Opciones
                </button>
                <form method="POST" action="{!! route('delete.professor', $professor->professor_id) !!}">
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @csrf
                    @method('delete')
                    
                    <li><a class="dropdown-item" href="{!! route('view.professor-divisions', $professor->professor_id) !!}">Divisiones</a></li>
                    <li><a class="dropdown-item" href="{!! route('view.professor-positions', $professor->professor_id) !!}">Puestos de Trabajo</a></li>
                    <li><a class="dropdown-item" href="{!! route('download.professor-record', $professor->professor_id) !!}">Historial</a></li>
                    <li><a class="dropdown-item" href={!! route('edit.professor', $professor->professor_id) !!}>Actualizar</a></li>
                    <li><a data-bs-toggle="modal" data-bs-target="#myModal{!! $professor->professor_id !!}" class="dropdown-item">Eliminar</a></li>
                
                    
                  </ul>
                  
                  <div class="modal fade" id="myModal{!! $professor->professor_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Eliminar profesor</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p>¿Está seguro de eliminar a {!! $professor->getFullName() !!}? Esto eliminará los registros de sus inscribciones
                            y participaciones como instructor en actividades, así como las evaluaciones que haya o le hayan realizado.
                          </p>
                        </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" value="Eliminar" class="btn btn-outline-danger">
                      </div>
                    </div>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
        @endforeach

      @elseif( $professors->isEmpty() )
        <div class="row">
          <div class="col-xl-6">
            No hay profesores en la base de datos.
          </div>
        </div>
      @endif

    </div>
  </div>
@endsection
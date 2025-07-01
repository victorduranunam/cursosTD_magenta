@extends('layouts.app')
@section('content')

<div class="card">
  <div class="card-header"><br>
    <h3>Ver Estudiantes <i class="bi bi-person-lines-fill"></i></h3>
    <div class="row justify-content-end">
      <div class="col-2">
        <a href="{{ route('create.student') }}" class="btn btn-outline-success">Alta de Alumno</a>
      </div>
      <div class="col-1">
        <a class="btn btn-outline-primary" onclick="blockSearchDiv()">Buscar</a>
      </div>
      <div class="col-2">
        <a href="{{ route('home') }}" class="btn btn-outline-warning">Regresar</a>
      </div>
    </div>
  </div>

  @include('partials.messages')

  <div class="card-body"><br>

    {{-- Form for search --}}
    <div id="search-div" style="display:none;">
      <form method="GET" action="{{ route('search.student') }}">
        @csrf
        @method('get')
        <div class="row">
          <div class="col-xl-6">
            <label class="form-label" for="words">Buscar Estudiantes:</label>
            <input required class="form-control" type="text" name="words" id="words" value="{{ old('words') }}">
          </div>
          <div class="col-xl-3">
            <label class="form-label" for="search-type">Buscar por:</label>
            <select class="form-select" name="search_type" id="search_type">
              <option selected value='name'>Nombre</option>
              <option value='email'>Email</option>
              <option value='rfc'>RFC</option>
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
      <div class="col-xl-4">
        <h6>Nombre</h6>
      </div>
      <div class="col-xl-3">
        <h6>Email</h6>
      </div>
      <div class="col-xl-2">
        <h6>RFC</h6>
      </div>

    </div>

    @if($Students->isNotEmpty())

      @foreach ($Students as $student)

        <div class="row row-list" style="margin: 1%">

          <div class="col-xl-4 mt-auto mb-auto">
            {{ $student->getFullName() }}
          </div>
          <div class="col-xl-3 mt-auto mb-auto">
            {{ $student->email }}
          </div>
          <div class="col-xl-2 mt-auto mb-auto">
            {{ $student->rfc }}
          </div>


          <div class="col-xl-2 mt-auto mb-auto">
            <div class="dropdown">
              <button class="btn btn-outline-primary dropdown-toggle mt-1" type="button" id="dropdownMenuButton{{ $student->student_id }}" data-bs-toggle="dropdown" aria-expanded="false">
                Opciones
              </button>
              <form method="POST" action="{{ route('delete.student', $student->student_id) }}">
                @csrf
                @method('delete')

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $student->student_id }}">
                  <li><a class="dropdown-item" href="{{ route('download.student-record', $student->student_id) }}">Historial</a></li>
                  <li><a class="dropdown-item" href="{{ route('edit.student', $student->student_id) }}">Actualizar</a></li>
                  <li><a data-bs-toggle="modal" data-bs-target="#myModal{{ $student->student_id }}" class="dropdown-item">Eliminar</a></li>
                </ul>

                <div class="modal fade" id="myModal{{ $student->student_id }}" tabindex="-1" aria-labelledby="myModalLabel{{ $student->student_id }}" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel{{ $student->student_id }}">Eliminar Alumno</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p>¿Está seguro de eliminar a {{ $student->getFullName() }}? Esto eliminará las evaluaciones que le hayan realizado.</p>
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

    @else
      <div class="row">
        <div class="col-xl-6">
          No hay Estudiantes en la base de datos.
        </div>
      </div>
    @endif

  </div>
</div>

@endsection

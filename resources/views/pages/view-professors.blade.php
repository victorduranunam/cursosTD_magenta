@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Ver Profesores <i class="bi bi-person-lines-fill"></i></h3>
    <div class="row justify-content-end">
      <div class="col-xl-3">
        <a href={!! route('create.professor') !!} class="btn btn-outline-success">Alta de profesor</a>
      </div>
      <div class="col-xl-2">
        <a href={!! route('home') !!} class="btn btn-outline-warning">Regresar</a>
      </div>
    </div>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
      <div class="row">
        <div class="col-xl-3">
          <h6>Nombre</h6>
        </div>
        <div class="col-xl-3">
          <h6>Correo</h6>
        </div>
        <div class="col-xl-2">
          <h6>RFC</h6>
        </div>
        <div class="col-xl-2">
          <h6>Número de trabajador</h6>
        </div>
      </div>

      @if($professors->isNotEmpty())

        @foreach ($professors as $professor)
      
          <div class="row row-list" style="margin: 1%">

            <div class="col-xl-3">
              {!! $professor->getFullName() !!}
            </div>
            <div class="col-xl-3">
              {!! $professor->email !!}
            </div>
            <div class="col-xl-2">
              {!! $professor->rfc !!}
            </div>
            <div class="col-xl-2">
              {!! $professor->worker_number !!}
            </div>
            
            <div class="col-xl-2">
              <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle mt-1" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Opciones
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <form method="POST" action="{!! route('delete.professor', $professor->professor_id) !!}">
                    @csrf
                    @method('delete')
                    
                    <li><a class="dropdown-item" href="#">Actividades</a></li>
                    <li><a class="dropdown-item" href="#">Historial</a></li>
                    <li><a class="dropdown-item" href={!! route('edit.professor', $professor->professor_id) !!}>Actualizar</a></li>
                    <li><a data-bs-toggle="modal" data-bs-target="#myModal{!! $professor->professor_id !!}" class="dropdown-item">Eliminar</a></li>
                
                    <div class="modal fade" id="myModal{!! $professor->professor_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar profesor</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <p>¿Está seguro de eliminar a {!! $professor->getFullName() !!}? 
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
                </ul>
              </div>
            </div>
          </div>
        @endforeach

      @elseif($departments->isEmpty())
        <div class="row">
          <div class="col-xl-6">
            No hay profesores en la base de datos.
          </div>
        </div>
      @endif

    </div>
  </div>
@endsection
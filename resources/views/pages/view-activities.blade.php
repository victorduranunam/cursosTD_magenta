@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Ver Actividades <i class="bi bi-journals"></i></h3>
    <div class="row justify-content-end">
      <div class="col-xl-3" style='width: auto'>
          <a href={!! route('view.activities.catalogue') !!} class="btn btn-outline-success">Alta de Catálogo de Actividades</a>
      </div>
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
          <div class="col-xl-4">
            {!! $activity->name !!}
          </div>
          <div class="col-xl-4">
            {!! $activity->getProfessors() !!}
          </div>
          <div class="col-xl-2">
          {!! $activity->getSemester() !!}
          </div>
          
          <div class="col-xl-2 mt-auto">
              <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Opciones
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <form method="POST" action="{!! route('delete.activity', $activity->activity_id) !!}">
                    @csrf
                    @method('delete')
                    
                    <li><a class="dropdown-item" href="#">Ver Curso</a></li>
                    <li><a class="dropdown-item" href="#">Inscribir participantes</a></li>
                    <li><a class="dropdown-item" href="#">Instructores</a></li>
                    <li><a class="dropdown-item" href={!! route('edit.activity', $activity->activity_id) !!}>Actualizar</a></li>
                    <div class="dropdown-divider"></div>
                    <li><a data-bs-toggle="modal" data-bs-target="#myModal{!! $activity->activity_id !!}" class="dropdown-item">Eliminar</a></li>
                
                    <div class="modal fade" id="myModal{!! $activity->activity_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar actividad</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <p>¿Está seguro de eliminar a {!! $activity->activity_id !!}? 
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
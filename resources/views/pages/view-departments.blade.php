{{-- TODO: Modal de eliminación --}}

@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Ver Coordinaciones <i class="bi bi-bank"></i></h3>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
      @if($departments->isNotEmpty())
        @foreach ($departments as $department)
        <div class="row">
          <div class="col-xl-6">
            {!! $department->name !!}
          </div>
          <div class="col-xl-2">
            <a href={!! route('edit.department', $department->department_id) !!} class="btn btn-outline-info">Actualizar</a>
          </div>
          <div class="col-xl-2">
            <form method="POST" action="{!! route('delete.department', $department->department_id) !!}">
              @csrf
              @method('delete')
              <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $department->department_id !!}">Eliminar</a>
              <div class="modal fade" id="myModal{!! $department->department_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Eliminar coordinación</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro de eliminar la coordinación {!! $department->name !!}? 
                        Esto borrará todos los registros
                        que dependan de ella, como catálogos de cursos, cursos y evaluaciones. 
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
      @elseif($departments->isEmpty())
        <div class="row">
          <div class="col-xl-6">
            No hay coordinaciones en la base de datos.
          </div>
        </div>
        @endif
        <div class="row">
          <div class="col-xl-3">
            <a href={!! route('create.department') !!} class="btn btn-outline-success">Alta de coordinación</a>
          </div>
          <div class="col-xl-2">
            <a href={!! route('home') !!} class="btn btn-outline-warning">Regresar</a>
          </div>
        </div>
      
    </div>
  </div>
@endsection
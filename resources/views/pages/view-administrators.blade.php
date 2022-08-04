{{-- TODO: Modal de eliminación --}}

@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Ver Administradores <i class="bi bi-person"></i></h3>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
      @if($administrators->isNotEmpty())
        @foreach ($administrators as $administrator)
        <div class="row">
          <div class="col-xl-4">
            {!! $administrator->last_name.' '.$administrator->mothers_last_name.' '.$administrator->name !!}
          </div>
          <div class="col-xl-4">
            {!! $administrator->getJob() !!}
          </div>
          <div class="col-xl-2">
            <a href={!! route('edit.administrator', $administrator->administrator_id) !!} class="btn btn-outline-info">Actualizar</a>
          </div>
          <div class="col-xl-2">
            <form method="POST" action="{!! route('delete.administrator', $administrator->administrator_id) !!}">
              @csrf
              @method('delete')
              <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $administrator->administrator_id !!}">Eliminar</a>
              <div class="modal fade" id="myModal{!! $administrator->administrator_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Eliminar administrador</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro de eliminar al administrador {!! $administrator->getFullName() !!}? 
                        Esto borrará todos los registros
                        que dependan de él, como coordinaciones, cursos y evaluaciones. 
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
      @elseif($administrators->isEmpty())
        <div class="row">
          <div class="col-xl-6">
            No hay administradores en la base de datos.
          </div>
        </div>
        @endif
        <div class="row">
          <div class="col-xl-3">
            <a href={!! route('create.administrator') !!} class="btn btn-outline-success">Alta de administrador</a>
          </div>
          <div class="col-xl-2">
            <a href={!! route('home') !!} class="btn btn-outline-warning">Regresar</a>
          </div>
        </div>
      
    </div>
  </div>
@endsection
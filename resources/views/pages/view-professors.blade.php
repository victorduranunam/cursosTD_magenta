@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Ver Profesores <i class="bi bi-person-lines-fill"></i></h3>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
    <div class="row">
        <div class="col-xl-2">
            <h6>Nombre</h6>
        </div>
        <div class="col-xl-2">
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
      
      <div class="row" style="margin: 1%">
        <div class="col-xl-2">
            {!! $professor->getFullName() !!}
        </div>
        <div class="col-xl-2">
            {!! $professor->email !!}
        </div>
        <div class="col-xl-2">
            {!! $professor->rfc !!}
        </div>
        <div class="col-xl-2">
            {!! $professor->worker_number !!}
        </div>
        <div class="col-xl-2">
        <a href="#"class="btn btn-outline-primary btn-sm">Cursos</a>
          <a href="#"class="btn btn-outline-secondary btn-sm">Historial</a>
        </div>
        <div class="col-xl-2">
        <a href={!! route('edit.professor', $professor->professor_id) !!} class="btn btn-outline-info btn-sm">Actualizar</a>
          <form method="POST" action="{!! route('delete.professor', $professor->professor_id) !!}">
                  @csrf
                  @method('delete')
                  <a type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#myModal{!! $professor->professor_id !!}">Eliminar</a>
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
            <div class="row">
              <div class="col-xl-3">
                <a href={!! route('create.professor') !!} class="btn btn-outline-success">Alta de profesor</a>
              </div>
              <div class="col-xl-2">
                <a href={!! route('home') !!} class="btn btn-outline-warning">Regresar</a>
              </div>
            </div>
        
      
    </div>
  </div>
@endsection
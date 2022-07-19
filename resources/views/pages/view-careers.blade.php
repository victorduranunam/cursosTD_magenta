@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Ver Carreras <i class="bi bi-mortarboard"></i></h3>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
    @if($careers->isNotEmpty())
      @foreach ($careers as $career)
      <div class="row" style="margin: 1%">
        <div class="col-xl-6">
          {!! $career->name !!}
        </div>
        <div class="col-xl-2">
          <a href={!! route('edit.career', $career->career_id) !!} class="btn btn-outline-info">Actualizar</a>
        </div>
        <div class="col-xl-2">
          <form method="POST" action="{!! route('delete.career', $career->career_id) !!}">
                  @csrf
                  @method('delete')
                  <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $career->career_id !!}">Eliminar</button>
                  <div class="modal fade" id="myModal{!! $career->career_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Eliminar carrera</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p>¿Está seguro de eliminar la carrera {!! $career->name !!}? 
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
                <a href={!! route('create.career') !!} class="btn btn-outline-success">Alta de salón</a>
              </div>
              <div class="col-xl-2">
                <a href={!! route('home') !!} class="btn btn-outline-warning">Regresar</a>
              </div>
            </div>
        
      
    </div>
  </div>
@endsection
@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Actualizar Salón <i class="bi bi-building"></i></h3>
    <h4> {!! $venue->name !!} </h4>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
      <form  method="POST" action="{!! route('update.venue', $venue->venue_id) !!}">
        @csrf
        @method('put')
        <div class="row">
          <div class="col-xl-6">
            <label class="form-label" for="name">Nombre:</label>
            <input required class="form-control" type="text" name="name" id="name" value="{!! $venue->name !!}">
          </div>
          <div class="col-xl-3">
            <label class="form-label" for="capacity">Capacidad:</label>
            <input required class="form-control" type="number" min="1" name="capacity" id="capacity" value="{!! $venue->capacity !!}">
          </div>
        </div>
        <div class="row">
          <div class="col-xl-6">
            <label class="form-label" for="administrator_id">Ubicación:</label>
            <input required class="form-control" type="text" name="location" id="location" value="{!! $venue->location !!}">
          </div>
          <div class="col-xl-1 mt-auto">
            <input type="submit" id='save-btn' class="btn btn-outline-success" value='Guardar'>
          </div>
          <div class="col-xl-2 mt-auto" style="margin-left:5px;">
            <a href="{!! route("view.venues") !!}" class="btn btn-outline-warning">Cancelar</a>
          </div>
        </div>
      </form>
      <form method="POST" action="{!! route("delete.venue", $venue->venue_id) !!}">
        @csrf
        @method('delete')
        <div class="row">
          
          <div class="col-2">
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $venue->venue_id !!}">Eliminar</button>
          </div>
        </div>
        <div class="modal fade" id="myModal{!! $venue->venue_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar salón</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>¿Está seguro de eliminar el salón {!! $venue->name !!}? 
                  Esto borrará todos los registros
                  que dependan de él, como Actividades. 
                  Si no quiere perder estos registros primero modifíquelos.
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cancelar</button>
                <input type="submit" value="Eliminar" class="btn btn-outline-danger">
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
</div>
@endsection
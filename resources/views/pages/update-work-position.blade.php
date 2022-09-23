@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Actualizar Categoría y Nivel <i class="bi bi-mortarboard"></i></h3>
    <h4> {!! $work_position->name !!} </h4>
  </div>
  @include('partials.messages')
  <div class="card-body"><br>
    <form method="POST" action="{!! route('update.work-position', $work_position->work_position_id) !!}">
      @csrf
      @method('put')
      <div class="row">
        <div class="col-xl-6">
          <label class="form-label" for="name">Nombre:</label>
          <input required class="form-control" type="text" name="name" id="name" value="{!! $work_position->name !!}">
        </div>
        <div class="col-xl-3">
          <label class="form-label" for="key">Abreviación:</label>
          <input required class="form-control" type="text" name="abbreviation" id="abbreviation" value="{!! $work_position->abbreviation !!}">
        </div>
        <div class="col-xl-2 mt-auto">
          <input type="submit" id='save-btn' class="btn btn-outline-success" value='Guardar'>
        </div>
      </div>

    </form>
    <form method="POST" action="{!! route("delete.work-position", $work_position->work_position_id) !!}">
      @csrf
      @method('delete')
      <div class="row">
        <div class="col-2">
          <a href="{!! route("view.work-positions") !!}" class="btn btn-outline-warning">Cancelar</a>
        </div>
        <div class="col-2">
          <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $work_position->work_position_id !!}">Eliminar</button>
        </div>
      </div>
      <div class="modal fade" id="myModal{!! $work_position->work_position_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Eliminar categoría</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>¿Está seguro de eliminar la categoría {!! $work_position->name !!}?
                Esto borrará los registros que existan entre profesores
                con ella.
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

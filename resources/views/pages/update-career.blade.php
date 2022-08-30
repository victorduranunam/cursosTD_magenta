@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Actualizar Carrera <i class="bi bi-mortarboard"></i></h3>
    <h4> {!! $career->name !!} </h4>
  </div>
  @include('partials.messages')
  <div class="card-body"><br>
    <form method="POST" action="{!! route('update.career', $career->career_id) !!}">
      @csrf
      @method('put')
      <div class="row">
        <div class="col-xl-6">
          <label class="form-label" for="name">Nombre:</label>
          <input required class="form-control" type="text" name="name" id="name" value="{!! $career->name !!}">
        </div>
        <div class="col-xl-3">
          <label class="form-label" for="key">Clave:</label>
          <input required class="form-control" type="text" name="key" id="key" value="{!! $career->key !!}">
        </div>
        <div class="col-xl-2 mt-auto">
          <input type="submit" id='save-btn' class="btn btn-outline-success" value='Guardar'>
        </div>
      </div>

    </form>
    <form method="POST" action="{!! route("delete.career", $career->career_id) !!}">
      @csrf
      @method('delete')
      <div class="row">
        <div class="col-2">
          <a href="{!! route("view.careers") !!}" class="btn btn-outline-warning">Cancelar</a>
        </div>
        <div class="col-2">
          <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $career->career_id !!}">Eliminar</button>
        </div>
      </div>
      <div class="modal fade" id="myModal{!! $career->career_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Eliminar carrera</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>¿Está seguro de eliminar la carrera {!! $career->name !!}?
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

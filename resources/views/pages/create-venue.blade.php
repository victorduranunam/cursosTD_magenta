@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Crear Salón <i class="bi bi-building"></i></h3>
  </div>
  @include('partials.messages')
  <div class="card-body"><br>
    <form  method="POST" action="{!! route('store.venue') !!}">
      @csrf
      @method('post')
      <div class="row">
        <div class="col-xl-6">
          <label class="form-label" for="name">Nombre:</label>
          <input required class="form-control" type="text" name="name" id="name" placeholder="Ej. Salón A208" value="{!! old('name') !!}">
        </div>
        <div class="col-xl-3">
          <label class="form-label" for="capacity">Capacidad:</label>
          <input required class="form-control" type="number" min="1" name="capacity" id="capacity" placeholder="Ej. 50" value="{!! old('capacity') !!}">
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6">
          <label class="form-label" for="location">Ubicación:</label>
          <input required class="form-control" type="text" name="location" id="location" placeholder="Ej. Facultad de Ingeniería" value="{!! old('location') !!}">
        </div>
        <div class="col-xl-2 mt-auto">
          <input type="submit" id='save-btn' class="btn btn-outline-info" value='Guardar'>
        </div>
      </div>
    </form>
    <div class="row">
      <div class="col-2">
        <a href="{!! route("view.venues") !!}" class="btn btn-outline-warning">Cancelar</a>
      </div>
    </div>
  </div>
</div>
@endsection
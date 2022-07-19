@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Crear División <i class="bi bi-briefcase"></i></h3>
  </div>
  @include('partials.messages')
  <div class="card-body"><br>
    <form  method="POST" action="{!! route('store.division') !!}">
      @csrf
      @method('post')
      <div class="row">
        <div class="col-xl-6">
          <label class="form-label" for="name">Nombre:</label>
          <input required class="form-control" type="text" name="name" id="name" placeholder="Ej. División de Ingeniería Eléctrica" value="{!! old('name') !!}">
        </div>
        <div class="col-xl-3">
          <label class="form-label" for="abbreviation">Abreviatura:</label>
          <input required class="form-control" type="text" name="abbreviation" id="abbreviation" placeholder="Ej. DIE" value="{!! old('abbreviation') !!}">
        </div>
        <div class="col-xl-2 mt-auto">
          <input type="submit" id='save-btn' class="btn btn-outline-info" value='Guardar'>
        </div>
      </div>
      
    </form>
    <div class="row">
      <div class="col-2">
        <a href="{!! route("view.divisions") !!}" class="btn btn-outline-warning">Cancelar</a>
      </div>
    </div>
  </div>
</div>
@endsection
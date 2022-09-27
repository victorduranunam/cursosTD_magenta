@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Crear Administrador <i class="bi bi-person"></i></h3>
  </div>
  @include('partials.messages')
  <div class="card-body"><br>
    <form  method="POST" action="{!! route('store.administrator') !!}">
      @csrf
      @method('post')
      <div class="row">
        <div class="col-xl-6">
          <label class="form-label" for="name">*Nombre:</label>
          <input required class="form-control" type="text" name="name" id="name" placeholder="Ej. Luz Carolina" value="{!! old('name') !!}">
        </div>
        <div class="col-xl-6">
          <label class="form-label" for="last_name">*Apellido Paterno:</label>
          <input required class="form-control" type="text" name="last_name" id="last_name" placeholder="Ej. Ramos" value="{!! old('last_name') !!}">
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6">
          <label class="form-label" for="mothers_last_name">Apellido Materno:</label>
          <input class="form-control" type="text" name="mothers_last_name" id="mothers_last_name" placeholder="Ej. Villa" value="{!! old('mothers_last_name') !!}">
        </div>
        <div class="col-xl-3">
          <label class="form-label" for="degree">Abreviatura de grado:</label>
          <input class="form-control" type="text" name="degree" id="degree" placeholder="Ej. Ing." value="{!! old('degree') !!}">
        </div>
        <div class="col-xl-3">
          <label class="form-label" for="gender">Género</label>
          <select class="form-select" name="gender" id="gender">
            <option {!! old('gender') == 'M' ? "selected" : "" !!} value="M">Masculino</option>
            <option {!! old('gender') == 'F' ? "selected" : "" !!} value="F">Femenino</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6">
          <label for="job">*Cargo:</label>
          <select required class="form-select" name="job" id="job">
            <option {!! old('job') == 'C' ? "selected" : "" !!} value="C">Coordinador</option>
            <option {!! old('job') == 'O' ? "selected" : "" !!} value="O">Coordinador General</option>
            <option {!! old('job') == 'S' ? "selected" : "" !!} value="S">Secretario de Apoyo</option>
            <option {!! old('job') == 'D' ? "selected" : "" !!} value="D">Director</option>
          </select>
        </div>
        <div class="col-xl-2 mt-auto">
          <input type="submit" id='save-btn' class="btn btn-outline-success" value='Guardar'>
        </div>
      </div>
    </form>
    <div class="row">
      <div class="col-2">
        <a href="{!! route("view.administrators") !!}" class="btn btn-outline-warning">Cancelar</a>
      </div>
    </div>
  </div>
</div>
@endsection
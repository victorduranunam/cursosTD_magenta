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
          <label class="form-label" for="gender">Género:</label>
          <select class="form-select" name="gender" id="gender">
            <option value='' selected>No especificado</option>
            <option {!! old('gender') == 'M' ? "selected" : "" !!} value="M">Masculino</option>
            <option {!! old('gender') == 'F' ? "selected" : "" !!} value="F">Femenino</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-4 mt-auto">
          <label for="job">*Nombre de usuario:</label>
          <input required max=40 min=5 class="form-control" type="text" name="username" id="username" placeholder="Ej. jefe_dsa" value="{!! old('username') !!}">
        </div>
        <div class="col-xl-4 mt-auto">
          <label for="job">*Contraseña:</label>
          <input required max=60 min=8 class="form-control" type="password" name="password" id="password" placeholder="Máximo 60 caracteres.">
        </div>
        <div class="col-xl-4 mt-auto">
          <label class="form-label" for="role">*¿Cuál será el rol del administrador?</label>
          <select class="form-select" name="role" id="role">
            <option value="J"> Jefe del Departamento </option>
            <option value="A" selected> Ayudante del Departamento </option>
          </select>
        </div>
      </div>
      <div class="row">
        
        <div class="col-xl-5">
          <label class="form-label" for="department_id">Departamento</label>
          <select class="form-select" name="department_id" id="department_id" required>
            @foreach ($departments as $department)
              <option value={!! $department->department_id !!}> 
                {!! $department->name !!} 
              </option>  
            @endforeach
          </select>
        </div>
        <div class="d-grid gap-2 col-xl-2 mt-auto">
          <button type="submit" id='save-btn' class="btn btn-outline-success"> Guardar </button>
        </div>
        <div class="col-xl-2 mt-auto">
          <a href="{!! route("view.administrators") !!}" class="btn btn-outline-warning">Cancelar</a>
        </div>
        
      </div>
    </form>
    <div class="row">
    </div>
  </div>
</div>
@endsection
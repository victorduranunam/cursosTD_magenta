{{-- TODO: Modal de eliminación --}}

@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Actualizar Administrador <i class="bi bi-person"></i></h3>
    <h4> {!! $administrator->getFullName() !!} </h4>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
      <form  method="POST" action="{!! route('update.administrator', $administrator->administrator_id) !!}">
        @csrf
        @method('put')
        <div class="row">
          <div class="col-xl-6">
            <label class="form-label" for="name">*Nombre:</label>
            <input required class="form-control" type="text" name="name" id="name" placeholder="Ej. Luz Carolina" value="{!! $administrator->name !!}">
          </div>
          <div class="col-xl-6">
            <label class="form-label" for="last_name">*Apellido Paterno:</label>
            <input required class="form-control" type="text" name="last_name" id="last_name" placeholder="Ej. Ramos" value="{!! $administrator->last_name !!}">
          </div>
        </div>
        <div class="row">
          <div class="col-xl-6">
            <label class="form-label" for="mothers_last_name">Apellido Materno:</label>
            <input class="form-control" type="text" name="mothers_last_name" id="mothers_last_name" placeholder="Ej. Villa" value="{!! $administrator->mothers_last_name !!}">
          </div>
          <div class="col-xl-3">
            <label class="form-label" for="degree">Abreviatura de grado:</label>
            <input class="form-control" type="text" name="degree" id="degree" placeholder="Ej. Ing." value="{!! $administrator->degree !!}">
          </div>
          <div class="col-xl-3">
            <label class="form-label" for="gender">Género</label>
            <select class="form-select" name="gender" id="gender">
              <option {!! $administrator->gender == NULL ? "selected" : "" !!} value="">No especificado</option>
              <option {!! $administrator->gender == 'M' ? "selected" : "" !!} value="M">Masculino</option>
              <option {!! $administrator->gender == 'F' ? "selected" : "" !!} value="F">Femenino</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-4">
            <label for="job">*Nombre de usuario:</label>
            <input required max=40 min=5 class="form-control" type="text" name="username" id="username" placeholder="Ej. jefe_dsa" value="{!! $administrator->username !!}">
          </div>
          <div class="col-xl-4">
            <label for="job">*Contraseña:</label>
            <input required max=60 min=8 class="form-control" type="password" name="password" id="password" placeholder="Máximo 60 caracteres.">
          </div>
        </div>
        <div class="row">
          <div class="col-xl-4">
            <label class="form-label" for="admin">*¿Cuenta con todos los privilegios?</label>
            <select class="form-select" name="admin" id="admin">
              <option {!! $administrator->admin == TRUE ? "selected" : "" !!} value="TRUE">Sí</option>
              <option {!! $administrator->admin == FALSE ? "selected" : "" !!} value="FALSE">No</option>
            </select>
          </div>
          <div class="col-xl-5">
            <label class="form-label" for="admin">Departamento</label>
            <select class="form-select" name="department_id" id="department_id">
                <option {!! $administrator->department_id == NULL ? "selected" : "" !!} value=''> Ninguno </option>
                @foreach ($departments as $department)
                  <option {!! $administrator->department_id == $department->department_id ? "selected" : "" !!} 
                    value={!! $department->department_id !!}> 
                    {!! $department->name !!} 
                  </option>
                @endforeach
            </select>
          </div>
          <div class="col-xl-2 mt-auto">
            <input type="submit" id='save-btn' class="btn btn-outline-success" value='Guardar'>
          </div>
        </div>
      </form> 
      <form method="POST" action="{!! route("delete.administrator", $administrator->administrator_id) !!}">
        @csrf
        @method('delete')
        <div class="row">
          <div class="col-2">
            <a href="{!! route("view.administrators") !!}" class="btn btn-outline-warning">Cancelar</a>
          </div>
          <div class="col-2">
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $administrator->administrator_id !!}">Eliminar</button>
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
                      que dependan de él, como departamentos, actividades y evaluaciones. 
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
          </div>
        </div>
      </form>
      
    </div>
</div>
@endsection
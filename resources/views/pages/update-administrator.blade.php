{{-- TODO: Modal de eliminación --}}

@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Actualizar Administrador <i class="bi bi-mortarboard"></i></h3>
    <h4> {!! $administrator->getJob() !!} </h4>
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
              <option {!! $administrator->gender == 'M' ? "selected" : "" !!} value="M">Masculino</option>
              <option {!! $administrator->gender == 'F' ? "selected" : "" !!} value="F">Femenino</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-6">
            <label for="job">*Cargo:</label>
            <select required class="form-select" name="job" id="job">
              <option {!! $administrator->job == 'C' ? "selected" : "" !!} value="C">Coordinador</option>
              <option {!! $administrator->job == 'O' ? "selected" : "" !!} value="O">Coordinador del Centro de Docencia</option>
              <option {!! $administrator->job == 'S' ? "selected" : "" !!} value="S">Secretario de Apoyo</option>
              <option {!! $administrator->job == 'D' ? "selected" : "" !!} value="D">Director</option>
            </select>
          </div>
          <div class="col-xl-2 mt-auto">
            <input type="submit" id='save-btn' class="btn btn-outline-info" value='Guardar'>
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
            <input type="submit" value="Eliminar" class="btn btn-outline-danger">
          </div>
        </div>
      </form>
      
    </div>
</div>
@endsection
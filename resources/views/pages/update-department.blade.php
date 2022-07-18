{{-- TODO: Modal de eliminación --}}

@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Actualizar Coordinación <i class="bi bi-mortarboard"></i></h3>
    <h4> {!! $department->name !!} </h4>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
      <form  method="POST" action="{!! route('update.department', $department->department_id) !!}">
        @csrf
        @method('put')
        <div class="row">
          <div class="col-xl-6">
            <label class="form-label" for="name">Nombre:</label>
            <input required class="form-control" type="text" name="name" id="name" value="{!! $department->name !!}">
          </div>
          <div class="col-xl-3">
            <label class="form-label" for="abbreviation">Abreviación:</label>
            <input required class="form-control" type="text" name="abbreviation" id="abbreviation" value="{!! $department->abbreviation !!}">
          </div>
        </div>
        <div class="row">
          <div class="col-xl-6">
            <label class="form-label" for="administrator_id">*Coordinador:</label>
            <select required class="form-select" name="administrator_id" id="administrator_id">
              @foreach($administrators as $administrator)
                <option 
                {!! $department->administrator_id == $administrator->administrator_id ? "selected" : "" !!}
                  value="{!! $administrator->administrator_id !!}"
                >
                  {!! $administrator->getFullName() !!}
                </option>
              @endforeach
            </select>
          </div>
          <div class="col-xl-2 mt-auto">
            <input type="submit" id='save-btn' class="btn btn-outline-info" value='Guardar'>
          </div>
        </div>
      </form>
      <form method="POST" action="{!! route("delete.department", $department->department_id) !!}">
        @csrf
        @method('delete')
        <div class="row">
          <div class="col-2">
            <a href="{!! route("view.departments") !!}" class="btn btn-outline-warning">Cancelar</a>
          </div>
          <div class="col-2">
            <input type="submit" value="Eliminar" class="btn btn-outline-danger">
          </div>
        </div>
      </form>
      
    </div>
</div>
@endsection
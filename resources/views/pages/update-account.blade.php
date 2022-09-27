@extends('layouts.app')
@section('content')

<div class="card">
  <div class="card-header"><br>
    <h3>Actualizar Cuenta de Usuario <i class="bi bi-person-circle"></i></h3>
  </div>
  
  @include('partials.messages')

  <div class="card-body"><br>
    <form method="POST" action="{!! route('update.account', $account->account_id) !!}">
      @csrf
      @method('put')

      <div class="row">
        <div class="col-xl-6">
          <label for="name" class="form-label">*Nombre de la Cuenta:</label>
          <input type="text" required class="form-control" name="name" id="name" placeholder="Ej. Cuenta de Coordinador Básico" value="{!! $account->name !!}">
        </div>
        <div class="col-xl-2">
          <label for="admin" class="form-label">Es administrador:</label>
          <select name="admin" id="admin" class="form-select">
            <option {!! $account->admin ? "selected" : "" !!} value=true>Sí</option>
            <option {!! !$account->admin ? "selected" : "" !!} value=false>No</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-xl-4">
          <label for="username" class="form-label">*Nombre de Usuario:</label>
          <input type="text" required class="form-control" name="username" id="username" placeholder="Ej. CoordA1B2" value="{!! $account->username !!}">
        </div>
        <div class="col-xl-4">
          <label for="password" class="form-label">*Contraseña:</label>
          <input type="password" required class="form-control" name="password" id="password">
        </div>
      </div>

      <div class="row">
        <div class="col-xl-8">
          <label for="department_id" class="form-label">Departamento asociado:</label>
          <select name="department_id" id="department_id" class="form-select">
            @foreach($departments as $department)
              <option {!! $account->department_id == $department->department_id ? "selected" : "" !!} 
                value={!! $department->department_id !!}>{!! $department->name !!}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-xl-2" id='btn_save'>
          <input type="submit" id='save-btn' class="btn btn-outline-success" value='Guardar'>
        </div>
        <div class="col-xl-2">
          <a href="{!! route("view.accounts") !!}" class="btn btn-outline-warning">Cancelar</a>
        </div>
      </div>

    </form>
  </div>
</div>

@endsection

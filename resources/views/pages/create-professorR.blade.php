@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Crear Instructor <i class="bi bi-person-lines-fill"></i></h3>
  </div>
  @include('partials.messages')
  <div class="card-body"><br>
    <form  method="POST" action="{!! route('store.professor') !!}">
      @csrf
      @method('post')
      <div class="row">
        <div class="col-xl-4">
          <label class="form-label" for="name">*Nombre:</label>
          <input required class="form-control" type="text" name="name" id="name" placeholder="Ej. Luz Carolina" value="{!! old('name') !!}">
        </div>
        <div class="col-xl-4">
          <label class="form-label" for="last_name">*Apellido Paterno:</label>
          <input required class="form-control" type="text" name="last_name" id="last_name" placeholder="Ej. Ramos" value="{!! old('last_name') !!}">
        </div>
        <div class="col-xl-4">
          <label class="form-label" for="mothers_last_name">Apellido Materno:</label>
          <input required class="form-control" type="text" name="mothers_last_name" id="mothers_last_name" placeholder="Ej. Villa" value="{!! old('mothers_last_name') !!}">
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4">
            <label class="form-label" for="rfc">*RFC:</label>
            <input required class="form-control" type="text" name="rfc" id="rfc"  minlength="10" maxlength="13" pattern="^[A-Za-zÑñ&]{4}\d{6}[A-Za-z0-9]{0,3}$"  placeholder="Ej. RAVV900101FC4 " value="{!! old('rfc') !!}">
        </div>
        <div class="col-xl-4">
            <label class="form-label" for="worker_number">Número de trabajador:</label>
            <input required class="form-control" type="text" name="worker_number" id="worker_number" placeholder="Ej. 962264" value="{!! old('worker_number') !!}">
        </div>
        <div class="col-xl-4">
            <label class="form-label" for="birthdate">Fecha de nacimiento:</label>
            <input required class="form-control" type="date" name="birthdate" id="birthdate"  value="{!! old('birthdate') !!}">
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4">
          <label class="form-label" for="phone_number">Número de teléfono:</label>
          <input required class="form-control" type="text" name="phone_number" id="phone_number" placeholder="Ej. 5539752674" value="{!! old('phone_number') !!}">
        </div>
        <div class="col-xl-4">
          <label class="form-label" for="email">Email:</label>
          <input required class="form-control" type="text" name="email" id="email" placeholder="Ej. ejemplo@gmail.com" value="{!! old('email') !!}">
        </div>
        <div class="col-xl-4">
          <label class="form-label" for="degree">Abriaviatura de Grado:</label>
          <input class="form-control" value="{!! old('degree') !!}" type="text" name="degree" id="degree" placeholder="Ej. M.I.">
        </div>
    </div>

    <div class="row">

        

       

        <div class="col-xl-4">
          <label class="form-label" for="gender">Género:</label>
          <div class="form-check">
            <input required class="form-check-input" type="radio" name="gender" id="gender" value="F">
            <label for="gender" class="form-check-label">Femenino</label>
          </div>
          <div class="form-check">
            <input required class="form-check-input" type="radio" name="gender" id="gender" value="M">
            <label for="gender" class="form-check-label">Masculino</label>
          </div>
        </div>

 

        <div class="col-xl-4">
          <label class="form-label" for="semblance">Semblanza corta:</label>
          <textarea style="resize: none; overflow-y:auto;" class="form-control" type="text" rows="4" cols="50" name="semblance" id="semblance">{!! old('semblance') !!}</textarea>
        </div>

        <div class="col-xl-4">
          <label class="form-label" for="provenance">Proveniencia:</label>
          <textarea style="resize: none; overflow-y:auto;" class="form-control" type="text" rows="4" cols="50" name="provenance" id="provenance">{!!old('provenance') !!}</textarea>
        </div>

        </div>

        <div class="row">
            <div class="d-grid gap-2 col-xl-2 mt-auto">
          <input type="hidden" name="is_instructor" value="true">
              <button type="submit" id='save-btn' class="btn btn-outline-success"> Guardar </button>
            </div>
            <div class="col-xl-2 mt-auto">
              <a href="{!! route("view.professors") !!}" class="btn btn-outline-warning">Cancelar</a>
            </div>
          </div>
    </div>


    </form>
  </div>
</div>
@endsection
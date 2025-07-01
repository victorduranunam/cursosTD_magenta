@extends('layouts.app')
@section('content')

<div class="card">
  <div class="card-header"><br>
    <h3>Crear Instructor <i class="bi bi-person-lines-fill"></i></h3>
  </div>

  @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
      </div>
  @endif

  <div class="card-body"><br>
    <form method="POST" action="{{ route('store.professor') }}">
      @csrf
      <div class="row">
        <div class="col-xl-4">
          <label class="form-label" for="name">*Nombre:</label>
          <input required class="form-control" type="text" name="name" id="name" placeholder="Ej. Luz Carolina" value="{{ old('name') }}">
        </div>
        <div class="col-xl-4">
          <label class="form-label" for="last_name">*Apellido Paterno:</label>
          <input required class="form-control" type="text" name="last_name" id="last_name" placeholder="Ej. Ramos" value="{{ old('last_name') }}">
        </div>
        <div class="col-xl-4">
          <label class="form-label" for="mothers_last_name">Apellido Materno:</label>
          <input class="form-control" type="text" name="mothers_last_name" id="mothers_last_name" placeholder="Ej. Villa" value="{{ old('mothers_last_name') }}">
        </div>
      </div>

      <div class="row">
          <div class="col-xl-4">
              <label class="form-label" for="rfc">*RFC:</label>
              <input class="form-control" type="text" name="rfc" id="rfc" minlength="10" maxlength="13" pattern="^[A-Za-zÑñ&]{4}\d{6}[A-Za-z0-9]{0,3}$" placeholder="Ej. RAVV900101FC4" value="{{ old('rfc') }}">
          </div>
          <div class="col-xl-4">
              <label class="form-label" for="worker_number">Número de trabajador UNAM</label>
              <input class="form-control" type="text" name="worker_number" id="worker_number" placeholder="Ej. 962264" value="{{ old('worker_number') }}">
          </div>

          <div class="col-xl-4">
              <label class="form-label" for="student_number">Número cuenta Alumno UNAM:</label>
              <input  class="form-control" type="text" name="student_number" id="student_number" placeholder="Ej. 96226444" value="{{ old('student_number') }}">
          </div>

      </div>

      <div class="row">
          <div class="col-xl-4">
            <label class="form-label" for="phone_number">*Número de teléfono:</label>
            <input required class="form-control" type="text" name="phone_number" id="phone_number" placeholder="Ej. 5539752674" value="{{ old('phone_number') }}">
          </div>
          <div class="col-xl-4">
            <label class="form-label" for="email">*Email:</label>
            <input required class="form-control" type="email" name="email" id="email" placeholder="Ej. ejemplo@gmail.com" value="{{ old('email') }}">
          </div>
          <div class="col-xl-4">
            <label class="form-label" for="degree">Abreviatura de Grado:</label>
            <input class="form-control" type="text" name="degree" id="degree" placeholder="Ej. M.I." value="{{ old('degree') }}">
          </div>
      </div>

      <div class="row">
          <div class="col-xl-4">
            <label class="form-label">Género:</label>
            <div class="form-check">
              <input required class="form-check-input" type="radio" name="gender" id="gender_f" value="F" {{ old('gender') == 'F' ? 'checked' : '' }}>
              <label for="gender_f" class="form-check-label">Femenino</label>
            </div>
            <div class="form-check">
              <input required class="form-check-input" type="radio" name="gender" id="gender_m" value="M" {{ old('gender') == 'M' ? 'checked' : '' }}>
              <label for="gender_m" class="form-check-label">Masculino</label>
            </div>
          </div>

          <div class="col-xl-4">
            <label class="form-label" for="semblance">Semblanza corta:</label>
            <textarea style="resize: none; overflow-y:auto;" class="form-control" rows="4" name="semblance" id="semblance">{{ old('semblance') }}</textarea>
          </div>

          <div class="col-xl-4">
            <label class="form-label" for="provenance">Escuela de procedencia:</label>
            <textarea style="resize: none; overflow-y:auto;" class="form-control" rows="4" name="provenance" id="provenance">{{ old('provenance') }}</textarea>
          </div>
      </div>

      <div class="row">
          <div class="d-grid gap-2 col-xl-2 mt-auto">
            <button type="submit" id='save-btn' class="btn btn-outline-success"> Guardar </button>
          </div>
          <div class="col-xl-2 mt-auto">
            <a href="{{ route('view.professors') }}" class="btn btn-outline-warning">Regresar</a>
          </div>
      </div>

    </form>
  </div>
</div>
@endsection

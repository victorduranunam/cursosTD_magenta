@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Actualizar Estudiante <i class="bi bi-person-lines-fill"></i></h3>
  </div>
  @include('partials.messages')
  <div class="card-body"><br>
    <form  method="POST" action={!! route('update.student', $Student->student_id) !!}>
      @csrf
      @method('put')
      <div class="row">
        <div class="col-xl-4">
          <label class="form-label" for="name">*Nombre:</label>
          <input required class="form-control" type="text" name="name" id="name" placeholder="Ej. Luz Carolina" value="{!!$Student->name !!}">
        </div>
        <div class="col-xl-4">
          <label class="form-label" for="last_name">*Apellido Paterno:</label>
          <input required class="form-control" type="text" name="last_name" id="last_name" placeholder="Ej. Ramos" value="{!!$Student->last_name !!}">
        </div>
        <div class="col-xl-4">
          <label class="form-label" for="mothers_last_name">Apellido Materno:</label>
          <input  class="form-control" type="text" name="mothers_last_name" id="mothers_last_name" placeholder="Ej. Villa" value="{!!$Student->mothers_last_name !!}">
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4">
            <label class="form-label" for="rfc">*RFC:</label>
            <input required class="form-control" type="text" name="rfc" id="rfc"  minlength="10" maxlength="13" pattern="^[A-Za-zÑñ&]{4}\d{6}[A-Za-z0-9]{0,3}$"  placeholder="Ej. RAVV900101FC4 " value="{!!$Student->rfc !!}">
       
          </div>

        <div class="col-xl-4">
            <label class="form-label" for="student_number">Número de cuenta UNAM:</label>
            <input  class="form-control" type="text" name="student_number" id="student_number" placeholder="Ej. 962264" value="{!!$Student->student_number !!}">
        </div>

        <div class="col-xl-4">
            <label class="form-label" for="worker_number">Número de trabajador UNAM:</label>
            <input  class="form-control" type="text" name="worker_number" id="worker_number" placeholder="Ej. 962264" value="{!!$Student->worker_number !!}">
        </div>

    </div>

    <div class="row">
        <div class="col-xl-4">
          <label class="form-label" for="phone_number">Número de teléfono:</label>
          <input  class="form-control" type="text" name="phone_number" id="phone_number" placeholder="Ej. 5539752674" value="{!!$Student->phone_number !!}">
        </div>
        <div class="col-xl-4">
          <label class="form-label" for="email">*Email:</label>
          <input required class="form-control" type="text" name="email" id="email" placeholder="Ej. ejemplo@gmail.com" value="{!!$Student->email !!}">
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4">
          <label class="form-label" for="degree">Abriaviatura de Grado:</label>
          <input class="form-control" value="{!! $Student->degree !!}" type="text" name="degree" id="degree" placeholder="Ej. M.I.">
        </div>



        <div class="col-xl-4">
          <label class="form-label" for="gender">Género:</label>

          @if($Student->gender == 'M')
            <div class="form-check">
              <input required class="form-check-input" type="radio" name="gender" id="gender" value="F">
              <label for="gender" class="form-check-label">Femenino</label>
            </div>
            <div class="form-check">
              <input checked required class="form-check-input" type="radio" name="gender" id="gender" value="M">
              <label for="gender" class="form-check-label">Masculino</label>
            </div>
          @elseif($Student->gender == 'F')
            <div class="form-check">
              <input checked required class="form-check-input" type="radio" name="gender" id="gender" value="F">
              <label for="gender" class="form-check-label">Femenino</label>
            </div>
            <div class="form-check">
              <input required class="form-check-input" type="radio" name="gender" id="gender" value="M">
              <label for="gender" class="form-check-label">Masculino</label>
            </div>
          @else
            <div class="form-check">
              <input required class="form-check-input" type="radio" name="gender" id="gender" value="F">
              <label for="gender" class="form-check-label">Femenino</label>
            </div>
            <div class="form-check">
              <input required class="form-check-input" type="radio" name="gender" id="gender" value="M">
              <label for="gender" class="form-check-label">Masculino</label>
            </div>
          @endif
        </div>

    </div>
    <div class="row">


        <div class="d-grid gap-2 col-xl-2 mt-auto">
          <button type="submit" id='save-btn' class="btn btn-outline-success"> Guardar </button>
        </div>
        <div class="col-xl-2 mt-auto">
          <a href="{!! route("view.student") !!}" class="btn btn-outline-warning">Regresar</a>
        </div>
    </div>

    </form>
  </div>
</div>
@endsection



@section('scripts')
<script>
document.getElementById('formStudent').addEventListener('submit', function(e) {
    const rfcInput = document.getElementById('rfc').value.trim().toUpperCase();
    const rfcError = document.getElementById('rfcError');

    const rfcRegex = /^([A-ZÑ&]{3,4})\d{6}([A-Z0-9]{3})$/;

    if (!rfcRegex.test(rfcInput)) {
      e.preventDefault();
      rfcError.style.display = 'inline';
    } else {
      rfcError.style.display = 'none';
    }
});
</script>
@endsection
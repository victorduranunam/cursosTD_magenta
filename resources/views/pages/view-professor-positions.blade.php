@extends('layouts.app')
@section('content')

<div class="card">

  {{-- Header and Title--}}
  <div class="card-header"><br>
    <h3>Puestos de Trabajo del Profesor <i class="bi bi-briefcase"></i></h3>
    <h4>{!! $professor->getFullName() !!}</h4>
    <div class="row justify-content-end">
      <div class="col-xl-2">
        <a class="btn btn-outline-success" onclick="blockCreateDiv()">Asignar</a>
      </div>
      <div class="col-xl-2">
        <a href={!! route('view.professors') !!} class="btn btn-outline-warning">Regresar</a>
      </div>
    </div>
  </div>

  @include('partials.messages')
  <div class="card-body"><br>

    {{-- Form for create --}}
    <div id="create-div" style="display:none;">
      <form method="POST" action="{!! route('store.professor-position', $professor->professor_id) !!}">
        <h5>Asignar puesto de trabajo</h5>
        @csrf
        @method('post')
        <div class="row">
          <div class="col-xl-6">
            <label class="form-label" for="work_position_id">Nombre:</label>
            <select name="work_position_id" id="work_position_id" class="form-select">
              @foreach($positions as $position)
                <option value="{!! $position->work_position_id !!}">{!! $position->name !!}</option>
              @endforeach
            </select>
          </div>
          <div class="col-xl-2 mt-auto">
            <input type="submit" id='save-btn' class="btn btn-outline-success" value='Guardar'>
          </div>
        </div>
        <hr>
      </form>
    </div>

    {{-- List of elements --}}
    @if($professor->positions->isNotEmpty())

      <div class="row">
        <div class="col-xl-6">
          <h6>Nombre</h6>
        </div>
        <div class="col-xl-6">
          <h6>Abreviación</h6>
        </div>
      </div>

      @foreach ($professor->positions as $position)

        <div class="row row-list" style="margin: 1%">

          {{-- Name of the element --}}
          <div class="col-xl-6">
            {!! $position->getName() !!}
          </div>

          {{-- Abbreviation of the element --}}
          <div class="col-xl-2">
            {!! $position->getAbbreviation() !!}
          </div>

          {{-- Form for delete --}}
          <div class="col-xl-2">
            <form method="POST" action="{!! route('delete.professor-position', $position->professor_position_id) !!}">
              @csrf
              @method('delete')
              <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $position->professor_position_id !!}">Eliminar</a>
              <div class="modal fade" id="myModal{!! $position->professor_position_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Eliminar asignación del puesto de trabajo</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro de eliminar la asignación del puesto de trabajo {!! $position->getName() !!}?
                        Esto únicamente borrará la relación de este profesor con su puesto de trabajo.
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <input type="submit" value="Eliminar" class="btn btn-outline-danger">
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>

        </div>

      @endforeach

    @elseif($professor->positions->isEmpty())
      
      <div class="row">
        <div class="col-xl-6">
          No hay puestos de trabajo asignados al profesor en la base de datos.
        </div>
      </div>

    @endif

  </div>
</div>

<script>
  function blockCreateDiv() {
    document.getElementById('create-div').style.display = "block";
  }
</script>

@endsection
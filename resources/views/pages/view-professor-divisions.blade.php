@extends('layouts.app')
@section('content')

<div class="card">

  {{-- Header and Title--}}
  <div class="card-header"><br>
    <h3>Divisiones del Profesor <i class="bi bi-briefcase"></i></h3>
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
      <form method="POST" action="{!! route('store.professor-division', $professor->professor_id) !!}">
        <h5>Asignar división</h5>
        @csrf
        @method('post')
        <div class="row">
          <div class="col-xl-6">
            <label class="form-label" for="division_id">Nombre:</label>
            <select name="division_id" id="division_id" class="form-select">
              @foreach($divisions as $division)
                <option value="{!! $division->division_id !!}">{!! $division->name !!}</option>
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
    @if($professor->divisions->isNotEmpty())

      <div class="row">
        <div class="col-xl-6">
          <h6>Nombre</h6>
        </div>
        <div class="col-xl-6">
          <h6>Abreviación</h6>
        </div>
      </div>

      @foreach ($professor->divisions as $division)

        <div class="row row-list" style="margin: 1%">

          {{-- Name of the element --}}
          <div class="col-xl-6">
            {!! $division->getName() !!}
          </div>

          {{-- Abbreviation of the element --}}
          <div class="col-xl-2">
            {!! $division->getAbbreviation() !!}
          </div>

          {{-- Form for delete --}}
          <div class="col-xl-2">
            <form method="POST" action="{!! route('delete.professor-division', $division->professor_division_id) !!}">
              @csrf
              @method('delete')
              <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $division->professor_division_id !!}">Eliminar</a>
              <div class="modal fade" id="myModal{!! $division->professor_division_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Eliminar asignación de la división</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro de eliminar la asignación de la división {!! $division->getName() !!}?
                        Esto únicamente borrará la relación de este profesor con su división.
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

    @elseif($professor->divisions->isEmpty())
      
      <div class="row">
        <div class="col-xl-6">
          No hay divisiones asignadas al profesor en la base de datos.
        </div>
      </div>

    @endif

  </div>
</div>

@endsection
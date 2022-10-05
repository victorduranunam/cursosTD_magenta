@extends('layouts.app')
@section('content')


<div class="card">

  {{-- Header and Title--}}
  <div class="card-header"><br>
    <h3>Ver Puestos de Trabajo <i class="bi bi-mortarboard"></i></h3>
    <div class="row justify-content-end">
      <div class="col-xl-3">
        <a class="btn btn-outline-success" onclick="blockCreateDiv()">Crear</a>
      </div>
      <div class="col-xl-2">
        <a href={!! route('home') !!} class="btn btn-outline-warning">Regresar</a>
      </div>
    </div>
  </div>

  @include('partials.messages')
  <div class="card-body"><br>

    {{-- Form for create --}}
    <div id="create-div" style="display:none;">
      <form method="POST" action="{!! route('store.work-position') !!}">
        <h5>Alta de puesto de trabajo</h5>
        @csrf
        @method('post')
        <div class="row">
          <div class="col-xl-6">
            <label class="form-label" for="name">Nombre:</label>
            <input required class="form-control" type="text" name="name" id="name" value="{!! old('name') !!}">
          </div>
          <div class="col-xl-3">
            <label class="form-label" for="abbreviation">Abreviación:</label>
            <input required class="form-control" type="text" name="abbreviation" id="abbreviation" value="{!! old('abbreviation') !!}">
          </div>
          <div class="col-xl-2 mt-auto">
            <input type="submit" id='save-btn' class="btn btn-outline-success" value='Guardar'>
          </div>
        </div>
        <hr>
      </form>
    </div>

    {{-- List of elements --}}
    @if($work_positions->isNotEmpty())

      <div class="row">
        <div class="col-xl-6">
          <h6>Nombre</h6>
        </div>
        <div class="col-xl-6">
          <h6>Abreviación</h6>
        </div>
      </div>

      @foreach ($work_positions as $work_position)

        <div class="row row-list" style="margin: 1%">

          {{-- Name of the element --}}
          <div class="col-xl-6">
            {!! $work_position->name !!}
          </div>

          {{-- Abbreviation of the element --}}
          <div class="col-xl-2">
            {!! $work_position->abbreviation !!}
          </div>

          {{-- Form for update --}}
          <div class="col-xl-2">
            <form method="POST" action="{!! route('update.work-position', $work_position->work_position_id) !!}">
              @csrf
              @method('put')
              <a type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#myModalu{!! $work_position->work_position_id !!}">Actualizar</a>
              <div class="modal fade" id="myModalu{!! $work_position->work_position_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Actualizar Categoría</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <label class="form-label" for="name">Nombre:</label>
                      <input required class="form-control" type="text" name="name" id="name" value="{!! $work_position->name !!}">
                      <label class="form-label" for="abbreviation">Abreviación:</label>
                      <input required class="form-control" type="text" name="abbreviation" id="abbreviation" value="{!! $work_position->abbreviation !!}">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cancelar</button>
                      <input type="submit" value="Guardar" class="btn btn-outline-success">
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>

          {{-- Form for delete --}}
          <div class="col-xl-2">
            <form method="POST" action="{!! route('delete.work-position', $work_position->work_position_id) !!}">
              @csrf
              @method('delete')
              <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $work_position->work_position_id !!}">Eliminar</a>
              <div class="modal fade" id="myModal{!! $work_position->work_position_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Eliminar categoría</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro de eliminar la categoría {!! $work_position->name !!}?
                        Esto borrará los registros que existan entre profesores
                        con ella.
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

    @elseif($departments->isEmpty())

      <div class="row">
        <div class="col-xl-6">
          No hay puestos de trabajo en la base de datos.
        </div>
      </div>

    @endif

  </div>
</div>

@endsection
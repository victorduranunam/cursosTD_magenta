@extends('layouts.app')
@section('content')

<div class="card">

  {{-- Header and Title--}}
  <div class="card-header"><br>
    <h3>Ver Diplomados <i class="bi bi-send"></i></h3>
    <div class="row justify-content-end">
      <div class="col-xl-2">
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
      <form method="POST" action="{!! route('store.diploma') !!}">
        <h5>Alta de diplomado</h5>
        @csrf
        @method('post')
        <div class="row">
          <div class="col-xl-6">
            <label class="form-label" for="name">Nombre:</label>
            <input required class="form-control" type="text" name="name" id="name" value="{!! old('name') !!}">
          </div>
          <div class="col-xl-2 mt-auto">
            <input type="submit" id='save-btn' class="btn btn-outline-success" value='Guardar'>
          </div>
        </div>
        <hr>
      </form>
    </div>

    {{-- List of elements --}}
    @if($diplomas->isNotEmpty())

      @foreach ($diplomas as $diploma)

        <div class="row row-list" style="margin: 1%">
          
          {{-- Name of the element --}}
          <div class="col-xl-6">
            {!! $diploma->name !!}
          </div>

          {{-- Form for update --}}
          <div class="col-xl-2">
            <form method="POST" action="{!! route('update.diploma', $diploma->diploma_id) !!}">
              @csrf
              @method('put')
              <a type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#myModalu{!! $diploma->diploma_id !!}">Actualizar</a>
              <div class="modal fade" id="myModalu{!! $diploma->diploma_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Actualizar Diplomado</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <label class="form-label" for="name">Nombre:</label>
                      <input required class="form-control" type="text" name="name" id="name" value="{!! $diploma->name !!}">     
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
            <form method="POST" action="{!! route('delete.diploma', $diploma->diploma_id) !!}">
              @csrf
              @method('delete')
              <a type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $diploma->diploma_id !!}">Eliminar</a>
              <div class="modal fade" id="myModal{!! $diploma->diploma_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Eliminar diplomado</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro de eliminar el diplamado {!! $diploma->name !!}?
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

    @elseif($diplomas->isEmpty())

      <div class="row">
        <div class="col-xl-6">
          No hay diplomados en la base de datos.
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
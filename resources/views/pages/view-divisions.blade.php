@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Ver Divisiones <i class="bi bi-briefcase"></i></h3>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
    @if($divisions->isNotEmpty())
      @foreach ($divisions as $division)
      <div class="row" style="margin: 1%">
        <div class="col-xl-6">
          {!! $division->name !!}
        </div>
        <div class="col-xl-2">
          <a href={!! route('edit.division', $division->division_id) !!} class="btn btn-outline-info">Actualizar</a>
        </div>
        <div class="col-xl-2">
          <form method="POST" action="{!! route('delete.division', $division->division_id) !!}">
                  @csrf
                  @method('delete')
                  <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $division->division_id !!}">Eliminar</a>
                  <div class="modal fade" id="myModal{!! $division->division_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Eliminar división</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p>¿Está seguro de eliminar la división {!! $division->name !!}?
                            Esto borrará los registros que relacionan a un profesor
                            con esta división.
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
          @elseif($divisions->isEmpty())
            <div class="row">
              <div class="col-xl-6">
                No hay divisiones en la base de datos.
              </div>
            </div>
          @endif
            <div class="row">
              <div class="col-xl-3">
                <a href={!! route('create.division') !!} class="btn btn-outline-success">Alta de división</a>
              </div>
              <div class="col-xl-2">
                <a href={!! route('home') !!} class="btn btn-outline-warning">Regresar</a>
              </div>
            </div>
    </div>
  </div>
@endsection
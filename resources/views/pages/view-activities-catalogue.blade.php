@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Ver Cursos en el Catálogo <i class="bi bi-journals"></i></h3>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
      @if($activities_cat->isNotEmpty())
        @foreach ($activities_cat as $activity_cat)
        <div class="row">
          <div class="col-xl-4">
            {!! $activity_cat->name !!}
          </div>
          <div class="col-xl-2">
            <a href={!! route('edit.activity.catalogue', $activity_cat->activity_catalogue_id) !!} class="btn btn-outline-info">Actualizar</a>
          </div>
          <div class="col-xl-2">
            <form method="POST" action="{!! route('delete.activity.catalogue', $activity_cat->activity_catalogue_id) !!}">
              @csrf
              @method('delete')
              <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $activity_cat->activity_catalogue_id !!}">Eliminar</a>
              <div class="modal fade" id="myModal{!! $activity_cat->activity_catalogue_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Eliminar catálogo de curso</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro de eliminar el catálogo de curso {!! $activity_cat->name !!}? 
                        Esto borrará todos los registros
                        que dependan de él, como cursos programos, evaluaciones, participantes e instructores. 
                        Si no quiere perder estos registros, primero modifíquelos o genere un reporte histórico.
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
      @elseif($activities_cat->isEmpty())
        <div class="row">
          <div class="col-xl-6">
            No hay administradores en la base de datos.
          </div>
        </div>
        @endif
        <div class="row">
          <div class="col-xl-3">
            <a href={!! route('create.activity.catalogue') !!} class="btn btn-outline-success">Alta de catálogo de curso</a>
          </div>
          <div class="col-xl-2">
            <a href={!! route('home') !!} class="btn btn-outline-warning">Regresar</a>
          </div>
        </div>
      
    </div>
  </div>
@endsection
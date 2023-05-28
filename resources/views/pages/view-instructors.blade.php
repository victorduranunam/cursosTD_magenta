@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Asignar Instructores <i class="bi bi-person-video3"></i></h3>
    <h4>{!! $activity->name !!}</h4>
    <div class="row justify-content-end">
     
      <div class="col-xl-2">
        <a href={!! route('view.activities') !!} class="btn btn-outline-warning">Regresar</a>
      </div>
    </div>
  </div>
  @include('partials.messages')
  <div class="card-body"><br>
    @if($instructors->isNotEmpty())
      <div class="row">
        <div class="col-xl-4">
          <h6>Nombre</h6>
        </div>
        <div class="col-xl-3">
          <h6>Email</h6>
        </div>
        <div class="col-xl-2">
          <h6>RFC</h6>
        </div>
        <div class="col-xl-2">
          <h6>Número Trabajador</h6>
        </div>


      </div>

      @foreach ($instructors as $instructor)
        <div class="row row-list">
          <div class="col-xl-4">
            {!! $instructor->name." ".$instructor->last_name." ".$instructor->mothers_last_name !!}
          </div>
          <div class="col-xl-3">
            {!! $instructor->email !!}
          </div>
          <div class="col-xl-2">
            {!! $instructor->rfc !!}
          </div>
          <div class="col-xl-2">
            {!! $instructor->worker_number !!}
          </div>
          
          <div class="col-xl-1">
            <form method="POST" action="{!! route('delete.instructor', $instructor->instructor_id) !!}">
              @csrf
              @method('delete')
              <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $instructor->instructor_id !!}"><i class="bi bi-person-dash"></i></button>
              <div class="modal fade" id="myModal{!! $instructor->instructor_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Eliminar instructor</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro de eliminar el instructor {!! $instructor->name !!}? 
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
    
    @elseif($instructors->isEmpty())
      <div class="row">
        <div class="col-xl-6">
          No hay instructores para {!! $activity->name !!}.
        </div>
      </div>
    @endif
    <hr>
    <!-- Para asignar a instructores-->

    @if($professors->isNotEmpty())
      <div class="row">
        <div class="col-xl-4">
          <h6>Nombre</h6>
        </div>
        <div class="col-xl-3">
          <h6>Email</h6>
        </div>
        <div class="col-xl-2">
          <h6>RFC</h6>
        </div>
        <div class="col-xl-2">
          <h6>Número Trabajador</h6>
        </div>


      </div>

      @foreach ($professors as $professor)
      <form action="{!! route('store.instructor', $professor->professor_id) !!}" method="POST">
      
      <input id="activity_id" type="hidden" class="form-control" name="activity_id" value="{!! $activity->activity_id !!}" required>  
      <div class="row row-list">
        @csrf
        @method('post')
          <div class="col-xl-4">
            {!! $professor->name." ".$professor->last_name." ".$professor->mothers_last_name !!}
          </div>
          <div class="col-xl-3">
            {!! $professor->email !!}
          </div>
          <div class="col-xl-2">
            {!! $professor->rfc !!}
          </div>
          <div class="col-xl-2">
            {!! $professor->worker_number !!}
          </div>
          <div class="col-xl-1">
            <button type="submit" id='save-btn' class="btn btn-outline-success"><i class="bi bi-person-plus"></i></button>
          </div>
        </div>
      </form>
      @endforeach
    @elseif($professors->isEmpty())
      <div class="row">
        <div class="col-xl-6">
          No hay profesores en la base de datos.
        </div>
      </div>
    @endif


  </div>
</div>
@endsection
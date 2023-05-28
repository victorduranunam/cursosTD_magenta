@extends('layouts.app')
@section('content')


<div class="card">
    <div class="card-header"><br>
        <h3>Inscribir Participantes <i class="bi bi-person-check"></i></h3>
        <h4>Actividad: {!! $activity->name !!}</h4><br>
        <h5>Instructor(es):</h5>
        @if($instructors->isNotEmpty())
        @foreach ($instructors as $instructor)
            <h6>{!! $instructor->name." ".$instructor->last_name." ".$instructor->mothers_last_name !!}</h6>
        @endforeach
        @elseif($instructors->isEmpty())
            <h6>No hay instructores asignados.</h6>
        @endif
        <br>
        <h5>Inscritos: {!! $count !!}/{!! $max_count->max_quota !!}</h5>
        <div class="row justify-content-end">
          <div class="col-xl-2">
            <a href={!! route('view.participants', $activity->activity_id) !!} class="btn btn-outline-primary">Ver Inscritos</a>
          </div>
          <div class="col-xl-2">
            <a href={!! route('view.activities') !!} class="btn btn-outline-warning">Regresar</a>
          </div>
        </div>
    </div>
  @include('partials.messages')

  @if($count >= $max_count->max_quota)
  <div class="alert alert-warning message" role='alert'>
    <strong>La actividad alcanzó el cupo máximo, las siguientes inscripciones entrarán como adicionales.</strong>
  </div>
  @endif
    <div class="card-body"><br>
    
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
    <form action="{!! route('store.participant', $professor->professor_id) !!}" method="POST">
      
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
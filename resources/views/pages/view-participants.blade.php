@extends('layouts.app')
@section('content')

<div class="card">

  {{-- Header and Title--}}
  <div class="card-header"><br>
    <h3>Ver Participantes Inscritos <i class="bi bi-briefcase"></i></h3>
    <div class="row">
      <div class="col-xl-6">
        <h4>{!! $activity->name !!}</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-6">
        <h5>Instructor(es):</h5>
        <h6>{!! $activity->getProfessors() !!}</h6>
      </div>
    </div>
    <div class="row justify-content-end">
      <div class="col-xl-2">
        <a class="btn btn-outline-success" href={!! route('create.participant', $activity->activity_id) !!}>Inscribir</a>
      </div>
      <div class="col-xl-2">
        <a href={!! route('view.activities') !!} class="btn btn-outline-warning">Regresar</a>
      </div>
    </div>
  </div>

  @include('partials.messages')
  <div class="card-body"><br>

    {{-- List of elements --}}
    @if($participants->isNotEmpty())

      <div class="row">
        <div class="col-xl-4">
          <h6>Nombre</h6>
        </div>
        <div class="col-xl-4">
          <h6>Resumen</h6>
        </div>
      </div>

      @foreach ($participants as $participant)

        <div class="row" style="margin: 1%">

          {{-- Name of the element --}}
          <div class="col-xl-4">
            {!! $participant->name.' '.$participant->last_name.' '.$participant->mothers_last_name !!}
          </div>

          {{-- Summary of the element --}}
          <div class="col-xl-4">
            {!! $participant->summary !!}
          </div>

          {{-- Button for update --}}
          <div class="col-xl-2">
            <a type="button" class="btn btn-outline-secondary" href={!! route('edit.participant', $participant->participant_id) !!}>Modificar</a>
          </div>

          {{-- Button, form for delete --}}
          <div class="col-xl-2">
            <form method="POST" action="{!! route('delete.participant', $participant->participant_id) !!}">
              @csrf
              @method('delete')
              <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $participant->participant_id !!}">Eliminar</a>
              <div class="modal fade" id="myModal{!! $participant->participant_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Eliminar participante</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro de eliminar al participante {!! $participant->name.' '.$participant->last_name.' '.$participant->mothers_last_name !!}?
                        Esto borrará las evaluaciones del participante y su folio para constancias.
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

    @elseif($participants->isEmpty())
      
      <div class="row">
        <div class="col-xl-6">
          No hay participantes inscritos, primero inscriba algunos.
        </div>
      </div>

    @endif

  </div>
</div>

@endsection
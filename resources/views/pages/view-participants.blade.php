@extends('layouts.app')
@section('content')

<div class="card">

  {{-- Header and Title--}}
  <div class="card-header"><br>
    <h3>Ver Participantes Inscritos <i class="bi bi-person-check"></i></h3>
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

        <div class="row row-list" style="margin: 1%">

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

          {{-- Options for participant --}}
          <div class="col-xl-2">
            <div class="dropdown">
              <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Opciones
              </button>
              <form method="POST" action="{!! route('delete.participant', $participant->participant_id) !!}">
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  @csrf
                  @method('delete')
                  <li><a class="dropdown-item" href={!! route('view.activity-evaluation', $participant->participant_id) !!}>Evaluar Actividad</a></li>
                  <li><a class="dropdown-item" href={!! route('view.instructor-evaluation', $participant->participant_id) !!}>Evaluar Instructores</a></li>
                  <div class="dropdown-divider"></div>
                  <li><button type=button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#myModal{!! $participant->participant_id !!}">Eliminar</button></li>
                </ul>
                <div class="modal fade" id="myModal{!! $participant->participant_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar participante</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p>¿Está seguro de eliminar al participante 
                          {!! $participant->name.
                          ' '.$participant->last_name.
                          ' '.$participant->mothers_last_name !!}?
                          Esto borrará las evaluaciones del participante y su 
                          folio para constancias.
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
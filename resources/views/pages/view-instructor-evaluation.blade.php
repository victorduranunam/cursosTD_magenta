@extends('layouts.app')
@section('content')

<div class="card">
  <div class="card-header"><br>
    <h3>Ver Evaluación de instructor(es) <i class="bi bi-clipboard-check"></i></h3>
    <h5>{!! $participant->name !!}</h5>
    <h6>{!! $participant->activity_name !!}</h6>
  </div>
  
  @include('partials.messages')

  <div class="card-body"><br>
    <div class="accordion" id="accordionExample">
      @if($instructors->isNotEmpty())
        @foreach($instructors as $instructor)
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading{!! $instructor->instructor_id !!}">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{!! $instructor->instructor_id !!}" aria-expanded="false" aria-controls="collapse{!! $instructor->instructor_id !!}">
                {!! $instructor->getName() !!}
              </button>
            </h2>
            <div id="collapse{!! $instructor->instructor_id !!}" class="accordion-collapse collapse" aria-labelledby="heading{!! $instructor->instructor_id !!}" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="table table-hover">
                  <tr>
                    <th width="42%" align="justify"></th>
                    <th align="right">Mala</th>
                    <th align="right">Regular</th>
                    <th align="right">Buena</th>
                    <th align="right">Muy buena</th>
                    <th align="right">Excelente</th>
                  </tr>

                  @for ($q = 1; $q <= 8; $q++)
                    @php
                      $questions = [
                        1 => 'Considero la experiencia del instructor como',
                        2 => 'La planeación y organización de las sesiones y lecturas de acuerdo a los temas fue',
                        3 => 'La puntualidad del instructor fue',
                        4 => 'La forma de utilizar el equipo y materiales de apoyo al curso fue',
                        5 => 'La manera de aclarar las dudas planteadas por los participantes fue',
                        6 => 'Las técnicas grupales utilizadas por el (la) instructor(a) fueron',
                        7 => 'La forma de interesar a los participantes durante el curso fue',
                        8 => 'La actitud del (de la) instructor(a) fue'
                      ];
                      $field = 'question_' . $q;
                      $name = $field . '_' . $instructor->instructor_id;
                      $value = $instructor->evaluation->$field ?? null;
                    @endphp
                    <tr>
                      <td align="justify">{{ $questions[$q] }}</td>
                      @foreach ([50, 60, 80, 95, 100] as $option)
                        <td align="center">
                          <div class="form-check">
                            <input disabled type="radio"
                                   name="{{ $name }}"
                                   value="{{ $option }}"
                                   id="{{ $name }}_{{ $option }}"
                                   class="form-check-input"
                                   {{ $value == $option ? 'checked' : '' }}>
                          </div>
                        </td>
                      @endforeach
                    </tr>
                  @endfor
                </table>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div class="row">
          <div class="col-xl-6">
            No hay instructores asignados a la actividad.
          </div>
        </div>
      @endif

      <div class="row mt-4">
        <div class="col-xl-2">
          <a href="{!! route("view.participants",$participant->activity_id) !!}" class="btn btn-outline-warning">Regresar</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

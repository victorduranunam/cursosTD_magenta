@extends('layouts.app')
@section('content')

<div class="card">
  <div class="card-header"><br>
    <h3>Evaluar instructor(es) <i class="bi bi-clipboard-check"></i></h3>
    <h5>{!! $participant->name !!}</h5>
    <h6>{!! $participant->activity_name !!}</h6>
  </div>
  
  @include('partials.messages')

  <div class="card-body"><br>
    <form method="POST" action="{!! route('store.instructor-evaluation', $participant->participant_id) !!}">
        @csrf
        @method('post')

    <!-- Accordion -->
    <div class="accordion" id="accordionExample">
        @if($instructors->isNotEmpty())
        @foreach($instructors as $instructor)
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{!! $instructor->instructor_id !!}">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{!! $instructor->instructor_id !!}" aria-expanded="false" aria-controls="collapse{!! $instructor->instructor_id !!}">
                {!! $instructor->getName() !!}
            </button>
            </h2>
            <input id="instructor_id" type="hidden" class="form-control" name="instructor_id" value="{{ $instructor->instructor_id}}" required>
            <div id="collapse{!! $instructor->instructor_id !!}" class="accordion-collapse collapse" aria-labelledby="heading{!! $instructor->instructor_id !!}" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <table class="table table-hover">
                        <tr>
                            <th width="42%" align="justify"></th>
                            <th align="right">SR</th>
                            <th align="right">Mala</th>
                            <th align="right">Regular</th>
                            <th align="right">Buena</th>
                            <th align="right">Muy buena</th>
                            <th align="right">Excelente</th>
                        </tr>
                        <!-- QUESTION 1 -->
                        <tr>
                            <td align="justify">Considero la experiencia del instructor como </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_1" value="0" {{ (old('question_1') == '0') ? 'checked' : ''}} class="form-check-input" id="question_1">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_1" value="50" {{ (old('question_1') == '50') ? 'checked' : ''}} class="form-check-input" id="question_1">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_1" value="60" {{ (old('question_1') == '60') ? 'checked' : ''}} class="form-check-input" id="question_1">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_1" value="80" {{ (old('question_1') == '80') ? 'checked' : ''}} class="form-check-input" id="question_1">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_1" value="95" {{ (old('question_1') == '95') ? 'checked' : ''}} class="form-check-input" id="question_1">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_1" value="100" {{ (old('question_1') == '100') ? 'checked' : ''}}  class="form-check-input" id="question_1">
                                </div>
                            </td>
                        </tr>
                        <!-- QUESTION 2 -->
                        <tr>
                            <td align="justify">La planeación y organización de las sesiones y lecturas de acuerdo a los temas fue </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_2" value="0" {{ (old('question_2') == '0') ? 'checked' : ''}} class="form-check-input" id="question_2">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_2" value="50" {{ (old('question_2') == '50') ? 'checked' : ''}} class="form-check-input" id="question_2">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_2" value="60" {{ (old('question_2') == '60') ? 'checked' : ''}} class="form-check-input" id="question_2">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_2" value="80" {{ (old('question_2') == '80') ? 'checked' : ''}} class="form-check-input" id="question_2">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_2" value="95" {{ (old('question_2') == '95') ? 'checked' : ''}} class="form-check-input" id="question_2">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_2" value="100" {{ (old('question_2') == '100') ? 'checked' : ''}}  class="form-check-input" id="question_2">
                                </div>
                            </td>
                        </tr>
                        <!-- QUESTION 3 -->
                        <tr>
                            <td align="justify">La puntualidad del instructor fue</td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_3" value="0" {{ (old('question_3') == '0') ? 'checked' : ''}} class="form-check-input" id="question_3">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_3" value="50" {{ (old('question_3') == '50') ? 'checked' : ''}} class="form-check-input" id="question_3">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_3" value="60" {{ (old('question_3') == '60') ? 'checked' : ''}} class="form-check-input" id="question_3">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_3" value="80" {{ (old('question_3') == '80') ? 'checked' : ''}} class="form-check-input" id="question_3">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_3" value="95" {{ (old('question_3') == '95') ? 'checked' : ''}} class="form-check-input" id="question_3">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_3" value="100" {{ (old('question_3') == '100') ? 'checked' : ''}}  class="form-check-input" id="question_3">
                                </div>
                            </td>
                        </tr>
                        <!-- QUESTION 4 -->
                        <tr>
                            <td align="justify">La forma de utilizar el equipo y materiales de apoyo al curso fue</td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_4" value="0" {{ (old('question_4') == '0') ? 'checked' : ''}} class="form-check-input" id="question_4">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_4" value="50" {{ (old('question_4') == '50') ? 'checked' : ''}} class="form-check-input" id="question_4">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_4" value="60" {{ (old('question_4') == '60') ? 'checked' : ''}} class="form-check-input" id="question_4">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_4" value="80" {{ (old('question_4') == '80') ? 'checked' : ''}} class="form-check-input" id="question_4">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_4" value="95" {{ (old('question_4') == '95') ? 'checked' : ''}} class="form-check-input" id="question_4">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_4" value="100" {{ (old('question_4') == '100') ? 'checked' : ''}}  class="form-check-input" id="question_4">
                                </div>
                            </td>
                        </tr>
                        <!-- QUESTION 5 -->
                        <tr>
                            <td align="justify">La manera de aclarar las dudas planteadas por los participantes fue</td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_5" value="0" {{ (old('question_5') == '0') ? 'checked' : ''}} class="form-check-input" id="question_5">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_5" value="50" {{ (old('question_5') == '50') ? 'checked' : ''}} class="form-check-input" id="question_5">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_5" value="60" {{ (old('question_5') == '60') ? 'checked' : ''}} class="form-check-input" id="question_5">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_5" value="80" {{ (old('question_5') == '80') ? 'checked' : ''}} class="form-check-input" id="question_5">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_5" value="95" {{ (old('question_5') == '95') ? 'checked' : ''}} class="form-check-input" id="question_5">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_5" value="100" {{ (old('question_5') == '100') ? 'checked' : ''}}  class="form-check-input" id="question_5">
                                </div>
                            </td>
                        </tr>
                        <!-- QUESTION 6 -->
                        <tr>
                            <td align="justify">Las técnicas grupales utilizadas por el (la) instructor(a) fueron</td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_6" value="0" {{ (old('question_6') == '0') ? 'checked' : ''}} class="form-check-input" id="question_6">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_6" value="50" {{ (old('question_6') == '50') ? 'checked' : ''}} class="form-check-input" id="question_6">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_6" value="60" {{ (old('question_6') == '60') ? 'checked' : ''}} class="form-check-input" id="question_6">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_6" value="80" {{ (old('question_6') == '80') ? 'checked' : ''}} class="form-check-input" id="question_6">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_6" value="95" {{ (old('question_6') == '95') ? 'checked' : ''}} class="form-check-input" id="question_6">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_6" value="100" {{ (old('question_6') == '100') ? 'checked' : ''}}  class="form-check-input" id="question_6">
                                </div>
                            </td>
                        </tr>
                        <!-- QUESTION 7 -->
                        <tr>
                            <td align="justify">La forma de interesar a los participantes durante el curso fue</td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_7" value="0" {{ (old('question_7') == '0') ? 'checked' : ''}} class="form-check-input" id="question_7">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_7" value="50" {{ (old('question_7') == '50') ? 'checked' : ''}} class="form-check-input" id="question_7">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_7" value="60" {{ (old('question_7') == '60') ? 'checked' : ''}} class="form-check-input" id="question_7">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_7" value="80" {{ (old('question_7') == '80') ? 'checked' : ''}} class="form-check-input" id="question_7">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_7" value="95" {{ (old('question_7') == '95') ? 'checked' : ''}} class="form-check-input" id="question_7">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_7" value="100" {{ (old('question_7') == '100') ? 'checked' : ''}}  class="form-check-input" id="question_7">
                                </div>
                            </td>
                        </tr>
                        <!-- QUESTION 8 -->
                        <tr>
                            <td align="justify">La actitud del (de la) instructor(a) fue</td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_8" value="0" {{ (old('question_8') == '0') ? 'checked' : ''}} class="form-check-input" id="question_8">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_8" value="50" {{ (old('question_8') == '50') ? 'checked' : ''}} class="form-check-input" id="question_8">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_8" value="60" {{ (old('question_8') == '60') ? 'checked' : ''}} class="form-check-input" id="question_8">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_8" value="80" {{ (old('question_8') == '80') ? 'checked' : ''}} class="form-check-input" id="question_8">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_8" value="95" {{ (old('question_8') == '95') ? 'checked' : ''}} class="form-check-input" id="question_8">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_8" value="100" {{ (old('question_8') == '100') ? 'checked' : ''}}  class="form-check-input" id="question_8">
                                </div>
                            </td>
                        </tr>
                        <!-- QUESTION 9 -->
                        <tr>
                            <td align="justify">El manejo de las relaciones interpersonales del instructor(a) fue</td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_9" value="0" {{ (old('question_9') == '0') ? 'checked' : ''}} class="form-check-input" id="question_9">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_9" value="50" {{ (old('question_9') == '50') ? 'checked' : ''}} class="form-check-input" id="question_9">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_9" value="60" {{ (old('question_9') == '60') ? 'checked' : ''}} class="form-check-input" id="question_9">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_9" value="80" {{ (old('question_9') == '80') ? 'checked' : ''}} class="form-check-input" id="question_9">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_9" value="95" {{ (old('question_9') == '95') ? 'checked' : ''}} class="form-check-input" id="question_9">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_9" value="100" {{ (old('question_9') == '100') ? 'checked' : ''}}  class="form-check-input" id="question_9">
                                </div>
                            </td>
                        </tr>
                        <!-- QUESTION 10 -->
                        <tr>
                            <td align="justify">La calidad del trato humano hacia los participantes fue</td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_10" value="0" {{ (old('question_10') == '0') ? 'checked' : ''}} class="form-check-input" id="question_10">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_10" value="50" {{ (old('question_10') == '50') ? 'checked' : ''}} class="form-check-input" id="question_10">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_10" value="60" {{ (old('question_10') == '60') ? 'checked' : ''}} class="form-check-input" id="question_10">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_10" value="80" {{ (old('question_10') == '80') ? 'checked' : ''}} class="form-check-input" id="question_10">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_10" value="95" {{ (old('question_10') == '95') ? 'checked' : ''}} class="form-check-input" id="question_10">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_10" value="100" {{ (old('question_10') == '100') ? 'checked' : ''}}  class="form-check-input" id="question_10">
                                </div>
                            </td>
                        </tr>
                        <!-- QUESTION 11 -->
                        <tr>
                            <td align="justify">El manejo de las emociones en las sesiones por parte del instructor(a) fue</td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_11" value="0" {{ (old('question_11') == '0') ? 'checked' : ''}} class="form-check-input" id="question_11">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_11" value="50" {{ (old('question_11') == '50') ? 'checked' : ''}} class="form-check-input" id="question_11">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_11" value="60" {{ (old('question_11') == '60') ? 'checked' : ''}} class="form-check-input" id="question_11">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_11" value="80" {{ (old('question_11') == '80') ? 'checked' : ''}} class="form-check-input" id="question_11">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_11" value="95" {{ (old('question_11') == '95') ? 'checked' : ''}} class="form-check-input" id="question_11">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="question_11" value="100" {{ (old('question_11') == '100') ? 'checked' : ''}}  class="form-check-input" id="question_11">
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="row justify-content-end">
                        <div class="col-xl-1">
                            <input type="submit" id='save-btn' class="btn btn-outline-success" value='Guardar'>
                        </div>
                    </div>
        </form>
                </div>
            </div>
        </div>
        @endforeach
        @elseif($instructors->isEmpty())
            <div class="row">
            <div class="col-xl-6">
                No hay instructores asignados a la actividad.
            </div>
            </div>
        @endif
        
        </div>
    
  </div>
</div>

@endsection

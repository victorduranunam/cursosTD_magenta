@extends('layouts.app-participant')
@section('content')

<div class="card evaluation">
  <div class="card-header evaluation"><br>
    <h3>Evaluación <i class="bi bi-journals"></i></h3>
    <h4>{!! $data['participant_name'] !!}</h4>
    <h5>{!! $data['activity_name']!!}</h5>
  </div>
  
  @include('partials.messages')

  <div class="card-body evaluation"><br>
    <form method="POST" action="{!! route('store.activity-evaluation', $data['participant_id']) !!}">
      @csrf
      @method('post')
      <p>
        Le solicitamos contestar con veracidad y 
        proporcionar cualquier comentario adicional que resulte relavante, 
        gracias.
      </p>
      
      <div class="row">

        <div class="col-xl-12">
          {{-- SECTION: 1 --}}
          <table class="table table-hover">
            
            {{-- HEADER --}}
            <tr>
              <th width='45%'>1. DESAROLLO DE LA ACTIVIDAD</th>
              <th>Mala</th>
              <th>Regular</th>
              <th>Buena</th>
              <th>Muy buena</th>
              <th>Excelente</th>
            </tr>

            {{-- Question_1_1 --}}
            <tr>
              <td>
                Las actividades realizadas a lo largo {!! $data['activity_string_1'] !!}
                estuvieron vinculadas a los objetivos y contenidos de manera:
              </td>
              <td align="center">
                <div class="form-check">
                    <input required type="radio" name="question_1_1" value="50"  {!! old('question_1_1') == '50' ? 'checked' : '' !!} class="form-check-input" id="question_1_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                    <input type="radio" name="question_1_1" value="60"  {!! old('question_1_1') == '60' ? 'checked' : '' !!} class="form-check-input" id="question_1_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                    <input type="radio" name="question_1_1" value="80"  {!! old('question_1_1') == '80' ? 'checked' :  '' !!} class="form-check-input" id="question_1_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                    <input type="radio" name="question_1_1" value="95"  {!! old('question_1_1') == '95' ? 'checked' : ''  !!} class="form-check-input" id="question_1_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                    <input type="radio" name="question_1_1" value="100"  {!! old('question_1_1') == '100' ? 'checked' : ''  !!} class="form-check-input" id="question_1_1">
                </div>
              </td>
            </tr>

            {{-- Question_1_2 --}}
            <tr>
              <td>
                La suficiencia de los contenidos para el 
                logro de los objetivos propuestos fue:
              </td>
              <td align="center">
                  <div class="form-check">
                      <input required type="radio" name="question_1_2" value="50"  {!! old('question_1_2') == '50' ? 'checked'  : '' !!} class="form-check-input" id="question_1_2">
                  </div>
              </td>
              <td align="center">
                  <div class="form-check">
                      <input type="radio" name="question_1_2" value="60"  {!! old('question_1_2') == '60' ? 'checked' : '' !!} class="form-check-input" id="question_1_2">
                  </div>
              </td>
              <td align="center">
                  <div class="form-check">
                      <input type="radio" name="question_1_2" value="80"  {!! old('question_1_2') == '80' ? 'checked' : '' !!} class="form-check-input" id="question_1_2">
                  </div>
              </td>
              <td align="center">
                  <div class="form-check">
                      <input type="radio" name="question_1_2" value="95"  {!! old('question_1_2') == '95' ? 'checked' : ''  !!} class="form-check-input" id="materialUnchecked">
                  </div>
              </td>
              <td align="center">
                  <div class="form-check">
                      <input type="radio" name="question_1_2" value="100"  {!! old('question_1_2') == '100' ? 'checked' : ''  !!} class="form-check-input" id="materialUnchecked">
                  </div>
              </td>
            </tr>

            {{-- Question_1_3 --}}
            <tr>
              <td>
                La utilidad del material proporcionado 
                durante {!! $data['activity_string_2'] !!} fue:
              </td>
              <td align="center">
                <div class="form-check">
                    <input required type="radio" name="question_1_3" value="50"  {!! old('question_1_3') == '50' ? 'checked' : '' !!} class="form-check-input" id="question_1_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                    <input type="radio" name="question_1_3" value="60"  {!! old('question_1_3') == '60' ? 'checked' : '' !!} class="form-check-input" id="question_1_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                    <input type="radio" name="question_1_3" value="80"  {!! old('question_1_3') == '80' ? 'checked' : '' !!} class="form-check-input" id="question_1_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                    <input type="radio" name="question_1_3" value="95"  {!! old('question_1_3') == '95' ? 'checked' : ''  !!} class="form-check-input" id="question_1_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                    <input type="radio" name="question_1_3" value="100"  {!! old('question_1_3') == '100' ? 'checked' : ''  !!} class="form-check-input" id="question_1_3">
                </div>
              </td>
            </tr>

            {{-- Question_1_4 --}}
            <tr>
              <td>
                La motivación para el estudio independiente de las sesiones fue:
              </td>
              <td align="center">
                <div class="form-check">
                  <input required type="radio" name="question_1_4" value="50"  {!! old('question_1_4') == '50' ? 'checked' : '' !!} class="form-check-input" id="question_1_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_1_4" value="60"  {!! old('question_1_4') == '60' ? 'checked' : '' !!} class="form-check-input" id="question_1_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_1_4" value="80"  {!! old('question_1_4') == '80' ? 'checked' : '' !!} class="form-check-input" id="question_1_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_1_4" value="95"  {!! old('question_1_4') == '95' ? 'checked' : ''  !!} class="form-check-input" id="question_1_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_1_4" value="100"  {!! old('question_1_4') == '100' ? 'checked' : ''  !!} class="form-check-input" id="question_1_4">
                </div>
              </td>
            </tr>

            {{-- Question_1_5 --}}
            <tr>
              <td>
                La aplicación de los temas tratados en mi desarrollo es:
              </td>
              <td align="center">
                <div class="form-check">
                  <input required type="radio" name="question_1_5" value="50"  {!! old('question_1_5') == '50' ? 'checked' : '' !!} class="form-check-input" id="question_1_5">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_1_5" value="60"  {!! old('question_1_5') == '60' ? 'checked' : '' !!} class="form-check-input" id="question_1_5">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_1_5" value="80"  {!! old('question_1_5') == '80' ? 'checked' : '' !!} class="form-check-input" id="question_1_5">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_1_5" value="95"  {!! old('question_1_5') == '95' ? 'checked' : ''  !!} class="form-check-input" id="question_1_5">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_1_5" value="100"  {!! old('question_1_5') == '100' ? 'checked' : ''  !!} class="form-check-input" id="question_1_5">
                </div>
              </td>
            </tr>

          </table>

          {{-- SECTION: 2 --}}
          <table class="table table-hover">
            
            {{-- HEADER --}}
            <tr>
              <th width='45%' >2. AUTOEVALUACIÓN</th>
              <th>Mala</th>
              <th>Regular</th>
              <th>Buena</th>
              <th>Muy buena</th>
              <th>Excelente</th>
            </tr>

            {{-- Question_2_1 --}}
            <tr>
              <td>Mi puntualidad fue:</td>
              <td align="center">
                <div class="form-check">
                  <input required type="radio" name="question_2_1" value="50"  {!! old('question_2_1') == '50' ? 'checked' : '' !!} class="form-check-input" id="question_2_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_1" value="60"  {!! old('question_2_1') == '60' ? 'checked' : '' !!} class="form-check-input" id="question_2_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_1" value="80"  {!! old('question_2_1') == '80' ? 'checked' :  '' !!} class="form-check-input" id="question_2_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_1" value="95"  {!! old('question_2_1') == '95' ? 'checked' : ''  !!} class="form-check-input" id="question_2_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_1" value="100"  {!! old('question_2_1') == '100' ? 'checked' : ''  !!} class="form-check-input" id="question_2_1">
                </div>
              </td>
            </tr>

            {{-- Question_2_2 --}}
            <tr>
              <td>Mi participación fue:</td>
              <td align="center">
                <div class="form-check">
                  <input required type="radio" name="question_2_2" value="50"  {!! old('question_2_2') == '50' ? 'checked' : '' !!} class="form-check-input" id="question_2_2">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_2" value="60"  {!! old('question_2_2') == '60' ? 'checked' : '' !!} class="form-check-input" id="question_2_2">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_2" value="80"  {!! old('question_2_2') == '80' ? 'checked' :  '' !!} class="form-check-input" id="question_2_2">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_2" value="95"  {!! old('question_2_2') == '95' ? 'checked' : ''  !!} class="form-check-input" id="question_2_2">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_2" value="100"  {!! old('question_2_2') == '100' ? 'checked' : ''  !!} class="form-check-input" id="question_2_2">
                </div>
              </td>
            </tr>

            {{-- Question_2_3 --}}
            <tr>
              <td>Mi actitud durante {!! $data['activity_string_2'] !!} fue:</td>
              <td align="center">
                <div class="form-check">
                  <input required type="radio" name="question_2_3" value="50"  {!! old('question_2_3') == '50' ? 'checked' : '' !!} class="form-check-input" id="question_2_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_3" value="60"  {!! old('question_2_3') == '60' ? 'checked' : '' !!} class="form-check-input" id="question_2_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_3" value="80"  {!! old('question_2_3') == '80' ? 'checked' :  '' !!} class="form-check-input" id="question_2_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_3" value="95"  {!! old('question_2_3') == '95' ? 'checked' : ''  !!} class="form-check-input" id="question_2_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_3" value="100"  {!! old('question_2_3') == '100' ? 'checked' : ''  !!} class="form-check-input" id="question_2_3">
                </div>
              </td>
            </tr>

            {{-- Question_2_4 --}}
            <tr>
              <td>
                La forma en la que aprovecharé 
                {!! $data['activity_string_2'] !!} será:
              </td>
              <td align="center">
                <div class="form-check">
                  <input required type="radio" name="question_2_4" value="50"  {!! old('question_2_4') == '50' ? 'checked' : '' !!} class="form-check-input" id="question_2_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_4" value="60"  {!! old('question_2_4') == '60' ? 'checked' : '' !!} class="form-check-input" id="question_2_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_4" value="80"  {!! old('question_2_4') == '80' ? 'checked' :  '' !!} class="form-check-input" id="question_2_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_4" value="95"  {!! old('question_2_4') == '95' ? 'checked' : ''  !!} class="form-check-input" id="question_2_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_4" value="100"  {!! old('question_2_4') == '100' ? 'checked' : ''  !!} class="form-check-input" id="question_2_4">
                </div>
              </td>
            </tr>

          </table>

          {{-- SECTION: 3 --}}
          <table class="table table-hover">
            
            {{-- HEADER --}}
            <tr>
              <th width='45%'>3. DEPARTAMENTO DE LA ACTIVIDAD</th>
              <th>Mala</th>
              <th>Regular</th>
              <th>Buena</th>
              <th>Muy buena</th>
              <th>Excelente</th>
            </tr>

            {{-- Question_3_1 --}}
            <tr>
              <td>
                El departamento {!! $data['activity_string_1'] !!} desde su 
                difusión, inscripción, hasta el cierre fue:
              </td>
              <td align="center">
                <div class="form-check">
                  <input required type="radio" name="question_3_1" value="50"  {!! old('question_3_1') == '50' ? 'checked' : '' !!} class="form-check-input" id="question_3_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_1" value="60"  {!! old('question_3_1') == '60' ? 'checked' : '' !!} class="form-check-input" id="question_3_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_1" value="80"  {!! old('question_3_1') == '80' ? 'checked' :  '' !!} class="form-check-input" id="question_3_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_1" value="95"  {!! old('question_3_1') == '95' ? 'checked' : ''  !!} class="form-check-input" id="question_3_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_1" value="100"  {!! old('question_3_1') == '100' ? 'checked' : ''  !!} class="form-check-input" id="question_3_1">
                </div>
              </td>
            </tr>

            {{-- Question_3_2 --}}
            <tr>
              <td>
                La calidad del servicio en cuanto a 
                trato personal fue:
              </td>
              <td align="center">
                <div class="form-check">
                  <input required type="radio" name="question_3_2" value="50"  {!! old('question_3_2') == '50' ? 'checked' : '' !!} class="form-check-input" id="question_3_2">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_2" value="60"  {!! old('question_3_2') == '60' ? 'checked' : '' !!} class="form-check-input" id="question_3_2">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_2" value="80"  {!! old('question_3_2') == '80' ? 'checked' :  '' !!} class="form-check-input" id="question_3_2">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_2" value="95"  {!! old('question_3_2') == '95' ? 'checked' : ''  !!} class="form-check-input" id="question_3_2">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_2" value="100"  {!! old('question_3_2') == '100' ? 'checked' : ''  !!} class="form-check-input" id="question_3_2">
                </div>
              </td>
            </tr>

            {{-- Question_3_3 --}}
            <tr>
              <td>
                La calidad del servicio en cuanto a instalaciones, ventilación,
                ilumniación, mobiliario y equipo fue:
              </td>
              <td align="center">
                <div class="form-check">
                  <input required type="radio" name="question_3_3" value="50"  {!! old('question_3_3') == '50' ? 'checked' : '' !!} class="form-check-input" id="question_3_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_3" value="60"  {!! old('question_3_3') == '60' ? 'checked' : '' !!} class="form-check-input" id="question_3_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_3" value="80"  {!! old('question_3_3') == '80' ? 'checked' :  '' !!} class="form-check-input" id="question_3_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_3" value="95"  {!! old('question_3_3') == '95' ? 'checked' : ''  !!} class="form-check-input" id="question_3_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_3" value="100"  {!! old('question_3_3') == '100' ? 'checked' : ''  !!} class="form-check-input" id="question_3_3">
                </div>
              </td>
            </tr>

            {{-- Question_3_4 --}}
            <tr>
              <td>
                La limpieza, el orden y acústica de las instalaciones fue:
              </td>
              <td align="center">
                <div class="form-check">
                  <input required type="radio" name="question_3_4" value="50"  {!! old('question_3_4') == '50' ? 'checked' : '' !!} class="form-check-input" id="question_3_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_4" value="60"  {!! old('question_3_4') == '60' ? 'checked' : '' !!} class="form-check-input" id="question_3_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_4" value="80"  {!! old('question_3_4') == '80' ? 'checked' :  '' !!} class="form-check-input" id="question_3_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_4" value="95"  {!! old('question_3_4') == '95' ? 'checked' : ''  !!} class="form-check-input" id="question_3_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_4" value="100"  {!! old('question_3_4') == '100' ? 'checked' : ''  !!} class="form-check-input" id="question_3_4">
                </div>
              </td>
            </tr>
          </table>

          {{-- SECTION: 4 --}}
          <table class="table table-hover">
            
            {{-- HEADER --}}
            <tr>
              <th colspan="2">
                4. ¿RECOMENDARÍA 
                {!! strtoupper($data['activity_string_2']) !!} 
                A OTRAS PERSONAS?
              </th>
            </tr>

            {{-- Question_4 --}}
            <tr>
              <td>
                <div class="form-check">
                  <input required type="radio" name="question_4" value="1" {!! old('question_4') == '1' ? 'checked' : '' !!} class="form-check-input" id="question_4"> Sí
                </div>
              </td>
              <td >
                <div class="form-check">
                  <input type="radio" name="question_4" value="0" {!! old('question_4') == '0' ? 'checked' : '' !!} class="form-check-input" id="question_4"> No
                </div>
              </td>
            </tr>
          
          </table>

          {{-- SECTION: 5 --}}
          <table class="table table-hover">
            
            {{-- HEADER --}}
            <tr>
              <th colspan="4">
                5. ¿CÓMO SE ENTERÓ {!! strtoupper($data['activity_string_1']) !!}?
              </th>
            </tr>

            {{-- Question_5 --}}
            <tr>
              <td>
                <div class="form-check">
                  <input required onchange=evaluationFormRequiredQuestion5() name="question_5[]" type="checkbox" class="form-check-input" id="question_5_I" value="I" {!! old('question_5') == 'I' ? checked : '' !!}> Internet
                </div>
              </td>
              <td>
                <div class="form-check">
                  <input required onchange=evaluationFormRequiredQuestion5() name="question_5[]" type="checkbox" class="form-check-input" id="question_5_P" value="P" {!! old('question_5') == 'P' ? checked : '' !!}> Publicidad
                </div>
              </td>
              <td>
                <div class="form-check">
                  <input required onchange=evaluationFormRequiredQuestion5() name="question_5[]" type="checkbox" class="form-check-input" id="question_5_J" value="J" {!! old('question_5') == 'J' ? checked : '' !!}> Jefes de División
                </div>
              </td>
              <td>
                <div class="form-check">
                  <input required onchange=evaluationFormRequiredQuestion5() name="question_5[]" type="checkbox" class="form-check-input" id="question_5_O" value="O" {!! old('question_5') == 'O' ? checked : '' !!}> Otro
                </div>
              </td>
            </tr>
          
          </table>

          {{-- SECTION: 6 --}}
          <table class="table table-hover">
            
            {{-- HEADER --}}
            <tr>
              <th colspan="2">6. OPINIONES Y SUGERENCIAS</th>
            </tr>

            {{-- Question_6_1 --}}
            <tr>
              <td>Lo mejor {!! $data['activity_string_1'] !!} fue:</td>
              <td>
                <textarea maxlength="500" name="question_6_1" class="form-control" id="question_6_1" rows="2">{!! old('question_6_1') !!}</textarea>
              </td>
            </tr>

            {{-- Question_6_2 --}}
            <tr>
                <td>Sugerencias y recomendaciones: </td>
                <td>
                  <textarea maxlength="1500" name="question_6_2" class="form-control" id="question_6_2" rows="2">{!! old('question_6_2') !!}</textarea>
                </td>
            </tr>

            {{-- Question_6_3 --}}
            <tr>
              <td width="40%">
                ¿Qué otros cursos, talleres, curso-talleres, 
                seminarios, eventos, conferencias, foros o diplomados 
                le gustaría que se impartiesen o tomasen en cuenta?
              </td>
              <td>
                <textarea maxlength="300" name="question_6_3" class="form-control" id="question_6_3" rows="2">{!! old('question_6_3') !!}</textarea>
              </td>
            </tr>
          </table> 

          {{-- SECTION: 7 --}}
          <table class="table table-hover">
            
            {{-- HEADER --}}
            <tr>
              <th>7. ÁREA DE CONOCIMIENTO</th>
              <th></th>
              <th></th>
              <th></th>
            </tr>

            {{-- Question_7_1 --}}
            <tr>
              <td colspan="4">De las siguientes áreas de conocimiento ¿Cuál le interesa?</td>
            </tr>
            <tr>
              <td>
                <div class="form-check">
                  <input required onchange=evaluationFormRequiredQuestion7() name="question_7_1[]" type="checkbox" class="form-check-input" id="question_7_P" value="P" {!! old('question_7_1') == 'P' ? 'checked':'' !!}>Pedagogía
                </div>
              </td>
              <td>
                <div class="form-check">
                  <input required onchange=evaluationFormRequiredQuestion7() name="question_7_1[]" type="checkbox" class="form-check-input" id="question_7_H" value="H" {!! old('question_7_1') == 'H' ? 'checked':'' !!}>Desarrollo Humano
                </div>
              </td>
              <td>
                <div class="form-check">
                  <input required onchange=evaluationFormRequiredQuestion7() name="question_7_1[]" type="checkbox" class="form-check-input" id="question_7_C" value="C" {!! old('question_7_1') == 'C' ? 'checked':'' !!}>Computación
                </div>
              </td>
              <td>
                <div class="form-check">
                  <input required onchange=evaluationFormRequiredQuestion7() name="question_7_1[]" type="checkbox" class="form-check-input" id="question_7_O" value="O" {!! old('question_7_1') == 'O' ? 'checked':'' !!}>Otro
                </div>
              </td>
            </tr>

            {{-- Question_7_2 --}}
            <tr>
              <td width="40%">Acerca de esas áreas de conocimiento ¿Qué temáticas le interesan?</td>
              <td colspan="3">
                <textarea maxlength="300" name="question_7_2" class="form-control" id="question_7_2" rows="2">{!! old('question_7_2') !!}</textarea>
              </td>
            </tr>

          </table>

          {{-- SECTION: 8 --}}
          <table class="table table-hover">

            {{-- HEADER --}}
            <tr>
              <th>8. HORARIOS</th>
              <th></th>
            </tr>

            {{-- QUESTION_8_1 & QUESTION_8_2  --}}
            <tr>
              <td colspan="2">
                <label class="form-label">
                  ¿En qué horarios le gustaría que se impartiesen los cursos, 
                  talleres, curso-talleres, seminarios, conferencias, eventos,
                  diplomados o foros?
                </label>
              </td>
            </tr>
            <tr>
              <td>Horarios Semestrales: </td>
              <td>
                <input maxlength="300" name="question_8_1" type="text" class="form-control" id="question_8_1" placeholder="Ej. Lunes y Martes de 6 a 9 pm"  value="{!! old('question_8_1') !!}">
              </td>
            </tr>
            <tr>
              <td>Horarios Intersemestrales: </td>
              <td>
                <input maxlength="300" name="question_8_2" type="text" class="form-control" id="question_8_2" placeholder="Ej. Toda la semana" value="{!! old('question_8_2') !!}">
              </td>
            </tr>
          </table> 

        </div>

      </div>

      <div class="row">
        <div class="d-grid gap-2 col-xl-2" id='btn_save'>
          <button type="submit" id='save-btn' class="btn btn-outline-success"> Guardar </button>
        </div>
        <div class="col-xl-2">
          <a href="{!! route("view.participants", $data['activity_id']) !!}" class="btn btn-outline-warning">Cancelar</a>
        </div>
      </div>

    </form>
  </div>
</div>

@endsection

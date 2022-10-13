@extends('layouts.app')
@section('content')

<div class="card">
  <div class="card-header"><br>
      <h3>Editar Evaluación <i class="bi bi-journals"></i></h3>
      <h4>{!! $activity_evaluation->participant->name !!}</h4>
      <h5>{!! $activity_evaluation->participant->activity_name!!}</h5>
      <form method="POST" action="{!! route("delete.activity-evaluation", $activity_evaluation->activity_evaluation_id) !!}">
        @csrf
        @method('delete')
        <div class="row justify-content-end">
          <div class="col-1">
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $activity_evaluation->activity_evaluation_id !!}">Eliminar</button>
          </div>
        </div>
        <div class="modal fade" id="myModal{!! $activity_evaluation->activity_evaluation_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar evaluación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>¿Está seguro de eliminar la evaluación?
                  Esto la borrará de los reportes, siempre puede crear una nueva.
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cancelar</button>
                <input type="submit" value="Eliminar" class="btn btn-outline-danger">
              </div>
            </div>
          </div>
        </div>
      </form>
  </div>
  
  @include('partials.messages')

  <div class="card-body"><br>
    <form method="POST" action="{!! route('update.activity-evaluation', $activity_evaluation->activity_evaluation_id) !!}">
      @csrf
      @method('put')
      <p>Le solicitamos contestar con veracidad y 
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
                Las actividades de aprendizaje estuvieron 
                vinculadas a los objetivos y contenidos de manera:
              </td>
              <td align="center">
                <div class="form-check">
                    <input type="radio" name="question_1_1" value="50"  {!! $activity_evaluation->question_1_1 == '50' ? 'checked' : '' !!}  class="form-check-input" id="question_1_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                    <input type="radio" name="question_1_1" value="60"  {!! $activity_evaluation->question_1_1 == '60' ? 'checked' : '' !!}  class="form-check-input" id="question_1_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                    <input type="radio" name="question_1_1" value="80"  {!! $activity_evaluation->question_1_1 == '80' ? 'checked' :  '' !!}  class="form-check-input" id="question_1_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                    <input type="radio" name="question_1_1" value="95"  {!! $activity_evaluation->question_1_1 == '95' ? 'checked' : ''  !!}  class="form-check-input" id="question_1_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                    <input type="radio" name="question_1_1" value="100"  {!! $activity_evaluation->question_1_1 == '100' ? 'checked' : ''  !!}  class="form-check-input" id="question_1_1">
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
                      <input type="radio" name="question_1_2" value="50"  {!! $activity_evaluation->question_1_2 == '50' ? 'checked'  : '' !!}  class="form-check-input" id="question_1_2">
                  </div>
              </td>
              <td align="center">
                  <div class="form-check">
                      <input type="radio" name="question_1_2" value="60"  {!! $activity_evaluation->question_1_2 == '60' ? 'checked' : '' !!}  class="form-check-input" id="question_1_2">
                  </div>
              </td>
              <td align="center">
                  <div class="form-check">
                      <input type="radio" name="question_1_2" value="80"  {!! $activity_evaluation->question_1_2 == '80' ? 'checked' : '' !!}  class="form-check-input" id="question_1_2">
                  </div>
              </td>
              <td align="center">
                  <div class="form-check">
                      <input type="radio" name="question_1_2" value="95"  {!! $activity_evaluation->question_1_2 == '95' ? 'checked' : ''  !!}  class="form-check-input" id="materialUnchecked">
                  </div>
              </td>
              <td align="center">
                  <div class="form-check">
                      <input type="radio" name="question_1_2" value="100"  {!! $activity_evaluation->question_1_2 == '100' ? 'checked' : ''  !!}  class="form-check-input" id="materialUnchecked">
                  </div>
              </td>
            </tr>

            {{-- Question_1_3 --}}
            <tr>
              <td>
                La utilidad del material proporcionado 
                durante la actividad fue:
              </td>
              <td align="center">
                <div class="form-check">
                    <input type="radio" name="question_1_3" value="50"  {!! $activity_evaluation->question_1_3 == '50' ? 'checked' : '' !!}  class="form-check-input" id="question_1_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                    <input type="radio" name="question_1_3" value="60"  {!! $activity_evaluation->question_1_3 == '60' ? 'checked' : '' !!}  class="form-check-input" id="question_1_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                    <input type="radio" name="question_1_3" value="80"  {!! $activity_evaluation->question_1_3 == '80' ? 'checked' : '' !!}  class="form-check-input" id="question_1_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                    <input type="radio" name="question_1_3" value="95"  {!! $activity_evaluation->question_1_3 == '95' ? 'checked' : ''  !!}  class="form-check-input" id="question_1_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                    <input type="radio" name="question_1_3" value="100"  {!! $activity_evaluation->question_1_3 == '100' ? 'checked' : ''  !!}  class="form-check-input" id="question_1_3">                </div>
              </td>
            </tr>

            {{-- Question_1_4 --}}
            <tr>
              <td>
                La motivación para el estudio independiente de las sesiones fue:
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_1_4" value="50"  {!! $activity_evaluation->question_1_4 == '50' ? 'checked' : '' !!}  class="form-check-input" id="question_1_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_1_4" value="60"  {!! $activity_evaluation->question_1_4 == '60' ? 'checked' : '' !!}  class="form-check-input" id="question_1_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_1_4" value="80"  {!! $activity_evaluation->question_1_4 == '80' ? 'checked' : '' !!}  class="form-check-input" id="question_1_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_1_4" value="95"  {!! $activity_evaluation->question_1_4 == '95' ? 'checked' : ''  !!}  class="form-check-input" id="question_1_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_1_4" value="100"  {!! $activity_evaluation->question_1_4 == '100' ? 'checked' : ''  !!}  class="form-check-input" id="question_1_4">
                </div>
              </td>
            </tr>

            {{-- Question_1_5 --}}
            <tr>
              <td>
                La aplicación de los temas tratados en mi desarrollo 
                académico es:
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_1_5" value="50"  {!! $activity_evaluation->question_1_5 == '50' ? 'checked' : '' !!}  class="form-check-input" id="question_1_5">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_1_5" value="60"  {!! $activity_evaluation->question_1_5 == '60' ? 'checked' : '' !!}  class="form-check-input" id="question_1_5">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_1_5" value="80"  {!! $activity_evaluation->question_1_5 == '80' ? 'checked' : '' !!}  class="form-check-input" id="question_1_5">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_1_5" value="95"  {!! $activity_evaluation->question_1_5 == '95' ? 'checked' : ''  !!}  class="form-check-input" id="question_1_5">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_1_5" value="100"  {!! $activity_evaluation->question_1_5 == '100' ? 'checked' : ''  !!}  class="form-check-input" id="question_1_5">
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
                  <input type="radio" name="question_2_1" value="50"  {!! $activity_evaluation->question_2_1 == '50' ? 'checked' : '' !!}  class="form-check-input" id="question_2_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_1" value="60"  {!! $activity_evaluation->question_2_1 == '60' ? 'checked' : '' !!}  class="form-check-input" id="question_2_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_1" value="80"  {!! $activity_evaluation->question_2_1 == '80' ? 'checked' :  '' !!}  class="form-check-input" id="question_2_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_1" value="95"  {!! $activity_evaluation->question_2_1 == '95' ? 'checked' : ''  !!}  class="form-check-input" id="question_2_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_1" value="100"  {!! $activity_evaluation->question_2_1 == '100' ? 'checked' : ''  !!}  class="form-check-input" id="question_2_1">
                </div>
              </td>
            </tr>

            {{-- Question_2_2 --}}
            <tr>
              <td>Mi participación fue:</td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_2" value="50"  {!! $activity_evaluation->question_2_2 == '50' ? 'checked' : '' !!}  class="form-check-input" id="question_2_2">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_2" value="60"  {!! $activity_evaluation->question_2_2 == '60' ? 'checked' : '' !!}  class="form-check-input" id="question_2_2">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_2" value="80"  {!! $activity_evaluation->question_2_2 == '80' ? 'checked' :  '' !!}  class="form-check-input" id="question_2_2">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_2" value="95"  {!! $activity_evaluation->question_2_2 == '95' ? 'checked' : ''  !!}  class="form-check-input" id="question_2_2">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_2" value="100"  {!! $activity_evaluation->question_2_2 == '100' ? 'checked' : ''  !!}  class="form-check-input" id="question_2_2">
                </div>
              </td>
            </tr>

            {{-- Question_2_3 --}}
            <tr>
              <td>Mi actitud durante la actividad fue:</td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_3" value="50"  {!! $activity_evaluation->question_2_3 == '50' ? 'checked' : '' !!} class="form-check-input" id="question_2_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_3" value="60"  {!! $activity_evaluation->question_2_3 == '60' ? 'checked' : '' !!} class="form-check-input" id="question_2_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_3" value="80"  {!! $activity_evaluation->question_2_3 == '80' ? 'checked' :  '' !!} class="form-check-input" id="question_2_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_3" value="95"  {!! $activity_evaluation->question_2_3 == '95' ? 'checked' : ''  !!} class="form-check-input" id="question_2_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_3" value="100"  {!! $activity_evaluation->question_2_3 == '100' ? 'checked' : ''  !!} class="form-check-input" id="question_2_3">
                </div>
              </td>
            </tr>

            {{-- Question_2_4 --}}
            <tr>
              <td>
                La forma en la que aprovecharé esta
                actividad será:
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_4" value="50"  {!! $activity_evaluation->question_2_4 == '50' ? 'checked' : '' !!} class="form-check-input" id="question_2_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_4" value="60"  {!! $activity_evaluation->question_2_4 == '60' ? 'checked' : '' !!} class="form-check-input" id="question_2_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_4" value="80"  {!! $activity_evaluation->question_2_4 == '80' ? 'checked' :  '' !!} class="form-check-input" id="question_2_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_4" value="95"  {!! $activity_evaluation->question_2_4 == '95' ? 'checked' : ''  !!} class="form-check-input" id="question_2_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_2_4" value="100"  {!! $activity_evaluation->question_2_4 == '100' ? 'checked' : ''  !!} class="form-check-input" id="question_2_4">
                </div>
              </td>
            </tr>

          </table>

          {{-- SECTION: 3 --}}
          <table class="table table-hover">
            
            {{-- HEADER --}}
            <tr>
              <th width='45%'>3. COORDINACIÓN DE LA ACTIVIDAD</th>
              <th>Mala</th>
              <th>Regular</th>
              <th>Buena</th>
              <th>Muy buena</th>
              <th>Excelente</th>
            </tr>

            {{-- Question_3_1 --}}
            <tr>
              <td>
                La coordinación de la actividad desde su 
                difusión, inscripción, hasta el cierre fue:
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_1" value="50"  {!! $activity_evaluation->question_3_1 == '50' ? 'checked' : '' !!} class="form-check-input" id="question_3_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_1" value="60"  {!! $activity_evaluation->question_3_1 == '60' ? 'checked' : '' !!} class="form-check-input" id="question_3_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_1" value="80"  {!! $activity_evaluation->question_3_1 == '80' ? 'checked' :  '' !!} class="form-check-input" id="question_3_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_1" value="95"  {!! $activity_evaluation->question_3_1 == '95' ? 'checked' : ''  !!} class="form-check-input" id="question_3_1">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_1" value="100"  {!! $activity_evaluation->question_3_1 == '100' ? 'checked' : ''  !!} class="form-check-input" id="question_3_1">
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
                  <input type="radio" name="question_3_2" value="50"  {!! $activity_evaluation->question_3_2 == '50' ? 'checked' : '' !!} class="form-check-input" id="question_3_2">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_2" value="60"  {!! $activity_evaluation->question_3_2 == '60' ? 'checked' : '' !!} class="form-check-input" id="question_3_2">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_2" value="80"  {!! $activity_evaluation->question_3_2 == '80' ? 'checked' :  '' !!} class="form-check-input" id="question_3_2">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_2" value="95"  {!! $activity_evaluation->question_3_2 == '95' ? 'checked' : ''  !!} class="form-check-input" id="question_3_2">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_2" value="100"  {!! $activity_evaluation->question_3_2 == '100' ? 'checked' : ''  !!} class="form-check-input" id="question_3_2">
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
                  <input type="radio" name="question_3_3" value="50"  {!! $activity_evaluation->question_3_3 == '50' ? 'checked' : '' !!} class="form-check-input" id="question_3_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_3" value="60"  {!! $activity_evaluation->question_3_3 == '60' ? 'checked' : '' !!} class="form-check-input" id="question_3_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_3" value="80"  {!! $activity_evaluation->question_3_3 == '80' ? 'checked' :  '' !!} class="form-check-input" id="question_3_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_3" value="95"  {!! $activity_evaluation->question_3_3 == '95' ? 'checked' : ''  !!} class="form-check-input" id="question_3_3">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_3" value="100"  {!! $activity_evaluation->question_3_3 == '100' ? 'checked' : ''  !!} class="form-check-input" id="question_3_3">
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
                  <input type="radio" name="question_3_4" value="50"  {!! $activity_evaluation->question_3_4 == '50' ? 'checked' : '' !!} class="form-check-input" id="question_3_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_4" value="60"  {!! $activity_evaluation->question_3_4 == '60' ? 'checked' : '' !!} class="form-check-input" id="question_3_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_4" value="80"  {!! $activity_evaluation->question_3_4 == '80' ? 'checked' :  '' !!} class="form-check-input" id="question_3_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_4" value="95"  {!! $activity_evaluation->question_3_4 == '95' ? 'checked' : ''  !!} class="form-check-input" id="question_3_4">
                </div>
              </td>
              <td align="center">
                <div class="form-check">
                  <input type="radio" name="question_3_4" value="100"  {!! $activity_evaluation->question_3_4 == '100' ? 'checked' : ''  !!} class="form-check-input" id="question_3_4">
                </div>
              </td>
            </tr>
          </table>

          {{-- SECTION: 4 --}}
          <table class="table table-hover">
            
            {{-- HEADER --}}
            <tr>
              <th colspan="2">4. ¿RECOMENDARÍA LA ACTIVIDAD A OTROS PROFESORES?</th>
            </tr>

            {{-- Question_4 --}}
            <tr>
              <td>
                <div class="form-check">
                  <input type="radio" name="question_4" value="1" {!! $activity_evaluation->question_4 == '1' ? 'checked' : '' !!} class="form-check-input" id="question_4"> Sí
                </div>
              </td>
              <td >
                <div class="form-check">
                  <input type="radio" name="question_4" value="0" {!! $activity_evaluation->question_4 == '0' ? 'checked' : '' !!} class="form-check-input" id="question_4"> No
                </div>
              </td>
            </tr>
          
          </table>

          {{-- SECTION: 5 --}}
          <table class="table table-hover">
            
            {{-- HEADER --}}
            <tr>
              <th colspan="4">5. ¿CÓMO SE ENTERÓ DE LA ACTIVIDAD?</th>
            </tr>

            {{-- Question_5 --}}
            <tr>
              <td>
                <div class="form-check">
                  <input name="question_5[]" type="checkbox" class="form-check-input" id="question_5" value="I" {!! str_contains($activity_evaluation->question_5,'I') ? 'checked' : ''!!}> Internet
                </div>
              </td>
              <td>
                <div class="form-check">
                  <input name="question_5[]" type="checkbox" class="form-check-input" id="question_5" value="P" {!! str_contains($activity_evaluation->question_5,'P') ? 'checked' : ''!!}> Publicidad
                </div>
              </td>
              <td>
                <div class="form-check">
                  <input name="question_5[]" type="checkbox" class="form-check-input" id="question_5" value="J" {!! str_contains($activity_evaluation->question_5,'J') ? 'checked' : ''!!}> Jefes de División
                </div>
              </td>
              <td>
                <div class="form-check">
                  <input name="question_5[]" type="checkbox" class="form-check-input" id="question_5" value="O" {!! str_contains($activity_evaluation->question_5,'O') ? 'checked' : ''!!}> Otro
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
              <td>Lo mejor de la actividad fue: </td>
              <td>
                <textarea maxlength="500" name="question_6_1" class="form-control" id="question_6_1" rows="2">{!! $activity_evaluation->question_6_1 !!}</textarea>
              </td>
            </tr>

            {{-- Question_6_2 --}}
            <tr>
                <td>Sugerencias y recomendaciones: </td>
                <td>
                  <textarea maxlength="1500" name="question_6_2" class="form-control" id="question_6_2" rows="2">{!! $activity_evaluation->question_6_2 !!}</textarea>
                </td>
            </tr>

            {{-- Question_6_3 --}}
            <tr>
              <td width="40%">¿Qué otras actividades le gustaría que se impartiesen o tomasen en cuenta?</td>
              <td>
                <textarea maxlength="300" name="question_6_3" class="form-control" id="question_6_3" rows="2">{!! $activity_evaluation->question_6_3 !!}</textarea>
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
                  <input name="question_7_1[]" type="checkbox" class="form-check-input" id="question_7_1" value="P" {!! str_contains($activity_evaluation->question_7_1,'P') ? 'checked' :'' !!}>Pedagogía
                </div>
              </td>
              <td>
                <div class="form-check">
                  <input name="question_7_1[]" type="checkbox" class="form-check-input" id="question_7_1" value="H" {!! str_contains($activity_evaluation->question_7_1,'H') ? 'checked' :'' !!}>Desarrollo Humano
                </div>
              </td>
              <td>
                <div class="form-check">
                  <input name="question_7_1[]" type="checkbox" class="form-check-input" id="question_7_1" value="C" {!! str_contains($activity_evaluation->question_7_1,'C') ? 'checked' :'' !!}>Cómputación
                </div>
              </td>
              <td>
                <div class="form-check">
                  <input name="question_7_1[]" type="checkbox" class="form-check-input" id="question_7_1" value="O" {!! str_contains($activity_evaluation->question_7_1,'O') ? 'checked' :'' !!}>Otro
                </div>
              </td>
            </tr>

            {{-- Question_7_2 --}}
            <tr>
              <td width="40%">Acerca de esas áreas de conocimiento ¿Qué temáticas le interesan?</td>
              <td colspan="3">
                <textarea maxlength="300" name="question_7_2" class="form-control" id="question_7_2" rows="2">{!! $activity_evaluation->question_7_2 !!}</textarea>
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
                <label class="form-label">¿En qué horarios le gustaría que se impartiesen los cursos, talleres, seminarios o diplomados?</label>
              </td>
            </tr>
            <tr>
              <td>Horarios Semestrales: </td>
              <td>
                <input maxlength="300" name="question_8_1" type="text" class="form-control" id="question_8_1" placeholder="Ej. Lunes y Martes de 6 a 9 pm"  value="{!! $activity_evaluation->question_8_1 !!}">
              </td>
            </tr>
            <tr>
              <td>Horarios Intersemestrales: </td>
              <td>
                <input maxlength="300" name="question_8_2" type="text" class="form-control" id="question_8_2" placeholder="Ej. Toda la semana" value="{!! $activity_evaluation->question_8_2 !!}">
              </td>
            </tr>
          </table> 

        </div>

      </div>

      <div class="row">
        <div class="col-xl-2" id='btn_save'>
          <input type="submit" id='save-btn' class="btn btn-outline-success" value='Guardar'>
        </div>
        <div class="col-xl-2">
          <a href="{!! route("view.participants",$activity_evaluation->participant->activity_id) !!}" class="btn btn-outline-warning">Cancelar</a>
        </div>
      </div>

    </form>
  </div>
</div>

@endsection

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reporte de Evaluación | MAGESTIC </title>
</head>

<style>
.img-escudo{
  width: 63%;
}
.mg{
  width: 27%;
  border-bottom-right-radius: 20%;
  border-bottom-left-radius: 20%;
}
.left-header,.right-header{
  width: 30%;
  position:relative;
}
.right-header{
  float:right;
}
.center-header{
  width:100%;
  padding-left: 6%;
  align:center;
  line-height:5px;
}
</style>

<body>

  <div id='header'>

    <div class="left-header">
      <img class="img-escudo mg" src={!! public_path('img/logo-magestic.png') !!} align=left>
    </div>

    <div class="right-header">
      <img class="img-escudo" src={!! public_path('img/unica2.png') !!} align=right>
    </div>

    <div class="center-header">
      <h2>MAGESTIC</h2>
      <h3>Facultad de Ingeniería</h3>
      <h3>Reporte de Evaluación</h3> 
    </div>

    <hr>

  </div>

  <div>
    <h1> 1. DATOS GENERALES DE LA ACTIVIDAD</h1>
    <table>
      <tr>
        <th>
          Nombre
        </th>
        <td>
          {!! $activity->name !!}
        </td>
      </tr>
      <tr>
        <th>
          Clave de grupo
        </th>
        <td>
          {!! $activity->key.'-'.$activity->activity_id!!}
        </td>
        <th>
          Tipo
        </th>
        <td>
          {!! $activity_catalogue->getType() !!}
        </td>
      </tr>
      <tr>
        <th>Horario</th>
        <td>{!! $activity->start_time !!} a {!! $activity->end_time !!}</td>
        <th>Lugar</th>
        <td>{!! $activity->venue_name !!}</td>
      </tr>
      <tr>
        <th>Fecha</th>
        <td>{!! $activity->manual_date !!}</td>
        <th>Horas</th>
        <td>{!! $activity->hours !!}</td>
      </tr>
    </table>
    <table>
      <tr>
        <th>Capacidad Máxima:</th>
        <td>{!! $activity->max_quota !!}</td>
      </tr>
    </table>
  </div>
  <div>
    <h1>2. REGISTRO DE PARTICIPANTES</h1>
    <table>
      <tr>
        <th>Participantes inscritos:</th>
        <td>{!! $count_participants !!}</td>
        <th>Participantes que asistieron:</th>
        <td>{!! $count_attendance !!}</td>
      </tr>
      <tr>
        <th>Participantes que acreditaron:</th>
        <td>{!! $count_accredited !!}</td>
        <th>Evaluaciones respondidas:</th>
        <td>{!! $count_evaluations !!}</td>
      </tr>
    </table>
    <table>
      <tr>
        <th>Factor de ocupación:</th>
        <td>{!! $occupance_factor !!}%</td>
        <th>Factor de recomendación:</th>
        <td>{!! $recommendation_factor !!}%</td>
      </tr>
      <tr>
        <th>Factor de acreditación:</th>
        <td>{!! $accredited_factor !!}%</td>
        <th>Factor de calidad de actividad:</th>
        <td>{!! $quality_factor !!}%</td>
      </tr>
    </table>

    <div>
      <h1> 3. INSTRUCTORES</h1>

      <table>
        <tr>
          <th>
            NOMBRE
          </th>
          <th>
            PROMEDIO
          </th>
          <th>
            NÚMERO DE EVALUACIONES
          </th>
        </tr>
        @foreach($instructors as $i)
          @php
            $average = 0;
            $evaluations_count = 0;
          @endphp
          @foreach($i['evaluations'] as $e)
            @if($e['instructor_evaluation_id'])
              @php
                $evaluations_count++;
                $average += $e['average'] ;
              @endphp
            @endif
          @endforeach
          <tr>
            <td>
              {!! $i['name'].' '.$i['last_name'].' '.$i['mothers_last_name'] !!}
            </td>
            @if($evaluations_count)
              <td>
                {!! round($average/($evaluations_count),2) . '%' !!}
              </td>
              <td>
                {!! $evaluations_count !!}
              </td>
            @else
              <td colspan="2">
                Sin evaluaciones
              </td>
            @endif
          </tr>
        @endforeach
      </table>

    </div>

    <div>
      <h1>4. SUGERENCIAS Y RECOMENDACIONES</h1>

      <table>
        <tr>
          <th>Lo mejor de la actividad</th>
          <th>Sugerencias y Recomendaciones</th>
          <th>Otros intereses</th>
        </tr>
        @foreach($suggestions as $s)
        <tr>
          <td>{!! $s['best'] !!}</td>
          <td>{!! $s['suggestions'] !!}</td>
          <td>{!! $s['others'] !!}</td>
        </tr>
        @endforeach
      </table>

    </div>

    <div>
      <h1>5. AREAS SOLICITADAS</h1>

      <table>
        <tr>
          <td>Pedagógica: {!! $areas_count['P'] !!}</td>
          <td>Desarrollo Humano: {!! $areas_count['H'] !!}</td>
          <td>Computación: {!! $areas_count['C'] !!}</td>
          <td>Otras: {!! $areas_count['O'] !!}</td>
        </tr>
        @foreach ($subjects as $s)
          <tr>
            <td colspan="4">{!! $s !!}</td>
          </tr>
        @endforeach
      </table>

    </div>

    <div>
      <h1>6. HORARIOS PROPUESTOS</h1>

      <table>
        <tr>
          <th>Horarios semestrales</th>
          <th>Horarios intersemestrales</th>
        </tr>
        @foreach($schedules as $s)
          <tr>
            <td>{!! $s['sem'] !!}</td>
            <td>{!! $s['int'] !!}</td>
          </tr>
        @endforeach
      </table>

    </div>
  </div>
</body>
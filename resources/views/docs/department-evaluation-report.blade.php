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
      <h2>{!! $department_name !!}</h2>
      <h3>Reporte de Evaluación</h3> 
      <h3>{!! $period !!}</h3>
    </div>

    <hr>

  </div>

  <div>
    <h1> 1. ACTIVIDADES IMPARTIDAS DURANTE EL PERIODO</h1>
    <table>
      <th>
        Nombre
      </th>
      <th>
        Clave de grupo
      </th>
      @foreach ($activities as $activity)
        <tr>
          <td>
            {!! $activity->name !!}
          </td>
          <td>
            {!! $activity->key !!}-{!! $activity->activity_id !!}
          </td>
        </tr>
      @endforeach
    </table>
    <table>
      <tr>
        <td>Capacidad Máxima:</td>
        <td>{!! $activities->max_quota !!}</td>
        <td>Total de horas:</td>
        <td>{!! $activities->hours !!}</td>
      </tr>
    </table>
  </div>
  <div>
    <h1>2. REGISTRO DE PARTICIPANTES</h1>
    <table>
      <tr>
        <td>Número de participantes inscritos:</td>
        <td>{!! $count_participants !!}</td>
        <td>Número de participantes que asistieron:</td>
        <td>{!! $count_attendance !!}</td>
        <td>Número de participantes que acreditaron:</td>
        <td>{!! $count_accredited !!}</td>
        <td>Número de participantes que contestaron evaluación sobre actividad:</td>
        <td>{!! $count_evaluations !!}</td>
      </tr>
    </table>
    <table>
      <tr>
        <td>Factor de ocupación:</td>
        <td>{!! $occupance_factor !!}%</td>
        <td>Factor de recomendación:</td>
        <td>{!! $recommendation_factor !!}%</td>
        <td>Factor de acreditación:</td>
        <td>{!! $accredited_factor !!}%</td>
        <td>Factor de calidad de actividades:</td>
        <td>{!! $activity_quality_factor !!}%</td>
        <td>Factor de calidad del departmento:</td>
        <td>{!! $department_quality_factor !!}%</td>
      </tr>
    </table>
    <table>
      <tr>
        <th>INSTRUCTORES</th>
      </tr>
      <tr>
        <th>
          ACTIVIDAD
        </th>
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
            {!! $i['activity_key'] !!}
          </td>
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
    <table>
      <tr>
        <th colspan="3">SUGERENCIAS Y RECOMENDACIONES</th>
      </tr>
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
    <table>
      <tr>
        <th colspan="4"> AREAS SOLICITADAS</th>
      </tr>
      <tr>
        <td>Pedagógica {!! $areas_count['P'] !!}</td>
        <td>Desarrollo Humano {!! $areas_count['H'] !!}</td>
        <td>Computación {!! $areas_count['C'] !!}</td>
        <td>Otras {!! $areas_count['O'] !!}</td>
      </tr>
      @foreach ($subjects as $s)
        <tr>
          <td colspan="4">{!! $s !!}</td>
        </tr>
      @endforeach
    </table>
    <table>
      <tr>
        <th colspan="2">HORARIOS PROPUESTOS</th>
      </tr>
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
</body>
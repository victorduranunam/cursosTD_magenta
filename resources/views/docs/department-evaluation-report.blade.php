<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reporte de Evaluación | MAGENTA </title>
</head>

<style>
  html{
	width:100%;
  height: 100%;
}
body{
  font-family: Arial, Helvetica, sans-serif;
  font-size: 13pt;
}
#header{
  width: 100%;
  text-align:center;
  line-height:10px;
  display:inline-block;
  font-size: 15px;
}
.img-escudo{
  width: 88%;
}
.mg{
  width: 38%;
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
table, th, td{
  border: 1pt solid lightgray;
}
table{
  width:100%;
  border-collapse: collapse;
}
th {
  text-align: left;
  background: lightgray;
}
.center{
  text-align:center;

}
</style>

<body>

  <div id='header'>

    <div class="left-header">
      <img class="img-escudo mg" src={!! public_path('img/logo-magenta.png') !!} align=left>
    </div>

    <div class="right-header">
      <img class="img-escudo" src={!! public_path('img/unica2.png') !!} align=right>
    </div>

    <div class="center-header">
      <h3>MAGENTA</h3>
      <h3>Facultad de Ingeniería</h3>
      <h3>{!! $department_name !!}</h3>
      <h3>Reporte de Evaluación</h3> 
      <h3>{!! $period !!}</h3>
    </div>

    <hr>

  </div>

  <div>
    <h4> 1. ACTIVIDADES IMPARTIDAS DURANTE EL PERIODO</h4>
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
        <td class="center">{!! $activities->max_quota !!}</td>
        <td>Total de horas:</td>
        <td class="center">{!! $activities->hours !!}</td>
      </tr>
    </table>
  </div>
  <br>
  <div>
    <h4>2. REGISTRO DE PARTICIPANTES</h4>
    <table>
      <tr>
        <th class="center">Inscritos:</th>
        <th class="center">Asistentes:</th>
        <th class="center">Acreditados:</th>
        <th class="center">Total Evaluaciones:</th>
      </tr>
      <tr>
        <td class="center">{!! $count_participants !!}</td>
        <td class="center">{!! $count_attendance !!}</td>
        <td class="center">{!! $count_accredited !!}</td>
        <td class="center">{!! $count_evaluations !!}</td>
      </tr>
    </table>
    <br><br>
    <h4> 3. FACTORES DE EVALUACIÓN</h4>
    <table>
      <tr>
        <th class="center" width="20%">Ocupación:</th>
        <th class="center" width="20%">Recomendación:</th>
        <th class="center" width="20%">Acreditación:</th>
        <th class="center" width="20%">Calidad de actividades:</th>
        <th class="center" width="20%">Calidad del departmento:</th>
      </tr>
      <tr>
        <td class="center" width="20%">{!! $occupance_factor !!}%</td>
        <td class="center" width="20%">{!! $recommendation_factor !!}%</td>
        <td class="center" width="20%">{!! $accredited_factor !!}%</td>
        <td class="center" width="20%">{!! $activity_quality_factor !!}%</td>
        <td class="center" width="20%">{!! $department_quality_factor !!}%</td>
      </tr>
    </table>
    <br><br>
    <table>
      <tr>
        <th colspan="4">4. INSTRUCTORES</th>
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
    <br>
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
    <br><br>
    <table>
      <tr>
        <th colspan="4"> AREAS SOLICITADAS</th>
      </tr>
      <tr>
        <td><b>Pedagógica:</b> {!! $areas_count['P'] !!}</td>
        <td><b>Desarrollo Humano:</b> {!! $areas_count['H'] !!}</td>
        <td><b>Computación:</b> {!! $areas_count['C'] !!}</td>
        <td><b>Otras:</b> {!! $areas_count['O'] !!}</td>
      </tr>
      @foreach ($subjects as $s)
        <tr>
          <td colspan="4">{!! $s !!}</td>
        </tr>
      @endforeach
    </table>
    <br><br>
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
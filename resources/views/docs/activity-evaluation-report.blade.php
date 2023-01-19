<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reporte de Evaluación | MAGESTIC </title>
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

table{
  width:100%;
  border-collapse: collapse;
}
.table-format table, .table-format th, .table-format td{
  border: 1pt solid lightgray;
}

.table-format th{
  text-align: left;
  background: lightgray;
}
.participant-table th{
  width:40%;
  text-align:left;
}
.participant-table td{
  width:10%;
  text-align:left;
}
.center{
  text-align:center;
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
    <h4> 1. DATOS GENERALES DE LA ACTIVIDAD</h4>
    <table class="no-style">
      <tr>
        <td>
          <b>Nombre</b> 
        </td>
        <td colspan="3">
          {!! $activity->name !!}
        </td>
      </tr>
      <tr>
        <td>
          <b>Clave de grupo</b>
        </td>
        <td>
          {!! $activity->key.'-'.$activity->activity_id!!}
        </td>
        <td>
          <b>Tipo</b>
        </td>
        <td>
          {!! $activity_catalogue->getType() !!}
        </td>
      </tr>
      <tr>
        <td><b>Horario</b></td>
        <td>{!! $activity->start_time !!} a {!! $activity->end_time !!}</td>
        <td><b>Lugar</b></td>
        <td>{!! $activity->venue_name !!}</td>
      </tr>
      <tr>
        <td><b>Fecha</b></td>
        <td>{!! $activity->manual_date !!}</td>
        <td><b>Horas</b></td>
        <td>{!! $activity->hours !!}</td>
      </tr>
    </table>
    <table>
      <tr>
        <td width="30%"><b>Capacidad Máxima:</b></td>
        <td>{!! $activity->max_quota !!}</td>
      </tr>
    </table>
  </div>
  <div>
    <h4>2. REGISTRO DE PARTICIPANTES</h4>
    <table class="participant-table">
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
      <h4> 3. INSTRUCTORES</h4>

      <table class="table-format">>
        <tr>
          <th>
            NOMBRE
          </th>
          <th style="text-align:center;">
            PROMEDIO
          </th>
          <th style="text-align:center;">
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
              <td class="center">
                {!! round($average/($evaluations_count),2) . '%' !!}
              </td>
              <td class="center">
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
      <h4>4. SUGERENCIAS Y RECOMENDACIONES</h4>

      <table class="table-format">
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
      <h4>5. AREAS SOLICITADAS</h4>

      <table class="table-format">
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

    </div>

    <div>
      <h4>6. HORARIOS PROPUESTOS</h4>

      <table class="table-format">
        <tr>
          <th class="center">Horarios semestrales</th>
          <th class="center">Horarios intersemestrales</th>
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
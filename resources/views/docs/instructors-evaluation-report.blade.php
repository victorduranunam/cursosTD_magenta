<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reporte de Instructores | MAGESTIC </title>
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
      <h3>Reporte de Instructores</h3> 
      <h4> {!! $activity_catalogue->name !!} </h4>
    </div>

    <hr>

  </div>

  <div>

    <h1> DESEMPEÑO DE LOS INSTRUCTORES </h1>

    @foreach($instructors as $instructor)
      <h2> {!! $instructor['name'].' '.$instructor['last_name'].' '.$instructor['mothers_last_name'] !!} </h2>
        <table>

          @if($instructor['counters']['evaluations'] == 0)

            <tr>
              <th>Criterio de Experiencia: </th>
              <td>Sin Evaluaciones</td>
              <th>Criterio de Planeación: </th>
              <td>Sin Evaluaciones</td>
            </tr>
            <tr>
              <th>Criterio de Puntualidad: </th>
              <td>Sin Evaluaciones</td>
              <th>Criterio de Material Didáctico: </th>
              <td>Sin Evaluaciones</td>
            </tr>
            <tr>
              <th>Criterio de Atención: </th>
              <td>Sin Evaluaciones</td>
              <th>Criterio de Control: </th>
              <td>Sin Evaluaciones</td>
            </tr>
            <tr>
              <th>Criterio de Interés: </th>
              <td>Sin Evaluaciones</td>
              <th>Criterio de Actitud: </th>
              <td>Sin Evaluaciones</td>
            </tr>

          @else

            <tr>
              <th>Criterio de Experiencia: </th>
              <td>{!! round($instructor['counters']['experience']/$instructor['counters']['evaluations'],2).'%' !!}</td>
              <th>Criterio de Planeación: </th>
              <td>{!! round($instructor['counters']['planification']/$instructor['counters']['evaluations'],2).'%' !!}</td>
            </tr>
            <tr>
              <th>Criterio de Puntualidad: </th>
              <td>{!! round($instructor['counters']['puntuality']/$instructor['counters']['evaluations'],2).'%' !!}</td>
              <th>Criterio de Material Didáctico: </th>
              <td>{!! round($instructor['counters']['materials']/$instructor['counters']['evaluations'],2).'%' !!}</td>
            </tr>
            <tr>
              <th>Criterio de Atención: </th>
              <td>{!! round($instructor['counters']['resolution']/$instructor['counters']['evaluations'],2).'%' !!}</td>
              <th>Criterio de Control: </th>
              <td>{!! round($instructor['counters']['control']/$instructor['counters']['evaluations'],2).'%' !!}</td>
            </tr>
            <tr>
              <th>Criterio de Interés: </th>
              <td>{!! round($instructor['counters']['interest']/$instructor['counters']['evaluations'],2).'%' !!}</td>
              <th>Criterio de Actitud: </th>
              <td>{!! round($instructor['counters']['attitude']/$instructor['counters']['evaluations'],2).'%' !!}</td>
            </tr>

          @endif

        </table>
    @endforeach

    </div>
  </div>
</body>
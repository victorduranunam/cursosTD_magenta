<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reporte de Criterio de Aceptación | MAGENTA </title>
</head>
<style>
html{
	width:100%;
  height: 100%;
}
body{
  font-family: Arial, Helvetica, sans-serif;
}
#header{
  width: 100%;
  text-align:center;
  line-height:10px;
  display:inline-block;
  font-size: 15px;
}
.img-escudo{
  width: 90%;
}
.mg{
  width: 40%;
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
  padding-left:5%;
  align:center;
  line-height:5px;
}  

table{
  width: 90%;
}
table, th, td{
  border: 1pt solid black;
  border-collapse: collapse;
  margin: 20px;
}

th{
  text-align:center;
  font-size: 15px;
  padding: 5px;
  background-color: lightgray;
  width: 30%;
}

td{
  text-align:left;
  font-size: 15px;
  padding: 5px;
  width: 30%;
}
.activity{
  font-size: 16px;
  text-align: left;
  font-style: italic;
}

</style>
<body>
  <div id="header">
    <div class="left-header">
      <img class="img-escudo mg" src={!! public_path('img/logo-magenta.png') !!} align=left>
    </div>

    <div class="right-header">
      <img class="img-escudo" src={!! public_path('img/unica2.png') !!} align=right>
    </div>

    <div class="center-header">
      <h2>MAGENTA</h2>
      <h3>Facultad de Ingenierí­a</h3>
      <h3>Criterio de Aceptación del Departamento</h3>
      <h3>{!! $department->name !!}</h3>
      <h3>{!! $year !!}</h3>
    </div>
  </div>
  <hr>
  <div id="body">
    <table>
      <tr>
        <th class="activity" colspan="2">2022-1s</th>
        @if($department->period_1s->avg == 0)
          <th class="activity">Sin evaluaciones</th>
        @else
          <th class="activity">Criterio: {!! $department->period_1s->avg !!}</th>
        @endif
      </tr>
      @foreach($department->period_1s->activities as $activity)
      <tr>
        <td>{!! $activity->key !!}</td>
        <td>Criterio: {!! $activity->avg !!}</td>
        <td>Encuestas: {!! $activity->evals->count() !!}</td>
      </tr>
      @endforeach
    </table>
    <table>
      <tr>
        <th class="activity" colspan="2">2022-1i</th>
        @if($department->period_1i->avg == 0)
          <th class="activity">Sin evaluaciones</th>
        @else
          <th class="activity">Criterio: {!! $department->period_1i->avg !!}</th>
        @endif
      </tr>
      @foreach($department->period_1i->activities as $activity)
      <tr>
        <td>{!! $activity->key !!}</td>
        <td>Criterio: {!! $activity->avg !!}</td>
        <td>Encuestas: {!! $activity->evals->count() !!}</td>
      </tr>
      @endforeach
    </table>
    <table>
      <tr>
        <th class="activity" colspan="2">2022-2s</th>
        @if($department->period_2s->avg == 0)
          <th class="activity">Sin evaluaciones</th>
        @else
          <th class="activity">Criterio: {!! $department->period_2s->avg !!}</th>
        @endif
      </tr>
      @foreach($department->period_2s->activities as $activity)
      <tr>
        <td>{!! $activity->key !!}</td>
        <td>Criterio: {!! $activity->avg !!}</td>
        <td>Encuestas: {!! $activity->evals->count() !!}</td>
      </tr>
      @endforeach
    </table>
    <table>
      <tr>
        <th class="activity" colspan="2">2022-2i</th>
        @if($department->period_2i->avg == 0)
          <th class="activity">Sin evaluaciones</th>
        @else
          <th class="activity">Criterio: {!! $department->period_2i->avg !!}</th>
        @endif
      </tr>
      @foreach($department->period_2i->activities as $activity)
      <tr>
        <td>{!! $activity->key !!}</td>
        <td>Criterio: {!! $activity->avg !!}</td>
        <td>Encuestas: {!! $activity->evals->count() !!}</td>
      </tr>
      @endforeach
    </table>
    <div>
      <p>Criterio anual del departamento: {!! $department->avg !!}</p>
      <p>*No se toman en cuenta aquellas actividades sin evaluaciones.</p>
    </div>
  </div>
</body>
</html>
<!DOCTYPE html>

<html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Reporte General De Actividades {!! $year.$num.$type !!} </title>
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
th, td{
  vertical-align:top;
  border-bottom: 5pt solid white;
  border-left: 3pt solid white;
  font-size: 13px;
}
.rubro{
  text-align: left;
  width:auto;
}
.contenido{
  text-align:center;
  width:auto;
}
</style>
  <body>

    <div>
      <div id='header'>

        <div class="left-header">
          <img class="img-escudo mg" src={!! public_path('img/logo-magenta.png') !!} align=left>
        </div>

        <div class="right-header">
          <img class="img-escudo" src={!! public_path('img/unica2.png') !!} align=right>
        </div>

        <div class="center-header">
          <h2>MAGENTA</h2>
          <h3>Facultad de Ingeniería</h3>
          <h3>Reporte General de Actividades</h3> 
          <h3>{!! $year.'-'.$num.$type !!}</h3>
        </div>
        <hr>
      </div>

      <div id="body">
        <table>
          <tr>
            <th class="rubro">Clave</th>
            <th class="rubro">Nombre de la actividad</th>
            <th class="rubro">Instructor(es)</th>
            <th class="contenido">Horas</th>
            <th class="contenido">Horario</th>
            <th class="rubro">Fechas</th>
            <th class="rubro">Sede</th>
            <th class="contenido">Cupo</th>
          </tr>
          @foreach($activities as $activity)
            <tr>
              <td>{!! $activity->key !!}</td>
              <td>{!! $activity->name !!}</td>
              <td>{!! $activity->instructors !!}</td>
              <td class="contenido">{!! $activity->hours !!}</td>
              <td class="contenido">{!! date('H:i',strtotime($activity->start_time)) !!}-{!! date('H:i',strtotime($activity->end_time)) !!}</td>
              <td>{!! $activity->manual_date !!}</td>
              <td>{!! $activity->venue !!}</td>
              <td class="contenido">{!! $activity->min_quota !!}-{!! $activity->max_quota !!}</td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </body>

</html>


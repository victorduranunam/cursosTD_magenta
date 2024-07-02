<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Hoja de Asistencia | MAGENTA</title>
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
  width: 50%;
}
.mg{
  width: 21%;
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
  padding-left:4%;
  align:center;
  line-height:5px;
}
#t1{
  font-size: 12px;
}
th, td{
  vertical-align:top;
  border-bottom: 5pt solid white;
  border-left: 8pt solid white;
}
.rubro{
  text-align: left;
  width:auto;
}
.contenido{
  width:auto;
}
.names{
  width:310px;
}
#participants{
  text-align: left;
  font-size: 12px;
  border-collapse: separate;
  border-spacing: 0px;
}
.cell{
  border: 1px solid black;
}
.cells{
  width:60px;
  height:20px;
}
.show{
  empty-cells: show;
}
.hide{
  empty-cells: hide;
}
</style>
<body>
  <div>
    <div id='header'>
      <div class="left-header">
        <img class="img-escudo mg" src={!! public_path('img/logo-MAGENTA.png') !!} align=left>
      </div>

      <div class="right-header">
        <img class="img-escudo" src={!! public_path('img/unica2.png') !!} align=right>
      </div>

      <div class="center-header">
        <h2>MAGENTA</h2>
        <h3>Facultad de Ingeniería</h3>
        <h3>Hoja de Asistencia</h3>
      </div>
      <hr>
    </div>
    <div id="body">
      <table class="t1">
        <tr>
          <th class="rubro">Departamento: </th>
          <td class="contenido">{!! $department_name !!}</td>
          <th class="rubro">Sede: </th>
          <td class="contenido">{!! $venue_name !!}</td>
        </tr>
        <tr>
          <th class="rubro">Curso: </th>
          <td class="contenido">{!! $activity_name !!}</td>
          <th class="rubro">Fechas: </th>
          <td class="contenido">{!! $manual_date !!}</td>
        </tr>
        <tr>
          <th class="rubro">Instructor(es): </th>
          <td class="contenido" colspan="3">{!! $instructors_name !!}</td>
        </tr>
      </table>
    </div>
  </div>
  <br>
  <table id="participants">
    <tr>
      <th class="rubro names">Nombre del participante</th>
      <th class="rubro" colspan="10">Fechas de impartición</th>
    </tr>
    <tr>
      <td class="hide cell"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
    </tr>
    @foreach($participants as $participant)
    <tr>
      @if (strlen($participant->name.' '.$participant->last_name.' '.$participant->mothers_last_name)>50)
      <td class="cell names">{!! $participant->name.' '.$participant->last_name !!}</td>
      @else
      <td class="cell names">{!! $participant->name.' '.$participant->last_name.' '.$participant->mothers_last_name !!}</td>
      @endif
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
      <td class="show cell cells"></td>
    </tr>
    @endforeach
  </table>
</body>
</html>
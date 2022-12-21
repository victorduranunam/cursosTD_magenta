<!DOCTYPE html>
<html lang="es">

  <head>
    <meta charset="UTF-8">
    <title>Historial de Actividades del Profesor</title>
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
  width: 60%;
}
.mg{
  width: 30%;
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

th, td{
  vertical-align:top;
  border-bottom: 5pt solid white;
}
.rubro{
  text-align: left;
  width:550px;
}
.contenido{
  text-align:center;
  width:80px;
}
</style>

  <body>
    <div id="header">

      <div class="left-header">
        <img class="img-escudo mg" src={!! public_path('img/logo-MAGESTIC.png') !!} align=left>
      </div>
      <div class="right-header">
        <img class="img-escudo" src={!! public_path('img/unica2.png') !!} align=right>
      </div>

      <div class="center-header">
        <h2>MAGESTIC</h2>
        <h3>Facultad de Ingeniería</h3>
        <h3>Historial de Actividades del Profesor</h3> 
      </div>
      
    </div>

    <div>
      <hr>
      <table>
        <tr>
          <th>{!! $professor->getFullName() !!}</th>
        </tr>
        <tr>
          <td>Cursos Acreditados:    <b>{!! $professor->activities->count() !!}</b></td>
          <td>Total de horas:    <b>{!! $professor->activities->sum('hours') !!}h</b></td>
        </tr>    
      </table>
      <hr>
      <table>

        <thead>
          <tr>
            <th class="rubro">Cursos Acreditados</th>
            <th class="contenido">Periodo</th>
            <th class="contenido">Duración(h)</th>
          </tr>
        </thead>

        <tbody>
          @foreach($professor->activities as $activity)
            <tr style='padding-top: 10px;'>
              <td class="rubro"> {!! $activity->name !!} </td>
              <td class="contenido"> {!! $activity->year.'-'.$activity->num.$activity->type !!} </td>
              <td class="contenido"> {!! $activity->hours !!} </td>
           </tr>
          @endforeach
        </tbody>
      </table>
      
      
    </div>
  </body>
</html>
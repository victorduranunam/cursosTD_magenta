<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Publicidad {!! $activity->catalogue->name !!} </title>
  </head>

<style>
html{
	width:100%;
  height: 100%;
}
body{
  font-family: Arial, Helvetica, sans-serif;
  background-image: url({!! public_path('img/logo-MAGESTIC.png') !!});
  background-size:45%;
  background-position: right bottom;
  background-repeat: no-repeat;
  border-bottom-right-radius: 15%;
  opacity: 0.4;
}

#header{
  width: 100%;
  text-align:center;
  line-height:10px;
}
th, td{
  text-align: left;
  vertical-align:top;
}
.instructor{
  font-style: italic;
}
.rubros{
  width: 150px;
}
.contenidos{
  text-align: justify;
}

</style>

  <body>
    <div>
      <div id='header'>
        <h2>MAGESTIC</h2>
        <h3>Facultad de Ingeniería</h3>
      </div>
      <div id="body">
        <hr>
          <table>
            <tr>
              <th>{!! $activity->catalogue->getType() !!}: </th>
              <td>{!! $activity->catalogue->name !!}</td>
            </tr>
          </table>
        <hr>
        <table>
          <tr>
            <th class="rubros">Dirigido a:</th>
            <td class="contenidos">{!! $activity->catalogue->aimed_at !!}</td>
          </tr>
          <tr>
            <th class="rubros">Instructor(es):</th>
            <td> 
              @foreach ($activity->instructors as $instructor)
                <p class="instructor"> {!! $instructor->getName() !!}</p>
                <p> {!! $instructor->getSemblance() !!}</p>
              @endforeach
            </td>
          </tr>
        </table>
        
        
        <table style="margin-top:10px">
          <tr>
            <th class="rubros">Objetivo:</th>
          <td class="contenidos">{!! $activity->catalogue->objective !!}</td>
          </tr>
          <tr>
            <th id=rubro-temario>Contenido:</th>
            <td class=temario>{!! $activity->catalogue->content !!}</td>
          </tr>
          <tr>
            <th class="rubros">Antecedentes:</th>
            <td class="contenidos">{!! $activity->catalogue->background !!}</td>
          </tr>
          <tr>
            <th class="rubros">Fecha: </th>
            <td class="contenidos">{!! $activity->manual_date !!}</td>
          </tr>
          <tr>
            <th class="rubros">Sede: </th>
            <td class="contenidos">{!! $activity->venue->name !!}</td>
          </tr>
          <tr>
            <th class="rubros">Duración: </th>
            <td class="contenidos">{!! $activity->catalogue->hours !!} h</td>
          </tr>
          <tr>
            <th class="rubros">Costo:</th>
            <td class="contenidos">${!! $activity->cost !!} MXN</td> <!--Originalmente con "id=tipolower"-->
          </tr>
        </table>
      </div>
    </div>
  </body>

</html>


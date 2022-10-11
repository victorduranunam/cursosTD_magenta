<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Publicidad {!! $activity->catalogue->name !!} </title>
  </head>


  <body>

    <div>
      <div id='header'>
        <h1>MAGESTIC</h1>
        <table>
          <tr>
            <th>{!! $activity->catalogue->getType() !!}: </th>
            <th>{!! $activity->catalogue->name !!}</th>
          </tr>
        </table>
      </div>

      <div id="body">
        <table>
          <tr>
            <td class=rubros>Dirigido a:</td>
            <td class=contenidos>{!! $activity->catalogue->aimed_at !!}</td>
          </tr>
          <tr>
            <td class=rubros>Instructor(es):</td>
            <td></td>
          </tr>
        </table>
        
        @foreach ($activity->instructors as $instructor)
          <p> {!! $instructor->getName() !!}</p>
          <p> {!! $instructor->getSemblance() !!}</p>
        @endforeach
        
        <table style="margin-top:10px">
          <tr>
            <td class=rubros>Objetivo:</td>
          <td class=contenidos>{!! $activity->catalogue->objective !!}</td>
          </tr>
          <tr>
            <td id=rubro-temario>Contenido:</td>
            <td class=temario>{!! $activity->catalogue->content !!}</td>
          </tr>
          <tr>
            <td class=rubros>Antecedentes:</td>
            <td class=contenidos>{!! $activity->catalogue->background !!}</td>
          </tr>
          <tr>
            <td class=rubros>Fecha: </td>
            <td class=contenidos>{!! $activity->manual_date !!}</td>
          </tr>
          <tr>
            <td class=rubros>Sede: </td>
            <td class=contenidos>{!! $activity->venue->name !!}</td>
          </tr>
          <tr>
            <td class=rubros>Duración: </td>
            <td class=contenidos>{!! $activity->catalogue->hours !!} h</td>
          </tr>
          <tr>
            <td class=rubros>Costo:</td>
            <td class=contenidos>${!! $activity->cost !!}MXN</td> <!--Originalmente con "id=tipolower"-->
          </tr>
        </table>
      </div>
    </div>
  </body>

</html>


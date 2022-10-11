<!DOCTYPE html>

<html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Reporte General De Actividades {!! $year.$num.$type !!} </title>
  </head>


  <body>

    <div>
      <div id='header'>
        <h1>MAGESTIC</h1>
        <h2>Reporte General De Actividades</h2>
        <h3>{!! $year.$num.$type !!}</h3>
      </div>
      
      <div id="body">
        <table>
          <tr>
            <th>Clave</th>
            <th>Nombre de la actividad</th>
            <th>Instructor(es)</th>
            <th colspan="2">Fechas</th>
            <th>Horas</th>
            <th>Cupo</th>
          </tr>
          @foreach($activities as $activity)
            <tr>
              <td>{!! $activity->key !!}</td>
              <td>{!! $activity->name !!}</td>
              <td>{!! $activity->instructors !!}</td>
              <td>{!! $activity->start_date !!}</td>
              <td>{!! $activity->manual_date !!}</td>
              <td>{!! $activity->hours !!}</td>
              <td>{!! $activity->venue !!}</td>
              <td>{!! $activity->max_quota !!}</td>

              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td>{!! $activity->end_date !!}</td>
              <td></td>
              <td></td>
              <td></td>
              <td>{!! $activity->min_quota !!}</td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </body>

</html>


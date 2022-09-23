<!DOCTYPE html>
<html lang="es">

  <head>
    <meta charset="UTF-8">
    <title>Historial de Actividades del Profesor</title>
  </head>


  <body>
    <div>
      <div>
        <h3>MAGESTIC</h3>
      </div>
      <div>
        <img>
        <img>
        <h4>Historial de Actividades del Profesor</h4>
        <h3>{!! $professor->getFullName() !!}</h3>
      </div>
    </div>
    <div>
      <table>

        <colgroup>
          <col width="80%">
          <col width="14%">
          <col width="6%">
        </colgroup>

        <thead>
          <tr>
            <th width="80%">Cursos Acreditados</th>
            <th width="14%">Periodo</th>
            <th width="6%">Duración(h)</th>
          </tr>
        </thead>

        <tbody>
          @foreach($professor->activities as $activity)
            <tr style='padding-top: 10px;'>
              <td width="80%"> {!! $activity->name !!} </td>
              <td width="14%"> {!! $activity->year.'-'.$activity->num.$activity->type !!} </td>
              <td width="6%"> {!! $activity->hours !!} </td>
           </tr>
          @endforeach
        </tbody>
      </table>
      
      <table>
        <tr>
          <td>Cursos Acreditados:    <b>{!! $professor->activities->count() !!}</b></td>
          <td>Total de horas:    <b>{!! $professor->activities->sum('hours') !!}h</b></td>
        </tr>    
      </table>
    </div>
  </body>
</html>
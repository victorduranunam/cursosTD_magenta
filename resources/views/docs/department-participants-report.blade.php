<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reporte de Participantes | MAGESTIC </title>
</head>
<body>

  <h1>{!! $department !!}</h1>
  <h2>{!! $period !!}</h2>
  <table>
    <tr>
      <th>Nombre</th>
      <th>Cupo máximo</th>
      <th>Total de participantes</th>
      <th>Participantes extemporaneos</th>
      <th>Participantes adicionales</th>
      <th>Promedio (Asistentes/Cupo) </th>
    </tr>
    @foreach ($activities as $activity)
    <tr>
      <td>{!! $activity->name !!}</td>
      <td>{!! $activity->max_quota !!}</td>
      <td>{!! $activity->total_participants !!}</td>
      <td>{!! $activity->mistimed_participants !!}</td>
      <td>{!! $activity->additional_participants !!}</td>
      <td>{!! $activity->average.'%' !!}</td>
    </tr>
    @endforeach
  </table>
</body>
</html>
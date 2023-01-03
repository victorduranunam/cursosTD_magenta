<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Libro de Folios</title>
</head>
<body>
  <table>
    <tr>
      <th>Clave</th>
      <th>Periodo</th>
      <th>Instructor</th>
      <th>Folio del Instructor</th>
      <th>Participante</th>
      <th>Folio del Participante</th>
    </tr>
    @foreach($activities as $activity)
      @foreach($activity->instructors as $instructor)
        <tr>
          <td>{!! $activity->catalogue->key !!}</td>
          <td>{!! $activity->year ."-". $activity->num . $activity->type !!}</td>
          <td>{!! $instructor !!}</td>
        </tr>
      @endforeach
    
        <!-- @foreach($activity->participants as $participant)
          <td>{!! $participant->name . " " . $participant->last_name . " " . $participant->mothers_last_name!!}</td>
          <td>{!! $participant->key !!}</td>
        @endforeach -->

    @endforeach
  </table>
</body>
</html>
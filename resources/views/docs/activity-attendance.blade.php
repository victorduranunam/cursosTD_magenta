<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Hoja de Asistencia | MAGESTICD</title>
</head>
<body>
  <h1>{!! $activity_name !!}</h1>
  <h2>{!! $department_name !!}</h2>
  <h3>{!! $venue_name !!}</h3>
  <h4>{!! $instructors_name !!}</h4>
  <h5>{!! $manual_date !!}</h5>
  <table>
    @foreach($participants as $participant)
      <tr>
        <td>{!! $participant->name !!}</td>
      </tr>
    @endforeach
  </table>
</body>
</html>
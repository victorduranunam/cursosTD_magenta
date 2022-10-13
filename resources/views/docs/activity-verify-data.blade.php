<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Verificacion De Datos | MAGESTIC</title>
</head>
<body>
  <h1>{!! $activity_name !!}</h1>
  <table>
    <th colspan="3">Nombre del participante</th>
    <th>{!! $manual_date !!}</th>
    <th>Datos correctos</th>
    @foreach($participants as $participant){
      <tr>
        <td>{!! $participant->name.' '.$participant->last_name.' '.$participant->mothers_last_name !!}</td>
        <td>{!! $participant->email !!}</td>
        <td>{!! $participant->facebook !!}</td>
        <td>{!! $participant->phone_number !!}</td>
        <td><i class="bi bi-square"></i></td>
      </tr>
    }
    @endforeach
  </table>
</body>
</html>
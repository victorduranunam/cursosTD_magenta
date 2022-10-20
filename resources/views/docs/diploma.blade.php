<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Diploma| MAGESTIC</title>
</head>
<body>
  <table>
    <tr>
      <th>{!! $diploma_name !!}</th>
      <th>{!! 'Duración: '.$diploma_duration !!}</th>
    </tr>

    <tr>
      <td>{!! $participant['name'].' '.$participant['last_name'].' '.$participant['mothers_last_name'] !!}</td>
    </tr>

    @foreach ($participant['grades'] as $module => $grade)
      <tr>
        <td>{!! $module !!}</td>
        <td>{!! $grade !!}</td>
      </tr>
    @endforeach

    <tr>
      <td>{!! 'Promedio: '.$participant['average'] !!}</td>
      <td>{!! 'Folio: '.$participant['key'] !!}</td>
      <td>{!! 'Foja: '.$page !!}</td>
      <td>{!! 'Libro: '.$book !!}</td>
    </tr>

    <tr>
      <th>{!! $director_name !!}</th>
      @if($director_gender === 'M')
        <th>Director</th>
      @elseif($director_gender === 'F')
        <th>Directora</th>
      @endif
    </tr>
    <tr>
      <th>{!! $coord_name !!}</th>
      @if($coord_gender === 'M')
        <th>Coordinador</th>
      @elseif($coord_gender === 'F')
        <th>Coordinadora</th>
      @endif
    </tr>
  </table>
</body>
</html>
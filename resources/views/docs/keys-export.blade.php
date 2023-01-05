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
      <th>Instructor/Participante</th>
      <th>Folio</th>
    </tr>
    @foreach($rows as $row)
    <tr>
      <td>{!! $row->key_catalogue !!}</td>
      <td>{!! $row->year.'-'.$row->num.$row->type !!}</td>
      <td>{!! $row->name.' '.$row->last_name.' '.$row->mothers_last_name !!}</td>
      <td>{!! $row->key !!}</td>

    </tr>
    @endforeach
  </table>
</body>
</html>
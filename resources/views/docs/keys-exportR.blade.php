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
      <th style='background-color:#DEDEDE; border: 1px solid black; font-weight: bold;'>Clave</th>
      <th style='background-color:#DEDEDE; border: 1px solid black; font-weight: bold;'>Periodo</th>
      <th style='background-color:#DEDEDE; border: 1px solid black; font-weight: bold;'>Instructor/Participante</th>
      <th style='background-color:#DEDEDE; border: 1px solid black; font-weight: bold;'>Folio</th>
    </tr>
    @foreach($rows as $row)
    <tr>
      <td style="border: 1px solid black;">{!! $row->key_catalogue !!}</td>
      <td style="border: 1px solid black;">{!! $row->year.'-'.$row->num.$row->type !!}</td>
      <td style="border: 1px solid black;">{!! $row->name.' '.$row->last_name.' '.$row->mothers_last_name !!}</td>
      <td style='background-color:#CFE2F3; border: 1px solid black;'>{!! $row->key !!}</td>

    </tr>
    @endforeach
  </table>
</body>
</html>
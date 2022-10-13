<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Identificadores | MAGESTIC</title>
</head>
<body>
  <table>
    @foreach ($participants as $participant)
        <tr>
          <td>
            {!! $activity_name !!}
          </td>
          <td>
            {!! $participant->name !!}
          </td>
          <td>
            {!! $manual_date !!}
          </td>
        </tr>
    @endforeach
  </table>
</body>
</html>
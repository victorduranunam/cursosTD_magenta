<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Constancia | Magestic</title>
</head>
<body>
  <p>
    {!! $activity_name !!}
    {!! $activity_manual_date !!}
    {!! $activity_hours !!}
    {!! $activity_certificate_date !!}
    {!! $text !!}
    {!! $participant_name !!}
    {!! $participant_key !!}
    {!! $signatures !!}
  </p>
  <hr>
  <p>
    @if($signatures == '1')
      {!! $first_name_signature !!}
      {!! $first_degree_signature !!}
    @elseif($signatures == '2')
      {!! $first_name_signature !!}
      {!! $first_degree_signature !!}

      {!! $second_name_signature !!}
      {!! $second_degree_signature !!}
    @elseif($signatures == '3')
      {!! $first_name_signature !!}
      {!! $first_degree_signature !!}

      {!! $second_name_signature !!}
      {!! $second_degree_signature !!}

      {!! $third_name_signature !!}
      {!! $third_degree_signature !!}
    @elseif($signatures == '4')
      {!! $first_name_signature !!}
      {!! $first_degree_signature !!}

      {!! $second_name_signature !!}
      {!! $second_degree_signature !!}

      {!! $third_name_signature !!}
      {!! $third_degree_signature !!}

      {!! $fourth_name_signature !!}
      {!! $fourth_degree_signature !!}
    @elseif($signatures == '5')
      {!! $first_name_signature !!}
      {!! $first_degree_signature !!}

      {!! $second_name_signature !!}
      {!! $second_degree_signature !!}

      {!! $third_name_signature !!}
      {!! $third_degree_signature !!}

      {!! $fourth_name_signature !!}
      {!! $fourth_degree_signature !!}

      {!! $fifth_name_signature !!}
      {!! $fifth_degree_signature !!}
    @endif
  </p>
</body>
</html>
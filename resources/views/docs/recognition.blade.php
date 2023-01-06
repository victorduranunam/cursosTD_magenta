<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Constancia | MAGESTIC</title>
</head>
<style>
  html{
    width: 100%;
    height: 100%;
    background-image: url('../public/img/contancia_INTER.jpg');
    background-size: auto;
    background-repeat: no-repeat;
  /* background-position: 4cm 1.9cm; */
  }
</style>
<body>
  <p>
    {!! $activity_name !!}
    Otorga el presente reconocimiento
    {!! $activity_manual_date !!}
    {!! $activity_hours !!}
    {!! $activity_recognition_date !!}
    {!! $activity_catalogue_type !!}
    {!! $text !!}
    {!! $instructor_name !!}
    {!! $instructor_key !!}
    @if($instructor_topics->count() == 1)
      {!! $instructor_topics->first() !!}
    @elseif($instructor_topics->isEmpty())
      No es un seminario
    @else
      Por su participacion en varios temas de seminario
    @endif
    {!! $instructor_key !!}
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
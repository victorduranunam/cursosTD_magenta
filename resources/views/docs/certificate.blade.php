<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Constancia | MAGESTIC</title>
  
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Tangerine:wght@400;700&display=swap');
  @page{ 
    margin: 0px; 
  }
  body{
    width: 100%;
    height: 100%;
    background-image: url({!! public_path('img/constancia.jpg') !!});
    background-size: auto;
    background-repeat: no-repeat;
    background-position: center;
    /* font-family:Arial, Helvetica, Sans-serif,cursive; */
    font-family: "Century Gothic";
  }
  .info{
    width: 100%;
    text-align:center;
    border: 1px solid black;
    position: relative;
    top:27%;
  }
  .text{
    font-family: "Century Gothic", CenturyGothic, AppleGothic, sans-serif;
    font-size: 18pt;
  }
  #professor-name{
    font-family:'Tangerine', cursive;
    font-style:italic;
    font-size: 24pt;
    line-height: 50%;
  }
  #activity-name{
    font-family:'Tangerine', serif;
    font-style:italic;
    font-size: 22pt;
    line-height: 50%;
  }
</style>
<body>
  <div class="info">
    <p class="text">Otorgan a </p>
    <p id="professor-name">{!! $participant_name !!}</p>
    <p class="text">{!! $text !!}</p>
    <p id="activity-name">{!! $activity_name !!}</p>
    <p>{!! $activity_manual_date !!}</p>
    <p>{!! $activity_certificate_date !!}</p>
  </div>
  <!-- /* <p>
    
    
    {!! $activity_hours !!}
    
    
    
    {!! $participant_key !!}
    {!! $signatures !!}
  </p> */ -->
  
 <!-- /* <div class="firmas">
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
 </div> */ -->
</body>
</html>
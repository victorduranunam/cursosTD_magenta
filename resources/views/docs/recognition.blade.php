<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reconocimiento | MAGENTA</title>
</head>
<style>
  
  @page{ 
    margin: 0px;
    margin-bottom: 0px;
  }
  body{
    width: 100%;
    height: 100%;
    background-image: url({!! public_path('img/reconocimiento.png') !!});
    background-size: 100% 100%;
    background-repeat: no-repeat;
    background-position: center;
    font-family:Arial, Helvetica, Sans-serif,cursive;
  }
  .info{
    width: 100%;
    text-align:center;
    position: relative;
    top:25%;
    align:center;
  }
  .text{
    font-size: 18pt;
    line-height: 80%;
  }
  .instructor{
    width: 100%;
    padding-left:15%;
    padding-right:15%;
  }
  #instructor-name{
    width:70%;
    height:auto;
    font-family:'Tangerine', cursive;
    font-style:italic;
    font-size: 24pt;
    line-height: 100%;
    word-break: break-word;
  }
  .activity{
    width:100%;
    text-align:center;
  }
  #activity-name{
    font-family:'Tangerine', serif;
    font-style:italic;
    font-size: 22pt;
    font-weight: bold;
    line-height: 100%;
  }
  .topic{
    font-family:'Tangerine', serif;
    font-size: 15pt;
    font-style:italic;
    line-height: 50%;
  }
  .firmas{
    width:100%;
    font-size: 10pt;
    position: absolute;
    bottom: 9px;
    text-align:center;
    padding-left:6%;
    padding-right:4%;
  }
  table{
    width:90%;
    height: 120px;
    margin:0;
    padding:0;
    table-layout: fixed;
    text-align:center;
    position: relative;
    right:0;
    top:0;
  }
  td{
    padding-top: 0.2cm;
  }
  .signature{
    color: gray;
  }
  .signatory-degree{
    font-weight:bold;
    /* font-size: 11pt; */
    line-height: 5px;
  }
  .name-signatory{
    /* font-size: 11pt; */
    line-height: 15px;
    height:30px;
    vertical-align:top;
  }
  .folio{
    width: 100%;
    margin:0;
    padding:0;
    position: absolute;
    text-align:right;
    bottom:0;
    right: 10px;
  }  
</style> 
<body>
  <div class="info">
    <div class="instructor">
      <p id="instructor-name">{!! $instructor_name !!}</p>
    </div>
    <p class="text">{!! $text." ".$activity_catalogue_type !!}</p>
    <div class="activity">
      @if(strlen($activity_name) < 90)
        <p id="activity-name">{!! $activity_name !!}</p>
      @elseif(strlen($activity_name) < 150)
        <p id="activity-name" style="font-size: 18pt;  width:15cm; position: relative; left:23%;">{!! $activity_name !!}</p>
      @elseif(strlen($activity_name) < 170)
        <p id="activity-name" style="font-size: 16pt; width:15cm;">{!! $activity_name !!}</p>
      @elseif(strlen($activity_name) < 190)
        <p id="activity-name" style="font-size: 14pt; width:15cm;">{!! $activity_name !!}</p>
      @elseif(strlen($activity_name) < 285)
        <p id="activity-name" style="font-size: 13pt; width:15cm; position: relative; left:20%;">{!! $activity_name !!}</p>
      @else
        <p id="activity-name" style="font-size: 12pt; width:15cm; position: relative; left:20%;">{!! $activity_name !!}</p>
      @endif
    </div>

    
    
    @if($instructor_topics->count() == 1)
    <p class="text">Por impartir el tema</p>
    <p class="text topic">{!! $instructor_topics->first() !!}</p>
    @elseif($instructor_topics->isEmpty())
      <br>
    @else
    <p class="text">Por su participacion en varios temas de seminario</p>
    @endif

    <p style="line-height: 20%;">{!! $activity_manual_date !!}</p>
    <p style="line-height: 20%;">Duración: {!! $activity_hours !!} h</p>
    <p style="line-height: 20%;">Ciudad Universitaria, Cd. Mx., {!! $activity_recognition_date !!}</p>
  </div>

  <div class="firmas">
    <table>
      @if($signatures == '1')
        <tr>
          <td class="signature">___________________</td>
        </tr>
        <tr>
          <td class="signatory-degree">{!! $first_degree_signature !!}</td>
        </tr>
        <tr>
          <td class="name-signatory">{!! $first_name_signature !!}</td>
        </tr>
      @elseif($signatures == '2')
        <tr>
          <td class="signature">___________________</td>
          <td class="signature">___________________</td>
        </tr>
        <tr>
          <td class="signatory-degree">{!! $first_degree_signature !!}</td>
          <td class="signatory-degree">{!! $second_degree_signature !!}</td>
        </tr>
        <tr>
          <td class="name-signatory">{!! $first_name_signature !!}</td>
          <td class="name-signatory">{!! $second_name_signature !!}</td>
        </tr>

      @elseif($signatures == '3')
        <tr>
          <td class="signature">___________________</td>
          <td class="signature">___________________</td>
          <td class="signature">___________________</td>
        </tr>
        <tr>
          <td class="signatory-degree">{!! $first_degree_signature !!}</td>
          <td class="signatory-degree">{!! $second_degree_signature !!}</td>
          <td class="signatory-degree">{!! $third_degree_signature !!}</td>
        </tr>
        <tr>
          <td class="name-signatory">{!! $first_name_signature !!}</td>
          <td class="name-signatory">{!! $second_name_signature !!}</td>
          <td class="name-signatory">{!! $third_name_signature !!}</td>
        </tr>
      @elseif($signatures == '4')
        <tr>
          <td class="signature">___________________</td>
          <td class="signature">___________________</td>
          <td class="signature">___________________</td>
          <td class="signature">___________________</td>
        </tr>
        <tr>
          <td class="signatory-degree">{!! $first_degree_signature !!}</td>
          <td class="signatory-degree">{!! $second_degree_signature !!}</td>
          <td class="signatory-degree">{!! $third_degree_signature !!}</td>
          <td class="signatory-degree">{!! $fourth_degree_signature !!}</td>
        </tr>
        <tr>
          <td class="name-signatory">{!! $first_name_signature !!}</td>
          <td class="name-signatory">{!! $second_name_signature !!}</td>
          <td class="name-signatory">{!! $third_name_signature !!}</td>
          <td class="name-signatory">{!! $fourth_name_signature !!}</td>
        </tr>
      @elseif($signatures == '5')
        <tr>
            <td class="signature">___________________</td>
            <td class="signature">___________________</td>
            <td class="signature">___________________</td>
            <td class="signature">___________________</td>
            <td class="signature">___________________</td>
          </tr>
          <tr>
            <td class="signatory-degree">{!! $first_degree_signature !!}</td>
            <td class="signatory-degree">{!! $second_degree_signature !!}</td>
            <td class="signatory-degree">{!! $third_degree_signature !!}</td>
            <td class="signatory-degree">{!! $fourth_degree_signature !!}</td>
            <td class="signatory-degree">{!! $fifth_degree_signature !!}</td>
          </tr>
          <tr>
            <td class="name-signatory">{!! $first_name_signature !!}</td>
            <td class="name-signatory">{!! $second_name_signature !!}</td>
            <td class="name-signatory">{!! $third_name_signature !!}</td>
            <td class="name-signatory">{!! $fourth_name_signature !!}</td>
            <td class="name-signatory">{!! $fifth_name_signature !!}</td>
          </tr>
          
      @endif
    </table>
  </div> 
  <div class="folio">
      <p>{!! $instructor_key !!}</p>
  </div>  
</body>
</html>
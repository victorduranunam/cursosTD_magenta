<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Diploma| MAGENTA</title>
</head>

<style>

@page{ 
  margin: 0px;
  margin-bottom: 0px;
}

body{
  width: 100%;
  height: 100%;
  font-family:Arial, Helvetica, Sans-serif,cursive;
}
.bg{
  width: 100%;
  height: 100%;
  background-image: url({!! public_path('img/diploma.png') !!});
  background-size: 100% 100%;
  background-repeat: no-repeat;
  background-position: center;
}
.no-bg{
  width:100%;
  height:100%;
  background-image:none;
  page-break-before: always;
}
.info{
  width: 100%;
  text-align:center;
  position: relative;
  top:30%;
  align:center;
}
.text{
  font-size: 18pt;
  line-height: 80%;
}
.participant{
  width: 100%;
  padding-left:15%;
  padding-right:15%;
}
#participant-name{
  width:70%;
  height:auto;
  font-family:'Tangerine', cursive;
  font-style:italic;
  font-size: 30pt;
  line-height: 100%;
  word-break: break-word;
}
#diploma-name{
  font-family:'Tangerine', serif;
  font-style:italic;
  font-size: 24pt;
  font-weight: bold;
  line-height: 100%;
}
.module{
  position: relative;
  top:15%;
  width:90%;
  padding-left:7%;
  padding-right:3%;
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

.firmas table{
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
.firmas td{
  padding-top: 0.2cm;
}
.signature{
  color: gray;
}
.signatory-degree{
  font-weight:bold;
  line-height: 5px;
}
.name-signatory{
  line-height: 15px;
  height:30px;
  vertical-align:top;
}
.keys{
  width:100%;
  position: absolute;
  bottom:50px;
}
.keys td{
  width:30%;
  text-align:center;
}
</style>

<body>
  <div class="bg">
    <div class="info">
      <div class="participant">
        <p id="participant-name">{!! $participant['name'].' '.$participant['last_name'].' '.$participant['mothers_last_name'] !!}</p>
      </div>
      <p class="text">por haber acreditado</p>
      <div class="diploma">
        @if(strlen($diploma_name) < 90)
          <p id="diploma-name">{!! $diploma_name !!}</p>
        @elseif(strlen($diploma_name) < 150)
          <p id="diploma-name" style="font-size: 18pt;  width:15cm; position: relative; left:23%;">{!! $diploma_name !!}</p>
        @elseif(strlen($diploma_name) < 170)
          <p id="diploma-name" style="font-size: 16pt; width:15cm;">{!! $diploma_name !!}</p>
        @elseif(strlen($diploma_name) < 190)
          <p id="diploma-name" style="font-size: 14pt; width:15cm;">{!! $diploma_name !!}</p>
        @elseif(strlen($diploma_name) < 285)
          <p id="diploma-name" style="font-size: 13pt; width:15cm; position: relative; left:20%;">{!! $diploma_name !!}</p>
        @else
          <p id="diploma-name" style="font-size: 12pt; width:15cm; position: relative; left:20%;">{!! $diploma_name !!}</p>
        @endif
      </div>
      <p style="line-height: 25%;">Duración: {!! $diploma_duration !!} h</p>
      <p style="line-height: 25%;">Ciudad Universitaria, Cd. Mx., {!! $certificate_date !!}</p>
    </div>
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
  <div class="no-bg">
    <table class="module">
  
      <tr>
        <th style="text-align:center;"> Numero de módulo </th>
        <th> Nombre de módulo </th>
        <th style="text-align:center;"> Calificación </th>
      </tr>
  
      @foreach ($participant['grades'] as $module)
        <tr>
        {{-- Numero de modulo --}}
          <td style="text-align:center;">{!! $module['number'] !!}</td>
        {{-- Nombre de modulo --}}
          <td>{!! $module['name'] !!}</td>
        {{-- Calificacion --}}
          <td style="text-align:center;">{!! $module['grade'] !!}</td>
        </tr>
      @endforeach
  
      <tr>
        <th colspan="3" style="text-align:right;">{!! 'Promedio: '.$participant['average'] !!}</th>
      </tr>
    </table>

    <table class="keys">
      <tr>
        <td>{!! 'Folio: '.$participant['key'] !!}</td>
        <td>{!! 'Foja: '.$page !!}</td>
        <td>{!! 'Libro: '.$book !!}</td>
      </tr>
    </table>

  </div>
</body>
</html>
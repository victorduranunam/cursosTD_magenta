<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Verificación De Datos | MAGESTIC</title>
</head>
<style>
html{
	width:100%;
  height: 100%;
}
body{
  font-family: Arial, Helvetica, sans-serif;
}
#header{
  width: 100%;
  text-align:center;
  line-height:10px;
  display:inline-block;
}
.img-escudo{
  width: 55%;
}
.mg{
  width: 30%;
  border-bottom-right-radius: 20%;
  border-bottom-left-radius: 20%;
}
.left-header,.right-header{
  width: 30%;
  position:relative;
}
.right-header{
  float:right;
}
.center-header{
  width:100%;
  align:center;
  line-height:5px;
}
th, td{
  vertical-align:top;
  text-align: left;
}
table.contenido th, table.contenido td{
  border-bottom: 5pt solid white;
}

.curso{
  font-size: 17px;
  width:auto;
}
.contenido{
  font-size:14px;
}

.datos1{
  text-align: left;
  vertical-align:bottom;
}
.datos2{
  text-align: center;
  width:10px;
}
</style>
<body>
  <div id="header">

    <div class="left-header">
      <img class="img-escudo mg" src={!! public_path('img/logo-MAGESTIC.png') !!} align=left>
    </div>
    <div class="right-header">
      <img class="img-escudo" src={!! public_path('img/unica.png') !!} align=right>
    </div>

    <div class="center-header">
      <h2>MAGESTIC</h2>
      <h3>Facultad de Ingeniería</h3>
      <h3>Verificación de Datos</h3> 
    </div>

  </div>
  <div>
  <hr>
    <table class="curso">
      <th>{!! $activity_name !!}</th>
      <tr>
        <td>{!! $manual_date !!}</b></td>
      </tr>    
    </table>
  <hr>
  </div>

  <table class="contenido">
    <th class="datos1" colspan="4">Datos del participante</th>
    <th class="datos2">Datos correctos</th>
    @foreach($participants as $participant){
      <tr>
        <td width=210px>{!! $participant->name.' '.$participant->last_name.' '.$participant->mothers_last_name !!}</td>
        <td width=210px>{!! $participant->email !!}</td>
        <td>{!! $participant->facebook !!}</td>
        <td width=100px>{!! $participant->phone_number !!}</td>
        <td class="datos2"><img height='25' src={!! public_path('img/checkbox.png') !!}></td>
      </tr>
    }
    @endforeach
  </table>
</body>
</html>
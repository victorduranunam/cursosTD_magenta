<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Identificadores | MAGENTA</title>
</head>
<style>
html{
	width:100%;
	height: 100%;
}
body{
  font-family: Arial, Helvetica, sans-serif;
}
table{
  width:100%;
  height: 4.9cm;
  text-align:center;
  background-image: url({!! public_path('img/logo-magenta.png') !!});
  background-size:16%;
  background-position: 450px 65px;
  background-repeat: no-repeat;
  opacity: 0.4;
}
.ident{
  border-top: 1px solid black;
	border-left: 1px solid black;
	border-right: 1px solid black;
	border-bottom: 0.5px solid black;
	width: 15.6cm;
	height: 4.9cm;
}
.corner{
  height: 20px;
}
.last{
  padding-top:35px;
}
.nombre-pequenio{
	font-size: 79px;
}

.nombre-mediano{
	font-size: 64px;
	padding-top: 0.4cm;
}
.nombre-mediano-2{
	font-size: 60px;
	padding-top: 0.6cm;
	word-wrap:break-word;
}
.nombre-mediano-3{
	font-size: 57px;
	padding-top: 0.6cm;
	word-wrap:break-word;
}

.nombre-largo{
	font-size: 25px;
	padding-top: 1cm;
	word-wrap:break-word;
}
.nombre-largo-2{
	font-size: 46px;
	padding-top: 1cm;
	word-wrap:break-word;
}
.nombre-largo-3{
	font-size: 46px;
	padding-top: 1cm;
	word-wrap:break-word;
}
.nombre-largo-4{
	font-size: 45px;
	padding-top: 1cm;
	word-wrap:break-word;
}
.nombre-largo-5{
	font-size: 40px;
	padding-top: 1cm;
	word-wrap:break-word;
}

</style>
<body>
  @foreach ($participants as $participant)
  <table width=100% class="ident">
    <tr>
      <th class="corner">
        {!! $activity_name !!}
      </th>
    </tr>
    <tr>
      @if(strlen($participant->name) <= 8)
        <th class=nombre-pequenio> {!! $participant->name !!} </th>
      @elseif(strlen($participant->name) <= 16)
        <th class=nombre-mediano> {!! $participant->name !!} </th>
      @elseif(strlen($participant->name) > 16 and strlen($participant->name)<= 18)
        <th class=nombre-mediano-2> {!! $participant->name !!} </th>
      @elseif(strlen($participant->name) > 18 and strlen($participant->name)<= 20)
        <th class=nombre-mediano-3> {!! $participant->name !!} </th>
      @elseif(strlen($participant->name) > 20 and strlen($participant->name)<= 22)
        <th class=nombre-largo-2> {!! $participant->name !!} </th>
      @elseif(strlen($participant->name) > 22 and strlen($participant->name)<= 24)
        <th class=nombre-largo-3> {!! $participant->name !!} </th>
      @elseif(strlen($participant->name) > 24 and strlen($participant->name)<= 26)
        <th class=nombre-largo-4> {!! $participant->name !!} </th>
      @elseif(strlen($participant->name) > 26 and strlen($participant->name)<= 28)
        <th class=nombre-largo-5> {!! $participant->name !!} </th>
      @else
        <th class=nombre-largo> {!! $participant->name !!} </th>
      @endif
    </tr>
    <tr>
      <td class="corner last">
        {!! $manual_date !!}
      </td>
    </tr>
  </table>
  @endforeach
</body>
</html>
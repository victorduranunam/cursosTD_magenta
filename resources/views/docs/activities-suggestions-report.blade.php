<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reporte Sugerencias | {!! $year.$num.$type !!}</title>
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
  width: 32%;
}
.mg{
  width: 28%;
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
  text-align: left;
  vertical-align:top;
  border-bottom: 5pt solid white;
}
.dep{
  font-size: 17px;
}
.act_name{
  width:100%;
}
.name{
  width:250px;
}
.sug{
  width:auto;
  text-align:justify;
}
</style>
<body>

  <div>
    <div id='header'>
      <div class="left-header">
        <img class="img-escudo mg" src={!! public_path('img/logo-MAGESTIC.png') !!} align=left>
      </div>

      <div class="right-header">
        <img class="img-escudo" src={!! public_path('img/escudo_fi_color.png') !!} align=right>
      </div>

      <div class="center-header">
        <h2>MAGESTIC</h2>
        <h3>Facultad de Ingenierí­a</h3>
        <h3>Reporte de Sugerencias</h3> 
        <h3>{!! $year.'-'.$num.$type !!}</h3>
      </div>
    </div>

    <div id="body">
      @foreach($departments as $department)
      <hr>
      <b class="dep">{!! $department->name !!}</b>
      <hr>
      <table>
        @foreach($department->activities as $activity)
        <tr>
          <th colspan="2">{!! $activity->name !!}</th>
        </tr>
          @foreach($activity->suggestions as $suggestion)
          <tr>
            <td class="name">{!! $suggestion->name.' '.$suggestion->last_name.' '.$suggestion->mothers_last_name !!}</td>
            <td class="sug" >{!! $suggestion->question_6_2 !!}</td>
          </tr>
          @endforeach
        @endforeach
      </table>
      @endforeach
    </div>

  </div>
</body>
</html>
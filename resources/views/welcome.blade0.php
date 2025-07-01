<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href={!! asset('bootstrap/css/bootstrap.min.css') !!}>
  <link rel="stylesheet" href={!! asset('css/welcome.css') !!}>
  <link rel="shortcut icon" href={!! url("/img/favicon.ico") !!} type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

  <title>Cursos TD</title>
</head>
<body class="home">

  <div class="flex-center position-ref full-height">

    @if(Auth::user())
    <div class="top-right links">
      <a href="{{ route('home') }}">Hogar</a>
    </div>
    @else
    <div class="top-right links">
      <a href="{!! route('search.evaluation') !!}">Contestar Encuesta</a>
      <a href="{!! route('login') !!}">Ingresar</a>
    </div>
    @endif

    <div class="content">
      <div class="title m-b-md">
        CURSOS - TD
      </div>
    </div>

  </div>

  <script src={!! asset('bootstrap/js/bootstrap.min.js') !!}></script>
</body>
</html>

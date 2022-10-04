<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href={!! asset('bootstrap/css/bootstrap.min.css') !!}>
  <link rel="stylesheet" href={!! asset('css/welcome.css') !!}>
  <link rel="stylesheet" href={!! asset('css/app.css') !!}>
  <link rel="shortcut icon" href={!! url("/img/favicon.ico") !!} type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

  <title>MAGESTIC | Capacitación Docente</title>
</head>
<body class="home">

  <div class="flex-center position-ref full-height">
    
    <form method="POST" action="{!! route('auth') !!}">
      @csrf
      @method('post')
    <div class="content">
      <div class="title m-b-md">
        MAGESTIC
      </div>
    </div>

      <div class="mb-3">
        <label for="username" class="form-label">Nombre de usuario:</label>
        <input type="text" class="form-control" name='username' id="username" placeholder="Ej. areacomputo45" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña:</label>
        <input type="password" class="form-control" id="password" name='password' required>
      </div>
      <button type="submit" class="btn btn-primary">Ingresar</button>
      @if(isset($msj))
        <p>{!! $msj !!}</p>
      @endif
    </form>


  </div>

  <script src={!! asset('bootstrap/js/bootstrap.min.js') !!}></script>
</body>
</html>

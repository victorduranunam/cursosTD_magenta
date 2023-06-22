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
    
    <form method="GET" action="{!! route('create.activity-evaluation') !!}">
      @csrf
      @method('get')
    <div class="content">
      <div class="title m-b-md">
        <a style='text-decoration: none; color:#636b6f;' href="{!! route('home') !!}">MAGESTIC</a> 
      </div>
      <div class="subtitle m-b-md">
        Contestar Encuesta
      </div>
    </div>
    @include('partials.messages')

      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="text" class="form-control" name='email' id="email" placeholder="Ej. armando@ejemplo.com" required>
      </div>
      <div class="mb-3">
        <label for="group_key" class="form-label">Clave de Grupo:</label>
        <input type="text" class="form-control" id="group_key" name='group_key' placeholder="Ej. DICU001-12" required>
      </div>
      <button type="submit" class="btn btn-primary">Continuar</button>
    </form>


  </div>

  <script src={!! asset('bootstrap/js/bootstrap.min.js') !!}></script>
</body>
</html>

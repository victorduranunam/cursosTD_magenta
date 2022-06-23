<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href={!! asset('bootstrap/css/bootstrap.min.css') !!}>
  <link rel="stylesheet" href={!! asset('css/app.css') !!}>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <link rel="shortcut icon" href={!! url("/img/favicon.ico") !!} type="image/x-icon">

  <title>MagestiCD | Centro de Docencia</title>
</head>

<body>
  <div>

    <!-- Header -->
    <nav class="navbar fixed-top navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">MagestiCD</a>
        
        <!-- User Dashboard -->
        <div class="dropdown">
          <a href="#" class="dropdown-toggle usr-dashboard" data-bs-toggle="dropdown">UserName &nbsp;<i class="bi bi-person"></i></a>
            <div class="dropdown-menu dropleft dropdown-menu-end">
                <a href="#" class="dropdown-item">Ver Usuarios</a>
                <a href="#" class="dropdown-item">Cerrar Sesión</a>
            </div>
        </div>

      </div>
    </nav>
    

    <!-- Side menu -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-10 col-lg-3 side-menu">....</div>
        <div class="col-lg-9 main-info">....</div>
      </div>
    </div>

    <!-- @yield('content') -->

    <footer class="text-center footer footer-link">
      <!-- Grid container -->
      <div class="container">
        <!-- Section: Links -->
        <section class="mt-5">

          <div class="row text-center d-flex justify-content-center pt-5">
            <div class="col-md-2">
              <h5 class="text-uppercase font-weight-bold">
                <a class="nav-link footer-link" href="https://www.ingenieria.unam.mx/centrodedocencia/centro.html">Sobre nosotros</a>
              </h5>
            </div>

            <div class="col-md-2">
              <h5 class="text-uppercase font-weight-bold">
                <a class="nav-link footer-link" href="https://www.ingenieria.unam.mx/centrodedocencia/directorio.html">Contacto</a>
              </h5>
            </div>
          </div>
          
        </section>

        <hr class="my-5" />

        <section class="mb-5">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
              <p>
                <img class="unica-logo" src="{!! url("/img/unica.png") !!}" alt="unica-logo.png">
                Hecho en México, Universidad Nacional Autónoma de México,
                Facultad de Ingeniería,
                <a href="https://www.ingenieria.unam.mx/unica/" class="nav-link">Unidad de Servicios de Cómputo Académico,</a>
                Departamento de Investigación y Desarrollo.
                Todos los derechos reservados 2022.
              </p>
            </div>
          </div>
        </section>
      </div>
    </footer>
  </div>

  <script src={!! asset('bootstrap/js/bootstrap.min.js') !!}></script>
  <script src={!! asset('bootstrap/js/bootstrap.bundle.js') !!}></script>
</body>
</html>

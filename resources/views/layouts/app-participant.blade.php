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

    <title>MAGESTIC | Evaluaciones</title>
  </head>
  <body onload="main()">
    <div class="wrap">
      <!-- Header -->
      <div class="header">
          <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
              <button class="btn btn-dark btn-sm mobile" href="" onclick=openNav();><i class="bi bi-list"></i></button>
              <p class="navbar-brand">MAGESTIC</p>
              <a href="{!! route('home') !!}" class="navbar-brand">Salir</a>
            </div>
          </nav>
      </div>

      <!-- Main Info -->
      <div class="main" id="main">
        @yield('content')
      </div>
      <div class="ft">
        <footer class="text-center footer-link">
          <!-- Grid container -->
          <div class="container">
            <!-- Section: Links -->
            <section class="mt-5">

              <div class="row text-center d-flex justify-content-center pt-5">
                <div class="col-md-2">
                  <p class="text-uppercase font-weight-bold">
                    <a class="nav-link footer-link" href="https://www.ingenieria.unam.mx/centrodedocencia/centro.html">Sobre nosotros</a>
                  </p>
                </div>

                <div class="col-md-2">
                  <p class="text-uppercase font-weight-bold">
                    <a class="nav-link footer-link" href="https://www.ingenieria.unam.mx/centrodedocencia/directorio.html">Contacto</a>
                  </p>
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
      <!-- Footer -->
       
    </div>

    <script src={!! asset('bootstrap/js/jquery.js') !!}></script>
    <script src={!! asset('bootstrap/js/admin.js') !!}></script>
    <script src={!! asset ('/dist/jquery.fancybox.min.js') !!}></script>
    <script src={!! asset('bootstrap/js/bootstrap.min.js') !!}></script>
    <script src={!! asset('bootstrap/js/bootstrap.bundle.js') !!}></script>
    <script src={!! asset('js/app.js') !!}></script>

  </body>
</html>

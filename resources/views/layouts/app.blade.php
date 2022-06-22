<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href={!! asset('bootstrap/css/bootstrap.min.css') !!}>
  <link rel="stylesheet" href={!! asset('css/app.css') !!}>
  <link rel="shortcut icon" href={!! url("/img/favicon.ico") !!} type="image/x-icon">

  <title>MagestiCD | Centro de Docencia</title>
</head>

<body>
  <div>

    <!-- Header -->
   <nav>

   </nav>
    

    <!-- Side menu -->
    @yield('content')

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
</body>
</html>

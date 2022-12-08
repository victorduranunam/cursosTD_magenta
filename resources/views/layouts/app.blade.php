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

  <title>MAGESTIC | Capacitación Docente</title>
</head>
<body onload="main()">
    <div class="wrap">
        <!-- Header -->
        <div class="header">
            <nav class="navbar navbar-dark bg-dark">
                <div class="container-fluid">
                    <button class="btn btn-dark btn-sm mobile" href="" onclick=openNav();><i class="bi bi-list"></i></button>
                    <a class="navbar-brand" href={!! route('home') !!}>MAGESTIC</a>
                    
                    <!-- User Dashboard -->
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle usr-dashboard" data-bs-toggle="dropdown">{!! Auth::user()->username !!} &nbsp;<i class="bi bi-person-circle"></i></a>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a href="{!! route('logout') !!}" class="dropdown-item">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        
        <!-- Side Menu -->
        <div class="sidebar">
        <!-- Side menu Content -->
            <aside id="side-menu" class="aside" role="navigation">
              <button class="btn btn-outline-light btn-sm mobile" style="float:right; margin:10px; margin-right:20px;" href="" onclick=closeNav();><i class="bi bi-x"></i></button>
              <ul class="nav nav-list accordion">

                <li class="nav-header">
                    <div class="link"><i class="bi bi-journals"></i>Actividades<i class="bi bi-chevron-down"></i></div>
                    <ul class="submenu">
                        <li><a href={!! route('create.activity.catalogue') !!}>Alta Catálogo</a></li>
                        <li><a href={!! route('view.activities.catalogue') !!}>Catálogo de Actividades</a></li>
                        <li><a href={!! route('view.activities') !!}>Actividades programadas</a></li>
                        <li><a href="{!! route('view.diplomas') !!}">Ver Diplomados</a></li>
                    </ul>
                </li>

                <li class="nav-header">
                    <div class="link"><i class="bi bi-person-lines-fill"></i>Profesores<i class="bi bi-chevron-down"></i></div>
                    <ul class="submenu">
                        <li><a href={!! route('create.professor') !!}>Alta Profesor</a></li>
                        <li><a href={!! route('view.professors') !!}>Consulta de profesores</a></li>
                    </ul>
                </li>

                <li class="nav-bar">
                  <div class="link"><i class="bi bi-newspaper"></i>Puestos de trabajo <i class="bi bi-chevron-down"></i></div>
                  <ul class="submenu">
                    <li><a href={!! route('view.work-positions') !!}>Consulta de Puestos de trabajo</a></li>
                  </ul>
                </li>

                <li class="nav-header">
                    <div class="link"><i class="bi bi-building"></i>Salones<i class="bi bi-chevron-down"></i></div>
                    <ul class="submenu">
                        <li><a href={!! route('create.venue') !!}>Alta de Salón</a></li>
                        <li><a href={!! route('view.venues') !!}>Consulta Salones</a></li>
                    </ul>
                </li>

                <li class="nav-header">
                    <div class="link"><i class="bi bi-bank"></i>Departamentos<i class="bi bi-chevron-down"></i></div>
                    <ul class="submenu">
                        <li><a href={!! route('create.department') !!}>Alta de Departamento</a></li>
                        <li><a href={!! route('view.departments') !!}>Consulta de departamentos</a></li>
                        <li><a href={!! route('create.administrator') !!}>Alta de administrador</a></li>
                        <li><a href={!! route('view.administrators') !!}>Consulta de administradores</a></li>
                    </ul>
                </li>

                <li class="nav-header">
                    <div class="link"><i class="bi bi-briefcase"></i>Divisiones<i class="bi bi-chevron-down"></i></div>
                    <ul class="submenu">
                        <li><a href={!! route('view.divisions') !!}>Consulta de Divisiones</a></li>
                    </ul>
                </li>

              </ul>
            </aside>
           
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

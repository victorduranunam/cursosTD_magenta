@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Accesos Rápidos <i class="bi bi-pin-angle"></i> </h3>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
      <div class="logos col-center">
        <img class="img-escudo" src={!! asset('img/logo_td.jpg') !!} alt="">
        &nbsp; Cursos Transformación Digital
        <hr>
        <h5>¿Qué desea hacer?</h5>
        <div class="row" style="margin: 1%" style="margin: 1%">
          <div class="col-4">
            <a href="{!! route('view.activities.catalogue') !!}" class="btn btn-outline-dark">Programar una actividad</a>
          </div>
          <div class="col-4">
            <a href="{!! route('view.departments') !!}" class="btn btn-outline-dark">Ver departamentos</a>
          </div>
          <div class="col-4">
            <a href={!! route('create.professor') !!} class="btn btn-outline-dark">Dar de alta instructor</a>
          </div>
        </div>
        <div class="row" style="margin: 1%">
          <div class="col-4">
            <a href={!! route('view.activities') !!} class="btn btn-outline-dark">Ver Actividades programadas</a>
          </div>
          <div class="col-4">
            <a href={!! route('view.student') !!} class="btn btn-outline-dark">Ver alumnos</a>
          </div>
          <div class="col-4">
            <a href={!! route('view.professors') !!} class="btn btn-outline-dark">Ver instructorres</a>
          </div>
        </div>
        <div class="row" style="margin: 1%">
          <div class="col-4">
            <a href={!! route('create.activity.catalogue') !!} class="btn btn-outline-dark">Crear nuevo Catálogo de Actividades</a>
          </div>
          <div class="col-4">
            <a href={!! route('view.venues') !!} class="btn btn-outline-dark">Ver aulas</a>
          </div>
          <div class="col-4">
            <a href="{!! route('view.administrators') !!}" class="btn btn-outline-dark">Consultar Administradores</a>
          </div>
        </div>
      </div>
      
    </div>
  
  </div>
  
@endsection
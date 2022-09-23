@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Accesos Rápidos <i class="bi bi-pin-angle"></i> </h3>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
      <div class="logos col-center">
        <img class="img-escudo" src={!! asset('img/logo-magestic.png') !!} alt="">
        &nbsp; Manejo y Gestión de actividades para la capacitación docente.
        <hr>
        <h5>¿Qué desea hacer?</h5>
        <div class="row" style="margin: 1%" style="margin: 1%">
          <div class="col-4">
            <a href="" class="btn btn-outline-dark">Dar de alta un curso</a>
          </div>
          <div class="col-4">
            <a href="" class="btn btn-outline-dark">Dar de alta módulo de diplomado</a>
          </div>
          <div class="col-4">
            <a href={!! route('create.professor') !!} class="btn btn-outline-dark">Dar de alta profesor</a>
          </div>
        </div>
        <div class="row" style="margin: 1%">
          <div class="col-4">
            <a href={!! route('view.activities') !!} class="btn btn-outline-dark">Ver Actividades programadas</a>
          </div>
          <div class="col-4">
            <a href={!! route('view.diplomas') !!} class="btn btn-outline-dark">Ver diplomados</a>
          </div>
          <div class="col-4">
            <a href={!! route('view.professors') !!} class="btn btn-outline-dark">Ver profesores</a>
          </div>
        </div>
        <div class="row" style="margin: 1%">
          <div class="col-4">
            <a href={!! route('create.activity.catalogue') !!} class="btn btn-outline-dark">Crear nuevo Catálogo de Actividades</a>
          </div>
          <div class="col-4">
            <a href={!! route('view.diplomas') !!} class="btn btn-outline-dark">Crear diplomado</a>
          </div>
          <div class="col-4">
            <a href="" class="btn btn-outline-dark">Consultar Evaluaciones</a>
          </div>
        </div>
      </div>
      
    </div>
  
  </div>
  
@endsection
@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Bienvenid@</h3>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
      <div class="logos col-center">
        <img class="img-escudo" src={!! asset('img/cdd.png') !!} alt="">
        &nbsp; Manejo y Gestión de información del Centro de Docencia.
        <hr>
        <h5>Accesos rápidos <i class="bi bi-pin-angle"></i></h5>
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
            <a href={!! route('view.activities.catalogue') !!} class="btn btn-outline-dark">Ver Actividades programados</a>
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
            <a href="" class="btn btn-outline-dark">Crear diplomado</a>
          </div>
          <div class="col-4">
            <a href="" class="btn btn-outline-dark">Consultar Evaluaciones</a>
          </div>
        </div>
      </div>
      
    </div>
  
  </div>
  
@endsection
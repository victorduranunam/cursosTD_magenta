@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Ver Salones <i class="bi bi-building"></i></h3>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
      @foreach ($venues as $venue)
      <div class="row" style="margin: 1%">
        <div class="col-xl-6">
          {!! $venue->name !!}
        </div>
        <div class="col-xl-2">
          <a href="" class="btn btn-outline-info">Actualizar</a>
        </div>
        <div class="col-xl-2">
          <a href="" class="btn btn-outline-danger">Eliminar</a>
        </div>
      </div>
      @endforeach
      
    </div>
  </div>
@endsection
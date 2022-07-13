@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Ver Divisiones <i class="bi bi-briefcase"></i></h3>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
      @foreach ($divisions as $division)
      <div class="row" style="margin: 1%">
        <div class="col-6">
          {!! $division->name !!}
        </div>
        <div class="col-2">
          <a href="" class="btn btn-outline-info">Actualizar</a>
        </div>
        <div class="col-2">
          <a href="" class="btn btn-outline-danger">Eliminar</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
@endsection
@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Ver Coordinaciones <i class="bi bi-bank"></i></h3>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
      @if($departments->isNotEmpty())
        @foreach ($departments as $department)
        <div class="row">
          <div class="col-xl-6">
            {!! $department->name !!}
          </div>
          <div class="col-xl-2">
            <a href={!! route('update.department', $department->department_id) !!} class="btn btn-outline-info">Actualizar</a>
          </div>
          <div class="col-xl-2">
            <a href={!! route('delete.department', $department->department_id) !!} class="btn btn-outline-danger">Eliminar</a>
          </div>
        </div>
        @endforeach
      @elseif($departments->isEmpty())
        <div class="row">
          <div class="col-xl-6">
            No hay coordinaciones en la base de datos.
          </div>
        </div>
        <div class="row">
          <div class="col-xl-3">
            <a href={!! route('create.department') !!} class="btn btn-outline-info">Alta de coordinación</a>
          </div>
          <div class="col-xl-2">
            <a href={!! route('home') !!} class="btn btn-outline-danger">Regresar</a>
          </div>
        </div>
      @endif
      
    </div>
  </div>
@endsection
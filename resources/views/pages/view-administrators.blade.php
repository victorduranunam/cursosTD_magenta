{{-- TODO: Modal de eliminación --}}

@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Ver Administradores <i class="bi bi-bank"></i></h3>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
      @if($administrators->isNotEmpty())
        @foreach ($administrators as $administrator)
        <div class="row">
          <div class="col-xl-6">
            {!! $administrator->last_name.' '.$administrator->mothers_last_name.' '.$administrator->name !!}
          </div>
          <div class="col-xl-2">
            <a href={!! route('edit.administrator', $administrator->administrator_id) !!} class="btn btn-outline-info">Actualizar</a>
          </div>
          <div class="col-xl-2">
            <form method="POST" action="{!! route('delete.administrator', $administrator->administrator_id) !!}">
              @csrf
              @method('delete')
              <input type='submit' value=Eliminar class="btn btn-outline-danger">
            </form>
          </div>
        </div>
        @endforeach
      @elseif($administrators->isEmpty())
        <div class="row">
          <div class="col-xl-6">
            No hay administradores en la base de datos.
          </div>
        </div>
        @endif
        <div class="row">
          <div class="col-xl-3">
            <a href={!! route('create.administrator') !!} class="btn btn-outline-success">Alta de administrador</a>
          </div>
          <div class="col-xl-2">
            <a href={!! route('home') !!} class="btn btn-outline-warning">Regresar</a>
          </div>
        </div>
      
    </div>
  </div>
@endsection
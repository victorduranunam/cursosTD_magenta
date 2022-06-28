@extends('layouts.app')
@section('content')

  @include('partials.messages')
  <div class="card">
    <div class="card-header"><br>
      <h3>Bienvenid@</h3>
    </div>
    <div class="card-body"><br>
      <div class="logos col-center">
        <img class="img-escudo" src={!! asset('img/cdd.png') !!} alt="">
        &nbsp; Manejo y Gestión de información del Centro de Docencia.
        <hr>
        
      </div>
      
    </div>
  
  </div>
  
@endsection
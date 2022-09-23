@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Ver Cuentas de Usuario</h3>
    <div class="row justify-content-end">
      <div class="col-xl-3" style='width: auto'>
          <a href={!! route('create.account') !!} class="btn btn-outline-success">Crear cuenta</a>
      </div>
      <div class="col-xl-2">
        <a href={!! route('home') !!} class="btn btn-outline-warning">Regresar</a>
      </div>
    </div>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
      @if($accounts->isNotEmpty())
        <div class="row">
          <div class="col-xl-3">
            <h6>Nombre de Usuario</h6>
          </div>
          <div class="col-xl-4">
            <h6>Nombre</h6>
          </div>
          <div class="col-xl">
            <h6>Administrador</h6>
          </div>
        </div>
        @foreach ($accounts as $account)
        <div class="row row-list">
          <div class="col-xl-3">
            {!! $account->username !!}
          </div>
          <div class="col-xl-4">
            {!! $account->name !!}
          </div>
          @if($account->admin)
          <div class="col-xl-1">
            Sí
          </div>
          @else
          <div class="col-xl-1">
            No
          </div>
          @endif
          <div class="col-xl-2">
            <a href={!! route('edit.account', $account->account_id) !!} class="btn btn-outline-primary">Editar</a>
          </div>
          <div class="col-xl-2">
            <form method="POST" action="{!! route('delete.account', $account->account_id) !!}">
              @csrf
              @method('delete')
              <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $account->account_id !!}">Eliminar</a>
              <div class="modal fade" id="myModal{!! $account->account_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Eliminar Cuenta de Usuario</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro de eliminar la cuenta de usuario {!! $account->username !!}? 
                        Dejará de ser posible acceder al sistema con esta cuenta de usuario.
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <input type="submit" value="Eliminar" class="btn btn-outline-danger">
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        @endforeach
      @elseif($accounts->isEmpty())
        <div class="row">
          <div class="col-xl-6">
            No hay cuentas de usuario creadas.
          </div>
        </div>
      @endif
    </div>
  </div>
@endsection
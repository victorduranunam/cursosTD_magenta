@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Ver Categorías y Niveles <i class="bi bi-mortarboard"></i></h3>
    <div class="row justify-content-end">
      <div class="col-xl-3">
        <a href={!! route('create.category') !!} class="btn btn-outline-success">Alta de categorías</a>
      </div>
      <div class="col-xl-2">
        <a href={!! route('home') !!} class="btn btn-outline-warning">Regresar</a>
      </div>
    </div>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>
    @if($categories->isNotEmpty())
      @foreach ($categories as $category)
      <div class="row" style="margin: 1%">
        <div class="col-xl-6">
          {!! $category->name !!}
        </div>
        <div class="col-xl-2">
          <a href={!! route('edit.category', $category->category_id) !!} class="btn btn-outline-primary">Actualizar</a>
        </div>
        <div class="col-xl-2">
          <form method="POST" action="{!! route('delete.category', $category->category_id) !!}">
            @csrf
            @method('delete')
            <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $category->category_id !!}">Eliminar</a>
            <div class="modal fade" id="myModal{!! $category->category_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p>¿Está seguro de eliminar la categoría {!! $category->name !!}?
                      Esto borrará los registros que existan entre profesores
                      con ella.
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
    @elseif($departments->isEmpty())
      <div class="row">
        <div class="col-xl-6">
          No hay categorías en la base de datos.
        </div>
      </div>
    @endif
    </div>
  </div>
@endsection
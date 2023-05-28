@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Ver Departamentos <i class="bi bi-bank"></i></h3>
    <div class="row justify-content-end">
      <div class="col-2">
        <a href={!! route('create.department') !!} class="btn btn-outline-success">Alta de departamento</a>
      </div>
      <div class="col-1">
        <a class="btn btn-outline-primary" onclick="blockSearchDiv()">Buscar</a>
      </div>
      <div class="col-2">
        <a href={!! route('home') !!} class="btn btn-outline-warning">Regresar</a>
      </div>
    </div>
  </div>
  @include('partials.messages')
    <div class="card-body"><br>

      {{-- Form for search --}}
      <div id="search-div" style="display:none;">
        <form method="GET" action="{!! route('search.departments') !!}">
          @csrf
          @method('get')
          <div class="row">
            <div class="col-xl-6">
              <label class="form-label" for="words">Buscar departamento:</label>
              <input required class="form-control" type="text" name="words" id="words" value="{!! old('words') !!}">
            </div>
            <div class="col-xl-3">
              <label class="form-label" for="search-type">Buscar por:</label>
              <select class="form-select" name="search_type" id="search_type">
                <option selected value='name'>Nombre</option>
                <option value='abbreviation'>Abreviación</option>
              </select>
            </div>
            <div class="col-xl-2 mt-auto">
              <input type="submit" id='search-btn' class="btn btn-outline-success" value='Buscar'>
            </div>
          </div>
          <hr>
        </form>
      </div>

      @if($departments->isNotEmpty())

        <div class="row">
          <div class="col-xl-3">
            <h6>Nombre</h6>
          </div>
          <div class="col-xl-3">
            <h6>Abreviación</h6>
          </div>
        </div>

        @foreach ($departments as $department)
          <div class="row row-list">

            {{-- Name of the department --}}
            <div class="col-xl-3">
              {!! $department->name !!}
            </div>

            <div class="col-xl-3">
              {!! $department->abbreviation !!}
            </div>

            {{-- Update button --}}
            <div class="col-xl-2">
              <a href={!! route('edit.department', $department->department_id) !!} class="btn btn-outline-primary">Actualizar</a>
            </div>

            {{-- Generate docs --}}
            <div class="col-xl-2" style="width: auto;">
              <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                  Formatos
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <li><a class="dropdown-item" id={!! "departmentAccepatanceCriteriaReportRoute".$department->department_id !!} name="{!! route('download.department-acceptance-criteria-report', $department->department_id) !!}" onclick={!! 'selectAccepatanceCriteriaReportRouteDepartmentDocs('.$department->department_id.')' !!} data-bs-toggle="modal" data-bs-target="#myModalDocs">Reporte de criterio de aceptación</a></li>
                  <li><a class="dropdown-item" id={!! "departmentParticipantsReportRoute".$department->department_id !!} name="{!! route('download.department-participants-report', $department->department_id) !!}" onclick={!! 'selectParticipantsReportRouteDepartmentDocs('.$department->department_id.')' !!} data-bs-toggle="modal" data-bs-target="#myModalDocs">Reporte de participantes</a></li>
                  <li><a class="dropdown-item" id={!! "departmentEvaluationReportRoute".$department->department_id !!} name="{!! route('download.department-evaluation-report', $department->department_id) !!}" onclick={!! 'selectEvaluationReportRouteDepartmentDocs('.$department->department_id.')' !!} data-bs-toggle="modal" data-bs-target="#myModalDocs">Reporte de evaluación</a></li>
                </ul>
                <form method="GET" action="{!! route('view.departments') !!}" id='docsForm'>
                  @csrf
                  <div class="modal fade" id="myModalDocs" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="docsModalLabel">Escoger Periodo</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-10">
                              <label for="period" class="form-label">Ingrese el periodo</label>
                              <input required placeholder="Año" type="number" min="1900" max="2199" step="1" id="year_search" name="year_search" class="form-control">
                            </div>
                          </div>
                          <div class="row" id='type_num_search'>
                            <div class="col-4">
                              <select required class="form-select" name="num_search" id="num_search">
                                <option value="1">1</option>
                                <option value="2">2</option>
                              </select>
                            </div>
                            <div class="col-6">
                              <select class="form-select" name="type_search" id="type_search">
                                <option value="s">Semestral</option>
                                <option value="s">Intersemestral</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <input type="submit" value="Generar" class="btn btn-outline-primary">
                          <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            {{-- Delete button --}}
            <div class="col-xl-2">
              <form method="POST" action="{!! route('delete.department', $department->department_id) !!}">
                @csrf
                @method('delete')
                <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $department->department_id !!}">Eliminar</a>
                <div class="modal fade" id="myModal{!! $department->department_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar departamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p>¿Está seguro de eliminar el departamento {!! $department->name !!}? 
                          Esto borrará todos los registros
                          que dependan de ella, como catálogos de Actividades, Actividades y evaluaciones. 
                          Si no quiere perder estos registros primero modifíquelos.
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
            No hay departamentos en la base de datos.
          </div>
        </div>

      @endif

    </div>
  </div>
@endsection
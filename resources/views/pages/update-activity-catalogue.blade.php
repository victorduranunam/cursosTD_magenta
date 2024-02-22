@extends('layouts.app')
@section('content')

<div class="card">
  <div class="card-header"><br>
    <h3>Actualizar Catálogo de Actividades <i class="bi bi-journals"></i></h3>
  </div>
  
  @include('partials.messages')

  <div class="card-body"><br>
    <form method="POST" action="{!! route('update.activity.catalogue', $activity_cat->activity_catalogue_id) !!}">
      @csrf
      @method('put')
      <div class="row">
        <div class="col-xl-4">
          <label for="key" class="form-label">*Clave:</label>
          <input type="text" required class="form-control" name="key" id="key" placeholder="Ej. DICHZA001" value="{!! $activity_cat->key !!}">
        </div>
        <div class="col-xl-6">
          <label for="name" class="form-label">*Nombre:</label>
          <input type="text" required class="form-control" name="name" id="name" placeholder="Ej. El cálculo integral aplicado en la ingeniería civil" value="{!! $activity_cat->name !!}">
        </div>
        <div class="col-xl-2">
          <label for="hours" class="form-label">*Horas:</label>
          <input type="number" min="0" max="9999" required class="form-control" name="hours" id="hours" placeholder="Ej. 10" value="{!! $activity_cat->hours !!}">
        </div>
      </div>
      <div class="row">
        <div class="col-xl-3">
          <label for="type" class='form-label'>*Tipo:</label>
          <select name="type" id="type" class="form-select" required onchange="viewRowDiploma()">
            <option {!! $activity_cat->type == 'CU' ? "selected" : "" !!} value="CU">Curso</option>
            <option {!! $activity_cat->type == 'CT' ? "selected" : "" !!} value="CT">Curso - Taller</option>
            <option {!! $activity_cat->type == 'TA' ? "selected" : "" !!} value="TA">Taller</option>
            <option {!! $activity_cat->type == 'SE' ? "selected" : "" !!} value="SE">Seminario</option>
            <option {!! $activity_cat->type == 'FO' ? "selected" : "" !!} value="FO">Foro</option>
            <option {!! $activity_cat->type == 'EV' ? "selected" : "" !!} value="EV">Evento</option>
            <option {!! $activity_cat->type == 'DI' ? "selected" : "" !!} value="DI">Módulo de Diplomado</option>
            <option {!! $activity_cat->type == 'CO' ? "selected" : "" !!} value="CO">Conferencia</option>
          </select>
        </div>
        <div class="col-xl-3">
          <label for="creation_date" class="form-label">*Fecha de creación:</label>
          <input type="date" class="form-control" required name="creation_date" 
            id="creation_date" placeholder="22/07/22" 
            value="{!! $activity_cat->creation_date !!}"
          >
        </div>
        <div class="col-xl-6">
          <label for="department_id" class="form-label">*Departamento:</label>
          <select name="department_id" id="department_id" class="form-select">
            @foreach($departments as $department)
              <option {!! $activity_cat->department_id == $department->department_id ? "selected" : "" !!} value={!! $department->department_id !!}> {!! $department->name !!} </option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6">
          <label for="aimed_at" class="form-label">Dirigido a:</label>
          <textarea rows="4" max="500" name="aimed_at" id="aimed_at" class="form-control" placeholder="Ej. Dirigido a docentes con la experiencia en la ingeniería civil con necesidad de reforzar temas básicos">{!! $activity_cat->aimed_at !!}</textarea>
        </div>
        <div class="col-xl-6">
          <label for="objective" class="form-label">Objetivo:</label>
          <textarea rows="4" max="500" name="objective" id="objective" class="form-control" placeholder="Ej. El objetivo es ejemplificar a los docentes casos de uso comunes dentro de la materia...">{!! $activity_cat->objective !!}</textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6">
          <label for="content" class="form-label">Contenido:</label>
          <textarea rows="4" max="2000" name="content" id="content" class="form-control" placeholder="Ej. 1. Introducción, 2. Fundamentos del cálculo....">{!! $activity_cat->content !!}</textarea>
        </div>
        <div class="col-xl-6">
          <label for="background" class="form-label">Antecedentes:</label>
          <textarea rows="4" max="500" name="background" id="background" class="form-control" placeholder="Ej. Para cursar esta actividad es necesario contar con antecedentes sobre...">{!! $activity_cat->background !!}</textarea>
        </div>
      </div>

      @if($diplomas->isNotEmpty())
        <div class="row" id='row_diploma_select' style="visibility: hidden">
          <div class="col-xl-3">
            <label for="module" class="form-label">*Número de módulo:</label>
            <input type="number" name="module" id="module" min="1" max="100" class="form-control" value="{!! $activity_cat->module !!}">
          </div> 
          
          <div class="col-xl-6">
            <label for="diploma_id" class="form-label">*Diplomado:</label>
            <select name="diploma_id" id="diploma_id" class="form-select">
              @foreach($diplomas as $diploma)
              <option {!! $activity_cat->diploma_id == $diploma->diploma_id ? "selected" : "" !!} value={!! $diploma->diploma_id !!}>{!! $diploma->name !!}</option>
              @endforeach
            </select>
          </div>
        </div>

      @else
        <div class="row" id='row_diploma_advice' style="visibility: hidden; color: red">
          <p>No existe ningún diplomado, es necesario primero crear uno.</p>
        </div>
      @endif

      <div class="row">
        <div class="d-grid gap-2 col-xl-2 mt-auto" id='btn_save' style="visibility: visible">
          <button type="submit" id='save-btn' class="btn btn-outline-success"> Guardar </button>
        </div>
        <div class="col-xl-2">
          <a href="{!! route("view.activities.catalogue") !!}" class="btn btn-outline-warning">Cancelar</a>
        </div>
      </div>

    </form>
  </div>
</div>

@endsection

@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Generar Diplomas <i class="bi bi-filetype-pdf"></i></h3>
    <h4>{!! $diploma->name !!}</h4>

  </div>
  @include('partials.messages')
  <div class="card-body">
    <br>
    <form  method="POST" action="{!! route('download.diploma-certificates', $diploma->diploma_id) !!}">
      @csrf
      @method('post')
      <div class="row">
        <div class="col-xl-5">
          <label class="form-label" for="key">*Año de impartición (para búsqueda de módulos):</label>
          <input required placeholder="Ej. 2022" type="number" min="1900" max="2199" step="1" id="year_search" name="year_search" class="form-control" value="{!! old('year_search') !!}">
        </div>
        <div class="col-xl-5">
          <label class="form-label" for="key">*Libro:</label>
          <input required maxlength="3" class="form-control" type="number" name="book" id="book" placeholder="Ej. 13" value="{!! old('book') !!}">
        </div>
        <div class="col-xl-5">
          <label class="form-label" for="key">*Foja:</label>
          <input required maxlength="3" class="form-control" type="number" name="page" id="page" placeholder="Ej. 33" value="{!! old('page') !!}">
        </div>
        <div class="col-xl-5">
          <label class="form-label" for="key">*Folio:</label>
          <input required maxlength="13" class="form-control" type="text" name="key" id="key" placeholder="Ej. F042022CO001C" value="{!! old('key') !!}">
        </div>
        <div class="col-xl-4">
          <label class="form-label" for="certificate_date">*Fecha de generación:</label>
          <input required class="form-control" type="date" name="certificate_date" id="certificate_date" placeholder="Ej. 22/10/22" value="{!! old('certificate_date') !!}">
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12">
          <label class="form-label" for="signatures">*Cantidad de Firmantes:</label>
          <select class="form-select" name="signatures" id="signatures" onchange="updateCertificateSignatures()" onload="updateCertificateSignatures()">
            <option value="1">Un firmante.</option>
            <option value="2">Dos firmantes.</option>
            <option value="3">Tres firmantes.</option>
            <option value="4">Cuatro firmantes.</option>
            <option value="5">Cinco firmantes.</option>
          </select>
        </div>
      </div>
      <div class="row" id='div_name_first_signature'>
        <div class="col-xl-12">
          <label class="form-label" for="first_name_signature">*Nombre del Primer Firmante:</label>
          <input maxlength="50" required class="form-control" type="text" name="first_name_signature" id="first_name_signature" placeholder="Ej. Jose Luis Rodriguez" value="{!! old('first_name_signature') !!}">
        </div>
      </div>
      <div class="row" id='div_degree_first_signature'>
        <div class="col-xl-12">
          <label class="form-label" for="first_degree_signature">*Cargo del Primer Firmante:</label>
          <input required class="form-control" type="text" name="first_degree_signature" id="first_degree_signature" placeholder="Ej. Coordinador General" value="{!! old('first_degree_signature') !!}">
        </div>
      </div>
      <div class="row" style='display: none;' id='div_name_second_signature'>
        <div class="col-xl-12">
          <label class="form-label" for="second_name_signature">*Nombre del Segundo Firmante:</label>
          <input maxlength="50" class="form-control" type="text" name="second_name_signature" id="second_name_signature" value="{!! old('second_name_signature') !!}">
        </div>
      </div>
      <div class="row" style='display: none;' id='div_degree_second_signature'>
        <div class="col-xl-12">
          <label class="form-label" for="second_degree_signature">*Cargo del Segundo Firmante:</label>
          <input class="form-control" type="text" name="second_degree_signature" id="second_degree_signature" value="{!! old('second_degree_signature') !!}">
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12" style='display: none;' id='div_name_third_signature'>
          <label class="form-label" for="third_name_signature">*Nombre del Tercer Firmante:</label>
          <input maxlength="50" class="form-control" type="text" name="third_name_signature" id="third_name_signature" value="{!! old('third_name_signature') !!}">
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12" style='display: none;' id='div_degree_third_signature'>
          <label class="form-label" for="third_degree_signature">*Cargo del Tercer Firmante:</label>
          <input class="form-control" type="text" name="third_degree_signature" id="third_degree_signature" value="{!! old('third_degree_signature') !!}">
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12" style='display: none;' id='div_name_fourth_signature'>
          <label class="form-label" for="fourth_name_signature">*Nombre del Cuarto Firmante:</label>
          <input maxlength="50" class="form-control" type="text" name="fourth_name_signature" id="fourth_name_signature" value="{!! old('fourth_name_signature') !!}">
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12" style='display: none;' id='div_degree_fourth_signature'>
          <label class="form-label" for="fourth_degree_signature">*Cargo del Cuarto Firmante:</label>
          <input class="form-control" type="text" name="fourth_degree_signature" id="fourth_degree_signature" value="{!! old('fourth_degree_signature') !!}">
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12" style='display: none;' id='div_name_fifth_signature'>
          <label class="form-label" for="fifth_name_signature_name">*Nombre del Quinto Firmante:</label>
          <input maxlength="50" class="form-control" type="text" name="fifth_name_signature" id="fifth_name_signature" value="{!! old('fifth_name_signature_name') !!}">
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12" style='display: none;' id='div_degree_fifth_signature'>
          <label class="form-label" for="fifth_degree_signature" >*Cargo del Quinto Firmante:</label>
          <input class="form-control" type="text" name="fifth_degree_signature" id="fifth_degree_signature" value="{!! old('fifth_degree_signature') !!}">
        </div>
      </div>
      <div class="row">
        <div class="col-xl-1">
          <button type="submit" class="btn btn-outline-success">Generar</button>
        </div>
        <div class="col-xl-2">
          <a href="{!! route("view.diplomas") !!}" class="btn btn-outline-warning">Cancelar</a>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection
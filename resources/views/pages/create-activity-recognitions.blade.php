@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Generar Reconocimientos <i class="bi bi-filetype-pdf"></i></h3>
    <h4>{!! $activity->getName() !!}</h4>
    <h5>{!! $activity->getPeriod() !!}</h5>
    <h5>{!! $activity->catalogue_type !!}</h5>
    @if($activity->type == 'Seminario')
      <p>*Sólo se generar reconocimientos de aquellos instructores con temas de seminario asignados</p>
    @endif

  </div>
  @include('partials.messages')
  <div class="card-body">
    <br>
    <form  method="POST" action="{!! route('download.activity-recognitions', $activity->activity_id) !!}">
      @csrf
      @method('post')
      <div class="row">
        <div class="col-xl-5">
          <label class="form-label" for="key">*Folio:</label>
          <input required maxlength="13" class="form-control" type="text" name="key" id="key" placeholder="Ej. F042022RO001C" value="{!! old('key') !!}">
        </div>
        <div class="col-xl-4">
          <label class="form-label" for="recognition_date">*Fecha de generación:</label>
          <input required class="form-control" type="date" name="recognition_date" id="recognition_date" placeholder="Ej. 22/10/22" value="{!! old('recognition_date') !!}">
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12">
          <label class="form-label" for="text">*Texto Intermedio:</label>
          <select class="form-select" name="text" id="text" onchange="updateCertificateCustomText()" onload="updateCertificateCustomText()">
            {!! $article = $activity->type === 'Conferencia' ? 'la' : 'el'!!}
            <option value="{!! 'por haber impartido '.$article !!}">Por haber impartido (el/la) </option>
            <option value="{!! 'por haber participado en '.$article !!}">Por haber participado en (el/la) </option>
            <option value="{!! 'por haber colaborado en '.$article !!}">Por haber colaborado en (el/la) </option>
            <option value="custom">Personalizado</option>
          </select>
        </div>
      </div>
      <div class="row" style='display: none;' id='div_custom_text'>
        <div class="col-xl-12">
          <label class="form-label" for="custom_text">*Texto Intermedio Personalizado:</label>
          <input class="form-control" type="text" name="custom_text" id="custom_text" placeholder="Ej. Por ser participe de" value="{!! old('custom_text') !!}">
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
          <input required class="form-control" type="text" name="first_name_signature" id="first_name_signature" placeholder="Ej. Jose Luis Rodriguez" value="{!! old('first_name_signature') !!}">
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
          <input class="form-control" type="text" name="second_name_signature" id="second_name_signature" value="{!! old('second_name_signature') !!}">
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
          <input class="form-control" type="text" name="third_name_signature" id="third_name_signature" value="{!! old('third_name_signature') !!}">
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
          <input class="form-control" type="text" name="fourth_name_signature" id="fourth_name_signature" value="{!! old('fourth_name_signature') !!}">
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
          <input class="form-control" type="text" name="fifth_name_signature" id="fifth_name_signature" value="{!! old('fifth_name_signature_name') !!}">
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12" style='display: none;' id='div_degree_fifth_signature'>
          <label class="form-label" for="fifth_degree_signature" >*Cargo del Quinto Firmante:</label>
          <input class="form-control" type="text" name="fifth_degree_signature" id="fifth_degree_signature" value="{!! old('fifth_degree_signature') !!}">
        </div>
      </div>
      <div class="row">
        <div class="col-xl-3">
          <button type="submit" class="btn btn-outline-success">Generar</button>
        </div>
        <div class="col-xl-2">
          <a href="{!! route("view.activities") !!}" class="btn btn-outline-warning">Cancelar</a>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection
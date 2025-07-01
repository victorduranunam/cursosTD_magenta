@extends('layouts.app')
@section('content')


<div class="card">
  <div class="card-header"><br>
    <h3>Modificar participante <i class="bi bi-person-check"></i></h3>
    <h4> {!! $participant->getActivityName() !!} </h4>

    <form method="POST" action="{!! route("delete.participant", $participant->participant_id) !!}">
      @csrf
      @method('delete')
      <div class="row">
        <div class="col-10" style="padding:0%;">
          <h5> {!! $participant->getFullName() !!} </h5>
        </div>
        <div class="col-2">
          <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#myModal{!! $participant->participant_id !!}">Eliminar</button>
        </div>
      </div>
      <div class="modal fade" id="myModal{!! $participant->participant_id !!}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Eliminar participante</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>¿Está seguro de eliminar al participante {!! $participant->getFullName() !!}?
                Esto borrará los registros asociados al participante, sus evaluaciones y su folio.
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cancelar</button>
              <input type="submit" value="Eliminar" class="btn btn-outline-danger">
            </div>
          </div>
        </div>
      </div>
    </form>

  </div>
  @include('partials.messages')
  <div class="card-body"><br>
    <form method="POST" class='f' action="{!! route('update.participant', $participant->participant_id) !!}">
      @csrf
      @method('put')

      {{-- First row --}}
      <div class="row align-items-center">

        {{-- Accredited --}}
        <div class="col-xl-auto">
          <label class="col-form-label" for="accredited">Acreditó:</label>
        </div>
        <div class="col-xl-auto">
          @if($participant->accredited)
            <input id='accredited' name='accredited' checked  class="form-check-input" type="checkbox">
          @else
            <input id='accredited' name='accredited' class="form-check-input" type="checkbox">
          @endif
        </div>

        {{-- Grade --}}
        <div class="col-auto">
          <label class="col-form-label" for="grade">Calificación:</label>
        </div>
        <div class="col-xl-auto">
          <input id='grade' min='1' max="100" step="1" name='grade' value="{!! $participant->grade !!}" placeholder='Ej. 75' class="form-control" type="number">
        </div>

        {{-- Non Accredition Cause --}}
        <div class="col-xl-auto">
          <label class="col-form-label" for="nac">Causa de no acreditación:</label>
        </div>
        <div class="col-xl-5">
          <input id='nac' name='nac' value="{!! $participant->nac !!}" placeholder='Ej. El participante faltó a casi todas las clases' class="form-control" type="text">
        </div>

      </div>

      {{-- Second row --}}
      <div class="row align-items-center">

        {{-- Canceled --}}
        <div class="col-xl-auto">
          <label class="col-form-label" for="canceled">Canceló:</label>
        </div>
        <div class="col-xl-auto">
          @if($participant->canceled)
            <input id='canceled' name='canceled' checked  class="form-check-input" type="checkbox">
          @else
            <input id='canceled' name='canceled' class="form-check-input" type="checkbox">
          @endif
        </div>

        {{-- Attendance --}}
        <div class="col-xl-auto">
          <label class="col-form-label" for="attendance">Asistió:</label>
        </div>
        <div class="col-xl-auto">
          @if($participant->attendance)
            <input id='attendance' name='attendance' checked  class="form-check-input" type="checkbox">
          @else
            <input id='attendance' name='attendance' class="form-check-input" type="checkbox">
          @endif
        </div>

        {{-- Confirmation --}}
        <div class="col-xl-auto">
          <label class="col-form-label" for="confirmation">Confirmó:</label>
        </div>
        <div class="col-xl-auto">
          @if($participant->confirmation)
            <input id='confirmation' name='confirmation' checked  class="form-check-input" type="checkbox">
          @else
            <input id='confirmation' name='confirmation' class="form-check-input" type="checkbox">
          @endif
        </div>

        {{-- Additional --}}
        <div class="col-xl-auto">
          <label class="col-form-label" for="additional">Adicional:</label>
        </div>
        <div class="col-xl-auto">
          @if($participant->additional)
            <input id='additional' name='additional' checked  class="form-check-input" type="checkbox">
          @else
            <input id='additional' name='additional' class="form-check-input" type="checkbox">
          @endif
        </div>

        {{-- Mistimed --}}
        <div class="col-xl-auto">
          <label class="col-form-label" for="mistimed">Extemporáneo:</label>
        </div>
        <div class="col-xl-auto">
          @if($participant->mistimed)
            <input id='mistimed' name='mistimed' checked class="form-check-input" type="checkbox">
          @else
            <input id='mistimed' name='mistimed' class="form-check-input" type="checkbox">
          @endif
        </div>

      </div>

      {{-- Third row --}}
      <div class="row align-items-center">

        {{-- Discount --}}
        <div class="col-xl-2">
          <label class="col-form-label" for="discount">Descuento:</label>
        </div>
        <div class="col-xl-auto">
          <input id='discount' value="{!! $participant->discount !!}" name='discount' class="form-control" type="number">
        </div>

        {{-- Deposit --}}
        <div class="col-xl-2">
          <label class="col-form-label" for="deposit">Monto pagado:</label>
        </div>
        <div class="col-xl-auto">
          <input id='deposit' name='deposit' value="{!! $participant->deposit !!}" class="form-control" type="number">
        </div>

      </div>

      {{-- Fourth row --}}
      <div class="row">

        {{-- Comment --}}
        <div class="col-xl-1" style="margin-right: 6%">
          <label class="col-form-label" for="comment">Comentarios:</label>
        </div>
        <div class="col-xl-10">
          <textarea id='comment' name='comment' class="form-control" placeholder="Ej. El alumno era introvertido..." rows="5">{!! $participant->comment !!}</textarea>
        </div>

      </div>

    <div class="row">
        <div class="d-grid gap-2 col-xl-2">
            <button type="submit" id='save-btn' class="btn btn-outline-success"> Guardar </button>
        </div>
        <div class="col-2">
          <a href="{!! route("view.participants", $participant->activity_id) !!}" class="btn btn-outline-warning">Cancelar</a>
        </div>
    </div>
    </form>
  </div>
</div>
@endsection

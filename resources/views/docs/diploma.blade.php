<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Diploma| MAGESTIC</title>
</head>

<style>
  .firmas{
    width:100%;
    position: absolute;
    bottom: 9px;
    text-align:center;
  }

</style>

<body>
  <table>
    <tr>
      <th>{!! $diploma_name !!}</th>
      <th>{!! 'Duración: '.$diploma_duration !!}</th>
    </tr>

    <tr>
      <td>{!! $participant['name'].' '.$participant['last_name'].' '.$participant['mothers_last_name'] !!}</td>
    </tr>

    <tr>
      <td> Numero de módulo </td>
      <td> Nombre de módulo </td>
      <td> Calificación </td>
    </tr>

    @foreach ($participant['grades'] as $module)
      <tr>
      {{-- Numero de modulo --}}
        <td>{!! $module['number'] !!}</td>
      {{-- Nombre de modulo --}}
        <td>{!! $module['name'] !!}</td>
      {{-- Calificacion --}}
        <td>{!! $module['grade'] !!}</td>
      </tr>
    @endforeach

    <tr>
      <td>{!! 'Promedio: '.$participant['average'] !!}</td>
      <td>{!! 'Folio: '.$participant['key'] !!}</td>
      <td>{!! 'Foja: '.$page !!}</td>
      <td>{!! 'Libro: '.$book !!}</td>
    </tr>
  </table>
  <p>Ciudad Universitaria, Cd. Mx., {!! $certificate_date !!}</p>
  <div class="firmas">
    <table>
      @if($signatures == '1')
        <tr>
          <td class="signature">___________________</td>
        </tr>
        <tr>
          <td class="signatory-degree">{!! $first_degree_signature !!}</td>
        </tr>
        <tr>
          <td class="name-signatory">{!! $first_name_signature !!}</td>
        </tr>
      @elseif($signatures == '2')
        <tr>
          <td class="signature">___________________</td>
          <td class="signature">___________________</td>
        </tr>
        <tr>
          <td class="signatory-degree">{!! $first_degree_signature !!}</td>
          <td class="signatory-degree">{!! $second_degree_signature !!}</td>
        </tr>
        <tr>
          <td class="name-signatory">{!! $first_name_signature !!}</td>
          <td class="name-signatory">{!! $second_name_signature !!}</td>
        </tr>

      @elseif($signatures == '3')
        <tr>
          <td class="signature">___________________</td>
          <td class="signature">___________________</td>
          <td class="signature">___________________</td>
        </tr>
        <tr>
          <td class="signatory-degree">{!! $first_degree_signature !!}</td>
          <td class="signatory-degree">{!! $second_degree_signature !!}</td>
          <td class="signatory-degree">{!! $third_degree_signature !!}</td>
        </tr>
        <tr>
          <td class="name-signatory">{!! $first_name_signature !!}</td>
          <td class="name-signatory">{!! $second_name_signature !!}</td>
          <td class="name-signatory">{!! $third_name_signature !!}</td>
        </tr>
      @elseif($signatures == '4')
        <tr>
          <td class="signature">___________________</td>
          <td class="signature">___________________</td>
          <td class="signature">___________________</td>
          <td class="signature">___________________</td>
        </tr>
        <tr>
          <td class="signatory-degree">{!! $first_degree_signature !!}</td>
          <td class="signatory-degree">{!! $second_degree_signature !!}</td>
          <td class="signatory-degree">{!! $third_degree_signature !!}</td>
          <td class="signatory-degree">{!! $fourth_degree_signature !!}</td>
        </tr>
        <tr>
          <td class="name-signatory">{!! $first_name_signature !!}</td>
          <td class="name-signatory">{!! $second_name_signature !!}</td>
          <td class="name-signatory">{!! $third_name_signature !!}</td>
          <td class="name-signatory">{!! $fourth_name_signature !!}</td>
        </tr>
      @elseif($signatures == '5')
        <tr>
            <td class="signature">___________________</td>
            <td class="signature">___________________</td>
            <td class="signature">___________________</td>
            <td class="signature">___________________</td>
            <td class="signature">___________________</td>
          </tr>
          <tr>
            <td class="signatory-degree">{!! $first_degree_signature !!}</td>
            <td class="signatory-degree">{!! $second_degree_signature !!}</td>
            <td class="signatory-degree">{!! $third_degree_signature !!}</td>
            <td class="signatory-degree">{!! $fourth_degree_signature !!}</td>
            <td class="signatory-degree">{!! $fifth_degree_signature !!}</td>
          </tr>
          <tr>
            <td class="name-signatory">{!! $first_name_signature !!}</td>
            <td class="name-signatory">{!! $second_name_signature !!}</td>
            <td class="name-signatory">{!! $third_name_signature !!}</td>
            <td class="name-signatory">{!! $fourth_name_signature !!}</td>
            <td class="name-signatory">{!! $fifth_name_signature !!}</td>
          </tr>
          
      @endif
    </table>
  </div> 
</body>
</html>
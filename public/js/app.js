function updateCertificateCustomText() {
  let divCustomText = document.getElementById('div_custom_text');
  let select_text_opt = document.getElementById('text').value
  let inputCustomText = document.getElementById('custom_text');

  if (select_text_opt == 'custom') {
    divCustomText.style.display = 'block';
    inputCustomText.required = true;

  }
  else{
    divCustomText.style.display = 'none';
    inputCustomText.required = false;
  }
}

function updateCertificateSignatures() {
  let select_signatures_opt = document.getElementById('signatures').value

  let div_name_first_signature = document.getElementById('div_name_first_signature');
  let div_name_second_signature = document.getElementById('div_name_second_signature');
  let div_name_third_signature = document.getElementById('div_name_third_signature');
  let div_name_fourth_signature = document.getElementById('div_name_fourth_signature');
  let div_name_fifth_signature = document.getElementById('div_name_fifth_signature');

  let div_degree_first_signature = document.getElementById('div_degree_first_signature');
  let div_degree_second_signature = document.getElementById('div_degree_second_signature');
  let div_degree_third_signature = document.getElementById('div_degree_third_signature');
  let div_degree_fourth_signature = document.getElementById('div_degree_fourth_signature');
  let div_degree_fifth_signature = document.getElementById('div_degree_fifth_signature');

  let input_name_first_signature = document.getElementById('first_name_signature');
  let input_name_second_signature = document.getElementById('second_name_signature');
  let input_name_third_signature = document.getElementById('third_name_signature');
  let input_name_fourth_signature = document.getElementById('fourth_name_signature');
  let input_name_fifth_signature = document.getElementById('fifth_name_signature');

  let input_degree_first_signature = document.getElementById('first_degree_signature');
  let input_degree_second_signature = document.getElementById('second_degree_signature');
  let input_degree_third_signature = document.getElementById('third_degree_signature');
  let input_degree_fourth_signature = document.getElementById('fourth_degree_signature');
  let input_degree_fifth_signature = document.getElementById('fifth_degree_signature');

  if ( select_signatures_opt == '1' ){

    div_name_first_signature.style.display = 'block';
    div_name_second_signature.style.display = 'none';
    div_name_third_signature.style.display = 'none';
    div_name_fourth_signature.style.display = 'none';
    div_name_fifth_signature.style.display = 'none';

    div_degree_first_signature.style.display = 'block';
    div_degree_second_signature.style.display = 'none';
    div_degree_third_signature.style.display = 'none';
    div_degree_fourth_signature.style.display = 'none';
    div_degree_fifth_signature.style.display = 'none';

    input_name_first_signature.required = true;
    input_name_second_signature.required = false;
    input_name_third_signature.required = false;
    input_name_fourth_signature.required = false;
    input_name_fifth_signature.required = false;

    input_degree_first_signature.required = true;
    input_degree_second_signature.required = false;
    input_degree_third_signature.required = false;
    input_degree_fourth_signature.required = false;
    input_degree_fifth_signature.required = false;

  }
  else if (select_signatures_opt == '2') {

    div_name_first_signature.style.display = 'block';
    div_name_second_signature.style.display = 'block';
    div_name_third_signature.style.display = 'none';
    div_name_fourth_signature.style.display = 'none';
    div_name_fifth_signature.style.display = 'none';

    div_degree_first_signature.style.display = 'block';
    div_degree_second_signature.style.display = 'block';
    div_degree_third_signature.style.display = 'none';
    div_degree_fourth_signature.style.display = 'none';
    div_degree_fifth_signature.style.display = 'none';

    input_name_first_signature.required = true;
    input_name_second_signature.required = true;
    input_name_third_signature.required = false;
    input_name_fourth_signature.required = false;
    input_name_fifth_signature.required = false;

    input_degree_first_signature.required = true;
    input_degree_second_signature.required = true;
    input_degree_third_signature.required = false;
    input_degree_fourth_signature.required = false;
    input_degree_fifth_signature.required = false;

  } else if (select_signatures_opt == '3') {

    div_name_first_signature.style.display = 'block';
    div_name_second_signature.style.display = 'block';
    div_name_third_signature.style.display = 'block';
    div_name_fourth_signature.style.display = 'none';
    div_name_fifth_signature.style.display = 'none';

    div_degree_first_signature.style.display = 'block';
    div_degree_second_signature.style.display = 'block';
    div_degree_third_signature.style.display = 'block';
    div_degree_fourth_signature.style.display = 'none';
    div_degree_fifth_signature.style.display = 'none';

    input_name_first_signature.required = true;
    input_name_second_signature.required = true;
    input_name_third_signature.required = true;
    input_name_fourth_signature.required = false;
    input_name_fifth_signature.required = false;

    input_degree_first_signature.required = true;
    input_degree_second_signature.required = true;
    input_degree_third_signature.required = true;
    input_degree_fourth_signature.required = false;
    input_degree_fifth_signature.required = false;

  } else if (select_signatures_opt == '4') {

    div_name_first_signature.style.display = 'block';
    div_name_second_signature.style.display = 'block';
    div_name_third_signature.style.display = 'block';
    div_name_fourth_signature.style.display = 'block';
    div_name_fifth_signature.style.display = 'none';

    div_degree_first_signature.style.display = 'block';
    div_degree_second_signature.style.display = 'block';
    div_degree_third_signature.style.display = 'block';
    div_degree_fourth_signature.style.display = 'block';
    div_degree_fifth_signature.style.display = 'none';

    input_name_first_signature.required = true;
    input_name_second_signature.required = true;
    input_name_third_signature.required = true;
    input_name_fourth_signature.required = true;
    input_name_fifth_signature.required = false;

    input_degree_first_signature.required = true;
    input_degree_second_signature.required = true;
    input_degree_third_signature.required = true;
    input_degree_fourth_signature.required = true;
    input_degree_fifth_signature.required = false;

  } else if (select_signatures_opt == '5') {

    div_name_first_signature.style.display = 'block';
    div_name_second_signature.style.display = 'block';
    div_name_third_signature.style.display = 'block';
    div_name_fourth_signature.style.display = 'block';
    div_name_fifth_signature.style.display = 'block';

    div_degree_first_signature.style.display = 'block';
    div_degree_second_signature.style.display = 'block';
    div_degree_third_signature.style.display = 'block';
    div_degree_fourth_signature.style.display = 'block';
    div_degree_fifth_signature.style.display = 'block';

    input_name_first_signature.required = true;
    input_name_second_signature.required = true;
    input_name_third_signature.required = true;
    input_name_fourth_signature.required = true;
    input_name_fifth_signature.required = true;

    input_degree_first_signature.required = true;
    input_degree_second_signature.required = true;
    input_degree_third_signature.required = true;
    input_degree_fourth_signature.required = true;
    input_degree_fifth_signature.required = true;

  }
}
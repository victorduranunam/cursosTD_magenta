function selectGeneralRecordRouteActivityDocs(){
  let docsForm = document.getElementById('docsForm')
  let generalRecordRoute = document.getElementById('generalRecordRoute')
  docsForm.action = generalRecordRoute.name
}

function selectSuggestionsRecordRouteActivityDocs(){
  let docsForm = document.getElementById('docsForm')
  let suggetionsRecordRoute = document.getElementById('suggetionsRecordRoute')
  docsForm.action = suggetionsRecordRoute.name
}

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

function blockCreateDiv() {
  document.getElementById('create-div').style.display = "block";
}

function openNav() {
  document.getElementsByClassName("sidebar")[0].style.display='block';
  document.getElementsByClassName("sidebar")[0].style.width = "100%";
  document.getElementById("side-menu").style.display='block';
  document.getElementById("side-menu").style.width = "100%";
  document.getElementById("main").style.marginLeft = "250px";
}

  function closeNav() {
  // document.getElementsByClassName("sidebar")[0].style.display='none';
  document.getElementsByClassName("sidebar")[0].style.width = '25%';
  // document.getElementById("side-menu").style.display='none';
  document.getElementById("side-menu").style.width = '100%';
  document.getElementById("main").style.marginLeft= "0";
  if (window.innerWidth >= 360 &&  window.innerWidth <= 414){
      document.getElementsByClassName("sidebar")[0].style.display='none';
      document.getElementsByClassName("sidebar")[0].style.width = '0';
      document.getElementById("side-menu").style.display='none';
      document.getElementById("side-menu").style.width = '0';
      document.getElementById("main").style.marginLeft= "0";
  }
}

function viewRowDiploma(){
  const type = document.getElementById('type')
  const btn = document.getElementById('btn_save')
  if(type.value === 'DI'){
    if(document.getElementById('row_diploma_advice')){
      diploma = document.getElementById('row_diploma_advice')
      btn.style.visibility = 'hidden'
    }
    else if (document.getElementById('row_diploma_select')){
      diploma = document.getElementById('row_diploma_select')
      btn.style.visibility = 'visible'
    }
    diploma.style.visibility = 'visible'
  }
  else{
    btn.style.visibility = 'visible'
    diploma.style.visibility = 'hidden'
  }
}
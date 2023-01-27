function main(){
  document.getElementById("type").onload = viewRowDiploma();
}

function selectAccepatanceCriteriaReportRouteDepartmentDocs(department_id){
  let docsForm = document.getElementById('docsForm')
  let generalReportRoute = document.getElementById('departmentAccepatanceCriteriaReportRoute'+department_id)
  let typeNumSearch = document.getElementById('type_num_search')

  typeNumSearch.style.display = "none";
  docsForm.action = generalReportRoute.name
}

function selectParticipantsReportRouteDepartmentDocs(department_id){
  let docsForm = document.getElementById('docsForm')
  let generalReportRoute = document.getElementById('departmentParticipantsReportRoute'+department_id)
  let typeNumSearch = document.getElementById('type_num_search')

  typeNumSearch.style.display = "flex";
  docsForm.action = generalReportRoute.name
}

function selectEvaluationReportRouteDepartmentDocs(department_id){
  let docsForm = document.getElementById('docsForm')
  let generalReportRoute = document.getElementById('departmentEvaluationReportRoute'+department_id)
  let typeNumSearch = document.getElementById('type_num_search')

  typeNumSearch.style.display = "flex";
  docsForm.action = generalReportRoute.name
}

function selectGeneralReportRouteActivityDocs(){
  let docsForm = document.getElementById('docsForm')
  let generalReportRoute = document.getElementById('generalReportRoute')
  docsForm.action = generalReportRoute.name
}

function selectSuggestionsReportRouteActivityDocs(){
  let docsForm = document.getElementById('docsForm')
  let suggetionsReportRoute = document.getElementById('suggetionsReportRoute')
  docsForm.action = suggetionsReportRoute.name
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

function blockSearchDiv() {
  document.getElementById('search-div').style.display = "block";
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

function evaluationFormRequiredQuestion5(){
  const question_5_I = document.getElementById('question_5_I')
  const question_5_P = document.getElementById('question_5_P')
  const question_5_J = document.getElementById('question_5_J')
  const question_5_O = document.getElementById('question_5_O')

  if(question_5_I.checked || question_5_P.checked || question_5_J.checked || question_5_O.checked ){
    question_5_I.required = false
    question_5_P.required = false
    question_5_J.required = false
    question_5_O.required = false
  } else {
    question_5_I.required = true
    question_5_P.required = true
    question_5_J.required = true
    question_5_O.required = true
  }

}

function evaluationFormRequiredQuestion7(){
  const question_7_P = document.getElementById('question_7_P')
  const question_7_H = document.getElementById('question_7_H')
  const question_7_C = document.getElementById('question_7_C')
  const question_7_O = document.getElementById('question_7_O')

  if(question_7_P.checked || 
     question_7_H.checked || 
     question_7_C.checked || 
     question_7_O.checked ) {

      question_7_P.required = false
      question_7_H.required = false
      question_7_C.required = false
      question_7_O.required = false
  } else {
      question_7_P.required = true
      question_7_H.required = true
      question_7_C.required = true
      question_7_O.required = true
  }

}
<?php 

require_once(dirname(__FILE__).'/../models/Patient.php');

if(!empty($_GET['id'])) {
    $id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

    $requestResult = Patient::getFromId($id);
}
if (!isset($_GET['modify'])) {

    include(dirname(__FILE__).'/../views/templates/header.php');
    include(dirname(__FILE__).'/../views/patients/profil-patient.php');
    include(dirname(__FILE__).'/../views/templates/footer.php');
    
} else if (!empty($_GET['modify'])){
    
    include(dirname(__FILE__).'/../views/templates/header.php');
    include(dirname(__FILE__).'/../views/patients/modify-profil-patient.php');
    include(dirname(__FILE__).'/../views/templates/footer.php');
}




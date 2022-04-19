<?php 

require_once(dirname(__FILE__).'/../../models/Patient.php');


if(!empty($_GET['id'])) {
    $id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

    $requestResult = Patient::delete($id);

    if ($requestResult instanceof PDOException) {
    $patientError = $requestResult->getMessage() ;
    }


    $patientList = Patient::getAll();

    include(dirname(__FILE__).'/../../views/templates/header.php');
    include(dirname(__FILE__).'/../../views/patients/list-patient.php');
    include(dirname(__FILE__).'/../../views/templates/footer.php');
} else {
    header('location: /patients');
}
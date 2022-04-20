<?php

require_once(dirname(__FILE__) . '/../../config/config.php');
require_once(dirname(__FILE__).'/../../models/Patient.php');


if (!empty($_GET['search'])) {

    $search = trim(filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS));

    $patientList = Patient::search($search);
} else{
    $patientList = Patient::getAll();
}
$patientsPerPage = 25;
$pageNeeded = ceil((count($patientList))/$patientsPerPage);

if (!empty($_GET['page'])) { 
    $currentPage = trim(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT));
    
} else {
    $currentPage = 1;
}
$offset = ($currentPage -1 )*25;

if (!empty($_GET['search'])){

    $patientList = Patient::searchOffset($search, $offset);
} else {
    $patientList = Patient::getOffset($offset);
}


include(dirname(__FILE__).'/../../views/templates/header.php');
include(dirname(__FILE__).'/../../views/patients/list-patient.php');
include(dirname(__FILE__).'/../../views/templates/footer.php');


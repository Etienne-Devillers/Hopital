<?php
require_once(dirname(__FILE__).'/../../config/config.php');
require_once(dirname(__FILE__).'/../../models/Patient.php');

$page = intval(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT));
if ($page == 0) {
    $page = 1;
}


$search = trim(filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS));

$offset = ($page -1) * NB_PER_PAGE ;

$patientList = Patient::getAll($search, $offset, NB_PER_PAGE );

$nbPatientsTotal  = count(Patient::getAll($search)); 

$nbPages =  ceil($nbPatientsTotal / NB_PER_PAGE) ;



include(dirname(__FILE__).'/../../views/templates/header.php');
include(dirname(__FILE__).'/../../views/patients/list2-view.php');
include(dirname(__FILE__).'/../../views/templates/footer.php');
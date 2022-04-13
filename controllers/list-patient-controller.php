<?php

require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__).'/../models/Patient.php');

$patient = new Patient();

$patientList = $patient->getAll();


include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/patients/list-patient.php');
include(dirname(__FILE__).'/../views/templates/footer.php');


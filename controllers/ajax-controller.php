<?php
require_once(dirname(__FILE__).'/../models/Patient.php');

if (!empty($_GET['search'])) {

    $search = trim(filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS));

    $patientList = Patient::search($search);
$result= json_encode($patientList);
echo $result;
}
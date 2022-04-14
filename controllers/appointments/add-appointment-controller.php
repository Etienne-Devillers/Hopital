<?php

require_once(dirname(__FILE__).'/../../config/config.php');
require_once(dirname(__FILE__).'/../../models/Appointment.php');
require_once(dirname(__FILE__).'/../../models/Patient.php');

$appointment = new Appointment('2022-12-12','devillers.etienne80@gmail.com');


if ($_SERVER["REQUEST_METHOD"] == "POST") {




} else {

    $mailList = Patient::getMailList();
    include(dirname(__FILE__).'/../../views/templates/header.php');
    include(dirname(__FILE__).'/../../views/appointment/add-appointment.php');
    include(dirname(__FILE__).'/../../views/templates/footer.php');
}
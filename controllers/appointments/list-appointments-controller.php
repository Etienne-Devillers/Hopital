<?php

require_once(dirname(__FILE__).'/../../config/config.php');
require_once(dirname(__FILE__).'/../../models/Appointment.php');
require_once(dirname(__FILE__).'/../../models/Patient.php');


$appointmentList = Appointment::getAppointmentList();

$currentDate = new DateTime('now', new DateTimeZone('Europe/Paris'));

include(dirname(__FILE__).'/../../views/templates/header.php');
include(dirname(__FILE__).'/../../views/appointment/list-appointments.php');
include(dirname(__FILE__).'/../../views/templates/footer.php');
<?php 

require_once(dirname(__FILE__).'/../../models/Appointment.php');


if(!empty($_GET['id'])) {
    $id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

    $requestResult = Appointment::delete($id);

    if ($requestResult instanceof PDOException) {
    $patientError = $requestResult->getMessage() ;
    }


    $appointmentList = Appointment::getAppointmentList();

    $currentDate = new DateTime('now', new DateTimeZone('Europe/Paris'));

    include(dirname(__FILE__).'/../../views/templates/header.php');
    include(dirname(__FILE__).'/../../views/appointment/list-appointments.php');
    include(dirname(__FILE__).'/../../views/templates/footer.php');
} else {
    header('location: /appointments');
}
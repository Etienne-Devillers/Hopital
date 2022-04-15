<?php


require_once(dirname(__FILE__).'/../../models/Appointment.php');

if(!empty($_GET['id'])) {
    $id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    $modif = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));


        $requestResult = Appointment::getFromId($id);
        if ($requestResult instanceof PDOException) {
        $appointmentError = $requestResult->getMessage() ;
    
}

}


    include(dirname(__FILE__).'/../../views/templates/header.php');
    include(dirname(__FILE__).'/../../views/appointment/detail-appointment.php');
    include(dirname(__FILE__).'/../../views/templates/footer.php');
    


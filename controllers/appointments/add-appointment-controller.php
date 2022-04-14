<?php

require_once(dirname(__FILE__).'/../../config/config.php');
require_once(dirname(__FILE__).'/../../models/Appointment.php');
require_once(dirname(__FILE__).'/../../models/Patient.php');




if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //===================== email : Nettoyage et validation =======================
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

    if (!empty($email)) {
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($testEmail === false) {
            $error["email"] = "L'adresse email n'est pas au bon format!!";
        }
        $mailList = Patient::getMailList();

        $mailArray = [];
        foreach ($mailList as $key => $value) {
            array_push($mailArray, $value->mail);
        }

        if (in_array($email, $mailArray) === false) {
            $error["email"] =  'le mail n\'est pas connu';
        }


    } else {
        $error["email"] = "L'adresse mail est obligatoire!!";
    }

    //===================== date : Nettoyage et validation =======================
    $date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_INT));

    //===================== Hour : Nettoyage et validation =======================
    $hour = trim(filter_input(INPUT_POST, 'hour', FILTER_SANITIZE_NUMBER_INT));
    if (!empty($hour)) {

        if($hour<9 && $hour>18){
            $error["hour"] = "La date entrée n'est pas valide!";
        }
    }

     //===================== Minutes : Nettoyage et validation =======================
    $minutes = trim(filter_input(INPUT_POST, 'minutes', FILTER_SANITIZE_NUMBER_INT));
    if (!empty($minutes)) {
        
        if( ($minutes%15 == 0)  && $minutes<=45){
            $hour = $hour.':'.$minutes;
            $dateHour = $date.'T'.$hour;

        } else {
            $error["minutes"] = "La date entrée n'est pas valide!";
        }
    }

    //===================== appointment : Nettoyage et validation =======================
    $dateHour = trim(filter_var( $dateHour, FILTER_SANITIZE_SPECIAL_CHARS));
    if (!empty($dateHour)) {
        $dateHourObj = DateTime::createFromFormat('Y-m-d\TH:i', $dateHour);
        $currentDateObj = new DateTime();
        if($dateHourObj === false){
            $error["dateHour"] = "La date entrée n'est pas valide!";
        } else {
            $diff = $dateHourObj->diff($currentDateObj);
            if (!$dateHourObj || $diff->invert == 0 ) {
                $error["dateHour"] = "La date entrée n'est pas valide!";
            }
        }
    }

    
    if (empty($error)){

        $appointment = new Appointment($dateHour, $email);
        $appointment->add();

        header('location: /list-appointments');
    }

} else {

    $date = new Datetime;
    $actualDate = $date->format('Y-m-d');

    $date = new Datetime('+2 years') ;
    $maxDate = $date->format('Y-m-d');

    $mailList = Patient::getMailList();
    include(dirname(__FILE__).'/../../views/templates/header.php');
    include(dirname(__FILE__).'/../../views/appointment/add-appointment.php');
    include(dirname(__FILE__).'/../../views/templates/footer.php');
}
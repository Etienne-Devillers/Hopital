<?php 

require_once(dirname(__FILE__).'/../../config/config.php');
require_once(dirname(__FILE__).'/../../models/Appointment.php');
require_once(dirname(__FILE__).'/../../models/Patient.php');


$id =0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

//===================== email : Nettoyage et validation =======================
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

    if (!empty($email)) {
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($testEmail === false) {
            $error["email"] = "L'adresse email n'est pas au bon format!!";
        }
        if(Patient::isMailExist($email)){
            $error["email"] = "Ce mail existe déjà";
        }
    } else {
        $error["email"] = "L'adresse mail est obligatoire!!";
    }

//===================== Lastname : Nettoyage et validation =======================
    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
    
    if (!empty($lastname)) {
        $testRegex = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NO_NUMBER . '/')));
        
        if ($testRegex === false) {
            $error["lastname"] = "Le nom n'est pas au bon format!!";
        } else {
            
            if (strlen($lastname) <= 1 || strlen($lastname) >= 25) {
                $error["lastname"] = "La longueur du nom n'est pas bon";
            }
        }
    } else { 
        $error["lastname"] = "Vous devez entrer un nom!!";
    }

//===================== firstname : Nettoyage et validation =======================
    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));

    if (!empty($firstname)) {
        $testRegex = filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NO_NUMBER . '/')));
        
        if ($testRegex === false) {
            $error["firstname"] = "Le nom n'est pas au bon format!!";
        } else {
            
            if (strlen($firstname) <= 1 || strlen($firstname) >= 25) {
                $error["firstname"] = "La longueur du nom n'est pas bon";
            }
        }
    } else { 
        $error["lastname"] = "Vous devez entrer un nom!!";
    }
//===================== birthdate : Nettoyage et validation =======================
    $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_NUMBER_INT));

    if (!empty($birthdate)) {
        $birthdateObj = DateTime::createFromFormat('Y-m-d', $birthdate);
        $currentDateObj = new DateTime();
        if($birthdateObj === false){
            $error["birthdate"] = "La date entrée n'est pas valide!";
        } else {
            $diff = $birthdateObj->diff($currentDateObj);
            $age = $diff->days/365;
            if (!$birthdateObj || $diff->invert == 1 || $birthdateObj->format('Y-m-d') !== $birthdate || $age==0 || $age>120) {
                $error["birthdate"] = "La date entrée n'est pas valide!";
            }
        }
    }

    
//===================== phonenumber : Nettoyage et validation =======================
    $phonenumber = trim(filter_input(INPUT_POST, 'phonenumber', FILTER_SANITIZE_NUMBER_INT));
    if (!empty($phonenumber)) {
        $testPhoneNumber = filter_var($phonenumber, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NUMBER . '/')));
        if ($testPhoneNumber === false) {
            $error["phonenumber"] = "Le numéro de téléphone n'est pas au bon format!!";
        }
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
    $minutes = intval(filter_input(INPUT_POST, 'minutes', FILTER_SANITIZE_NUMBER_INT));

    if (!empty($minutes) || $minutes == 0) {
        if( (($minutes%15 == 0)  && ($minutes<=45))){

            $hour = ($minutes == 0) ? $hour = $hour.':00': $hour = $hour.':'.$minutes;
            $dateHour = $date.'T'.$hour;

        } else {
            $error["minutes"] = "La date entrée n'est pas valide!";
        }
    }
//===================== datehour : Nettoyage et validation =======================
    $dateHour = trim(filter_var($dateHour, FILTER_SANITIZE_SPECIAL_CHARS));
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

    include(dirname(__FILE__).'/../../views/templates/header.php');

    if (empty($error)) {
        $newPatient = new Patient($lastname, $firstname, $birthdate, $phonenumber, $email);
    
        $newPatient->addWithAppointment($dateHour);
        $requestResult = 'Le nouveau patient et son rendez vous ont bien été enregistré.';
        
        header('location: /patients');
        

    } else {

        include(dirname(__FILE__).'/../../views/patients/add-patient.php');

    }
    include(dirname(__FILE__).'/../../views/templates/footer.php');
}
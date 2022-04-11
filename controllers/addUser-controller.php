<?php 
require_once(dirname(__FILE__).'/../config/db.php');
include(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__).'/../models/Patient.php');
include(dirname(__FILE__).'/../views/templates/header.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {

//===================== email : Nettoyage et validation =======================
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

    if (!empty($email)) {
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$testEmail) {
            $error["email"] = "L'adresse email n'est pas au bon format!!";
        }
    } else {
        $error["email"] = "L'adresse mail est obligatoire!!";
    }

//===================== Lastname : Nettoyage et validation =======================
    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
    
    if (!empty($lastname)) {
        $testRegex = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NO_NUMBER . '/')));
        
        if (!$testRegex) {
            $error["lastname"] = "Le nom n'est pas au bon format!!";
        } else {
            
            if (strlen($lastname) <= 1 || strlen($lastname) >= 70) {
                $error["lastname"] = "La longueur du nom n'est pas bon";
            }
        }
    } else { 
        $error["lastname"] = "Vous devez entrer un nom!!";
    }

//===================== firstname : Nettoyage et validation =======================
    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));

    if (!empty($firstname)) {
        $testRegex = filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NO_NUMBER . '/')));
        
        if (!$testRegex) {
            $error["firstname"] = "Le nom n'est pas au bon format!!";
        } else {
            
            if (strlen($firstname) <= 1 || strlen($firstname) >= 70) {
                $error["firstname"] = "La longueur du nom n'est pas bon";
            }
        }
    } else { 
        $error["lastname"] = "Vous devez entrer un nom!!";
    }
//===================== birthdate : Nettoyage et validation =======================
    $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_NUMBER_INT);

    if (!empty($birthdate)) {
        $birthdateObj = DateTime::createFromFormat('Y-m-d', $birthdate);
        $currentDateObj = new DateTime();
        if(!$birthdateObj){
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
        if (!$testPhoneNumber) {
            $error["phonenumber"] = "Le numéro de téléphone n'est pas au bon format!!";
        }
    } else {
        $error["phonenumber"] = "Le numéro de téléphone est obligatoire!!";
    }
}

if (!empty($error) || $_SERVER['REQUEST_METHOD'] == 'GET') {
    include(dirname(__FILE__).'/../views/ajout-patient.php');
} else if (empty($error) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $newPatient = new Patient($lastname, $firstname, $birthdate, $phonenumber, $email);
    $newPatient->add($sql);
    include(dirname(__FILE__).'/../views/formOk.php');
}



include(dirname(__FILE__).'/../views/templates/footer.php');


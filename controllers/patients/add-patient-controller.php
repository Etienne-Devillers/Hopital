<?php 

require_once(dirname(__FILE__).'/../../config/config.php');
require_once(dirname(__FILE__).'/../../models/Patient.php');

$verifPdo = true;
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

//===================== id : Nettoyage et validation =======================
    $id = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
    if (!empty($id)) {
        $testid = filter_var($id, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NUMBER . '/')));
        if ($testid === false) {
            $error["id"] = "l'id n'existe pas";
        }
    } 
}



include(dirname(__FILE__).'/../../views/templates/header.php');


if ($id != 0){
    $newPatient = new Patient($lastname, $firstname, $birthdate, $phonenumber, $email);
    var_dump($newPatient);
    $newPatient->setId($id);
    $verifPdo = $newPatient->update();
    header('location: ./profil-patient-controller.php?id='.$id.'');
}

if (!empty($error) || $_SERVER['REQUEST_METHOD'] == 'GET') {

    include(dirname(__FILE__).'/../../views/patients/add-patient.php');

} else if (empty($error) && $_SERVER['REQUEST_METHOD'] == 'POST') {

    
    try {
            
            $newPatient = new Patient($lastname, $firstname, $birthdate, $phonenumber, $email);
            $verifPdo = $newPatient->add();
    
        
    }catch(PDOException $e) {
    echo $pdo . "<br>" . $e->getMessage();
    }

    if ($verifPdo === true) {
        header('location: /patients') ;
    } else {
        include(dirname(__FILE__).'/../../views/patients/add-patient.php');
    }
}



include(dirname(__FILE__).'/../../views/templates/footer.php');


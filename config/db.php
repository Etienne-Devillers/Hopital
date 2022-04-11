<?php

define('DSN', 'mysql:host=localhost;dbname=hospitale2n;charset=utf8');
define('USERDB', 'hospitalAdmin');
define('PWD', '_!CY1P-yR_q)1eg]');

try{
    $pdo = new PDO(DSN, USERDB, PWD);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); 
}
catch(PDOException $e){
    $pdoError =  'erreur de connexion à la BDD : '. $e->getMessage();
}
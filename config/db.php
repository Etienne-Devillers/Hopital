<?php

define('DSN', 'mysql:host=localhost;dbname=hospitale2n;charset=utf8');
define('USERDB', 'hospitalAdmin');
define('PWD', '_!CY1P-yR_q)1eg]');




class Database {

    private static $pdo;
    
    public static function dbConnect():object{
    
            try{
                if (is_null(self::$pdo)){
                    self::$pdo = new PDO(DSN, USERDB, PWD);
                    self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                }
                
            }
            catch(PDOException $e){
                header('location: /controllers/error-controller.php?id=1');
            }

            return self::$pdo;
    }


}
<?php


require_once(dirname(__FILE__).'/../config/db.php');

class Patient{


    private object $pdo;
    private string $id;
    private string $lastname;
    private string $firstname;
    private string $birthdate;
    private string $phone;
    private string $email;



    /**
     * @param string $table
     * @param string $lastname
     * @param string $firstname
     * @param string $birthdate
     * @param string $phone
     * @param string $email
     * 
     *      méthode magique __construct, nécessite les champs à ajouter à la table.
     * */
    public function __construct(string $lastname = '', string $firstname = '', string $birthdate = '', string $phone = '', string $email = ''){
        $this->setLastname($lastname);
        $this->setFirstname($firstname);
        $this->setBirthdate($birthdate);
        $this->setPhone($phone);
        $this->setEmail($email);
        $this->pdo = Database::dbConnect();
        
    }



//Section SET


    /**
     * @param int $id
     * @return void
     */
    public function setId($id):void{
        $this->id = $id ;
    }

    /**
     * @param string $lastname
     * @return void
     */
    public function setLastname($lastname):void {
        $this->lastname = $lastname;
    }

    /**
     * @param string $firstname
     * @return void
     */
    public function setFirstname($firstname):void {
        $this->firstname = $firstname;
    }

    /**
     * @param string $birthdate
     * @return void
     */
    public function setBirthdate($birthdate):void {
        $this->birthdate = $birthdate;
    }

    /**
     * @param string $phone
     * @return void
     */
    public function setPhone($phone):void {
        $this->phone = $phone;
    }

    /**
     * @param string $email
     * @return void
     */
    public function setEmail($email):void {
        $this->email = $email;
    }

//Section GET


    /**
     *
     * @return int
     */
    public function getId():string {
        return $this->id ;
    }

    /**
     *
     * @return string
     */
    public function getLastname():string {
        return $this->lastname ;
    }
    

    /**
     *
     * @return string
     */
    public function getFirstname():string {
        return $this->firstname ;
    }

    /**
     *
     * @return string
     */
    public function getBirthdate():string {
        return $this->birthdate ;
    }

    /**
     *
     * @return string
     */
    public function getPhone():string {
        return $this->phone ;
    }

    /**
     *
     * @return string
     */
    public function getEmail():string {
        return $this->email ;
    }


// Section méthodes

    public function add(){

        try {
            $sth = $this->pdo->prepare('INSERT INTO `patients` ( `lastname`, `firstname`, `birthdate`, `phone`, `mail`)
                                        VALUES (:lastname, :firstname, :birthdate, :phone, :email)');
                            $sth->bindValue(':lastname', $this->getLastname(), PDO::PARAM_STR);
                            $sth->bindValue(':firstname', $this->getFirstname(), PDO::PARAM_STR);
                            $sth->bindValue(':birthdate', $this->getBirthdate(), PDO::PARAM_STR);
                            $sth->bindValue(':phone', $this->getPhone(), PDO::PARAM_STR);
                            $sth->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            $verifPdo = $sth->execute();
            return $verifPdo;
        } catch(PDOException $exception)
        {
            $verifPdo = false;
            return $verifPdo;
        }
        

    }

    public function update(){

        try {
            $sth = $this->pdo->prepare('UPDATE `patients`
                                        SET `id` = :id,
                                            `firstname` = :firstname,
                                            `lastname` = :lastname,
                                            `birthdate` = :birthdate,
                                            `phone` = :phone,
                                            `mail` = :mail
                                        WHERE `id` = :id
                                        ');
                            
                            $sth->bindValue(':id', $this->getId(), PDO::PARAM_INT);
                            $sth->bindValue(':lastname', $this->getLastname(), PDO::PARAM_STR);
                            $sth->bindValue(':firstname', $this->getFirstname(), PDO::PARAM_STR);
                            $sth->bindValue(':birthdate', $this->getBirthdate(), PDO::PARAM_STR);
                            $sth->bindValue(':phone', $this->getPhone(), PDO::PARAM_STR);
                            $sth->bindValue(':mail', $this->getEmail(), PDO::PARAM_STR);
            $verifPdo = $sth->execute();
            return $verifPdo;
        } catch(PDOException $exception)
        {
            $verifPdo = false;
            return $verifPdo;
        }
        

    }

    public static function getAll():array {

        $request = 'SELECT `id`,
                    `lastname`,
                    `firstname`,
                    DATE_FORMAT(`birthdate`, "%d-%m-%Y") as `birthdate`,
                    `phone`,
                    `mail`
                    FROM `patients`';
        
        try {
            $sth = Database::dbConnect()->query($request);
            
            if (!$sth) {
                throw new PDOException();
            }    

            $requestResult = $sth->fetchAll();        
            return $requestResult;

        } catch(PDOException $e) {
            // header('location: /controllers/error-controller.php?id=2');
            return [];
        }
    }

    public static function getFromId($id) {

        try {
        $sth = Database::dbConnect()->prepare('SELECT `id`,
        `lastname`,
        `firstname`,
        DATE_FORMAT(`birthdate`, "%d-%m-%Y") as `birthdate`,
        `phone`,
        `mail`
        FROM `patients`
        WHERE `id` = :id ');
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
    
        $requestResult = $sth->fetchAll();        
        return $requestResult;

        } catch(PDOException $exception) {
            $verifPdo = false;
            return $verifPdo;
        }
    }

    public static function isMailExist(string $email):bool {

        try {

            $sth = Database::dbConnect()->prepare(' SELECT 
                                                    `mail`
                                                    FROM `patients`
                                                    WHERE `mail` = :mail ');

            $sth->bindValue(':mail', $email, PDO::PARAM_STR);
            $sth->execute();
        
            return (empty($sth->fetchAll())) ? false : true ;
            

        } catch(PDOException $exception) {
            $verifPdo = false;
            return $verifPdo;
        }
    }

    public static function getIdFromMail($email) {
        
        try {

            $sth = Database::dbConnect()->prepare(' SELECT 
                                                    `id`
                                                    FROM `patients`
                                                    WHERE `mail` = :mail ');

            $sth->bindValue(':mail', $email, PDO::PARAM_STR);
            $sth->execute();
        
            if (!$sth) {
                throw new PDOException();
            }

            $result = $sth->fetchAll();
            return $result;
            

        } catch(PDOException $exception) {
            // header('location: /controllers/error-controller.php?id=2');
            return [];
        }
        
    }

    public static function getMailList() {
        
        try {

            $sth = Database::dbConnect()->query(' SELECT 
                                                    `mail`
                                                    FROM `patients`
                                                    ');
            if (!$sth) {
                throw new PDOException();
            }

            $result = $sth->fetchAll();
            return $result;
            

        } catch(PDOException $exception) {
            // header('location: /controllers/error-controller.php?id=2');
            return [];
        }
        
    }
}

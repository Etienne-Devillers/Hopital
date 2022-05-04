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

    public static function getAll( $search = '', $offset = 0, $limit = null):array {

        $request = 'SELECT `id`,
                    `lastname`,
                    `firstname`,
                    DATE_FORMAT(`birthdate`, "%d-%m-%Y") as `birthdate`,
                    `phone`,
                    `mail`
                    FROM `patients`' ;

                    if ($search !== ''){
                        $request .= ' WHERE `lastname` LIKE :search
                                        OR `firstname` LIKE :search
                                        OR `birthdate` LIKE :search
                                        OR `phone` LIKE :search
                                        OR `mail` LIKE :search' ;
                    }

                    if (!is_null($limit)){
                        $request .= ' LIMIT :offset, :limit' ;
                    }

        $request .= ';';
        
        try {
            $sth = Database::dbConnect()->prepare($request);
            
            if (!$sth) {
                throw new PDOException();
            }    

            if ($search !== ''){
                $sth -> bindValue(':search', "%$search%", PDO::PARAM_STR );
                
            }

            if (!is_null($limit)){
                $sth -> bindValue(':offset', $offset, PDO::PARAM_INT );
                $sth -> bindValue(':limit', $limit, PDO::PARAM_INT );
            }

            $sth->execute();
            $requestResult = $sth->fetchAll();        
            return $requestResult;

        } catch(PDOException $e) {
            // header('location: /controllers/error-controller.php?id=2');
            return [];
        }
    }

    public static function getOffset($offset):array {

        $request = 'SELECT `id`,
                    `lastname`,
                    `firstname`,
                    DATE_FORMAT(`birthdate`, "%d-%m-%Y") as `birthdate`,
                    `phone`,
                    `mail`
                    FROM `patients`
                    LIMIT :offset,
                    25 ';
        
        try {
            $sth = Database::dbConnect()->prepare($request);
            
            if (!$sth) {
                throw new PDOException();
            }    
            $sth->bindvalue(':offset', $offset, PDO::PARAM_INT);
            $sth->execute();
            $requestResult = $sth->fetchAll();        
            return $requestResult;

        } catch(PDOException $e) {
            // header('location: /controllers/error-controller.php?id=2');
            return [];
        }
    }

    public static function getFromId(int $id):object {

        try {
            $sth = Database::dbConnect()->prepare('SELECT `id`,
            `lastname`,
            `firstname`,
            DATE_FORMAT(`birthdate`, "%d-%m-%Y") as `birthdate`,
            `phone`,
            `mail`
            FROM `patients`
            WHERE `id` = :id ;');
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
            $verif = $sth->execute();
                
            if (!$verif) {
                throw new PDOException();
            } else {
                $requestResult = $sth->fetch();
                if (!$requestResult) {
                    throw new PDOException();
                }
            }

            return $requestResult;

        } catch(PDOException $e) {
            return $e;
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

    public static function getAppointment($id) {
        
        try {

            $sth = Database::dbConnect()->prepare(' SELECT 
                                                    `dateHour`, `id`
                                                    FROM `appointments`
                                                    WHERE `idPatients` = :id
                                                    ;');
            if (!$sth) {
                throw new PDOException();
            }

            $sth->bindValue(':id', $id, PDO::PARAM_INT);
            $sth->execute();
            $result = $sth->fetchAll();
            return $result;
            

        } catch(PDOException $exception) {
            // header('location: /controllers/error-controller.php?id=2');
            return [];
        }
        
    }

    public static function delete($id) {
        
        $request = 'DELETE 
        FROM `appointments` 
        WHERE `appointments`.`idPatients` = :id ;';

        $request2 = 'DELETE 
        FROM `patients` 
        WHERE `patients`.`id` = :id ;';
        try {

            $sth = Database::dbConnect()->prepare( $request);
            
            if (!$sth) {
                throw new PDOException();
            }

            $sth2 = Database::dbConnect()->prepare($request2);

            if (!$sth2) {
                throw new PDOException();
            }

            $sth->bindValue(':id', $id, PDO::PARAM_INT);
            $sth2->bindValue(':id', $id, PDO::PARAM_INT);
            $sth->execute();
            $sth2->execute(); 
            
            return 'le patient a bien était supprimé de la base de données ainsi que ses RDV.';

        } catch(PDOException $exception) {
            // header('location: /controllers/error-controller.php?id=2');
            return 'Il y\'a eu une erreur lors de la suppression du patient.';
        }
        
    }

    public static function search($search) {
        
        $request = "SELECT `id`, `lastname`, `firstname`, `birthdate`, `phone`, `mail`
                    FROM `patients`
                    WHERE `lastname` LIKE :query
                    OR `firstname` LIKE :query
                    OR `birthdate` LIKE :query
                    OR `phone` LIKE :query
                    OR `mail` LIKE :query ;";


        try {

            $sth = Database::dbConnect()->prepare($request);
            
            if (!$sth) {
                throw new PDOException();
            }

            $sth->bindValue(':query', '%'.$search.'%', PDO::PARAM_STR);
            $sth->execute();
            
            return $sth->fetchAll();
            
            

        } catch(PDOException $exception) {
            // header('location: /controllers/error-controller.php?id=2');
            return 'Aucun patient trouvé';
        }
        
    }

    public static function searchOffset($search, $offset) {
        
        $request = "SELECT `id`, `lastname`, `firstname`, `birthdate`, `phone`, `mail`
                    FROM `patients`
                    WHERE `lastname` LIKE :query
                    OR `firstname` LIKE :query
                    OR `birthdate` LIKE :query
                    OR `phone` LIKE :query
                    OR `mail` LIKE :query 
                    LIMIT :offset, 25;";


        try {

            $sth = Database::dbConnect()->prepare($request);
            
            if (!$sth) {
                throw new PDOException();
            }

            $sth->bindValue(':query', '%'.$search.'%', PDO::PARAM_STR);
            $sth->bindValue(':offset', $offset, PDO::PARAM_INT);
            $sth->execute();
            
            return $sth->fetchAll();
            
            

        } catch(PDOException $exception) {
            // header('location: /controllers/error-controller.php?id=2');
            return 'Aucun patient trouvé';
        }
        
    }

    public  function addWithAppointment($dateHour) {
        
        $request = "INSERT INTO `patients` ( `lastname`, `firstname`, `birthdate`, `phone`, `mail`)
        VALUES (:lastname, :firstname, :birthdate, :phone, :email);";

        $request2="INSERT INTO `appointments` ( `dateHour`, `idPatients`)
            VALUES (:datehour, :idpatient);" ;

        try {
            $this->pdo->beginTransaction();

                $sth = $this->pdo->prepare($request);
                if (!$sth) {
                    throw new PDOException();
                }
                $sth2 = $this->pdo->prepare($request2);
                if (!$sth2) {
                    throw new PDOException();
                }
            
            

                $sth->bindValue(':lastname', $this->getLastname(), PDO::PARAM_STR);
                $sth->bindValue(':firstname', $this->getFirstname(), PDO::PARAM_STR);
                $sth->bindValue(':birthdate', $this->getBirthdate(), PDO::PARAM_STR);
                $sth->bindValue(':phone', $this->getPhone(), PDO::PARAM_STR);
                $sth->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
                $sth->execute();
                
                $lastId = $this->pdo->lastInsertid();

                $sth2->bindValue(':datehour', $dateHour, PDO::PARAM_STR);
                $sth2->bindValue(':idpatient', $lastId, PDO::PARAM_INT); 
                $sth2->execute();

            if (!$sth || !$sth2) {
                $this->pdo->rollback();
                throw new PDOException();
            } else {
                $this->pdo->commit();
            }
        } catch(PDOException $exception) {
            // header('location: /controllers/error-controller.php?id=2');
            return 'Aucun patient trouvé';
        }
        
    }
}

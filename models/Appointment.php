<?php 

require_once(dirname(__FILE__).'/../config/db.php');

class Appointment {

    private object $pdo;
    private string $dateHour;
    private int $idPatient;
    private int $id;


    public function __construct($dateHour, $email){

        $this->setDateHour($dateHour);
        $this->setIdPatientFromMail($email);
        $this->pdo = Database::dbConnect();

    }


// Section Set

    /**
     * @param int $id
     * @return void
     */
        public function setDateHour(string $dateHour):void{
        $this->dateHour = $dateHour ;
    }

    /**
     * @param string $lastname
     * @return void
     */
    public function setIdPatient( int $idPatient):void {
        $this->idPatient = $idPatient;
    }

    /**
     * @param string $lastname
     * @return void
     */
    public function setId( int $id):void {
        $this->id = $id;
    }

    /**
     * @param string $lastname
     * @return void
     */
    public  function setIdPatientFromMail( $email):void {
        $idRequest = Patient::getIdFromMail($email);
        $this->idPatient = $idRequest[0]->id;

    }




// Section Get

    /**
     * @param int $id
     * @return void
     */
    public function getDateHour():string{
        return $this->dateHour ;
    }

    /**
     * @param string $lastname
     * @return void
     */
    public function getIdPatient():int {
        return $this->idPatient ;
    }

    /**
     * @param string $lastname
     * @return void
     */
    public function getId():int {
        return $this->id ;
    }
    
//Section Méthodes

    public function add(){

        try {

            $sth = $this->pdo->prepare('INSERT INTO `appointments` ( `dateHour`, `idPatients`)
                                        VALUES (:datehour, :idpatient)');
                            $sth->bindValue(':datehour', $this->getDateHour(), PDO::PARAM_STR);
                            $sth->bindValue(':idpatient', $this->getIdPatient(), PDO::PARAM_INT);

            $sth->execute();
            
        } catch(PDOException $e)
        {
            
        }
        
    }

    public function update($id){

        try {

            $sth = Database::dbconnect() -> prepare
            ("UPDATE appointments 
            SET 
            dateHour = :dateHour,
            idPatients = :idPatients
            WHERE id = :id
            ");
            $request ='UPDATE `appointments` 
            SET 
            `dateHour` = :dateHour,
            `idPatients` = :idPatients
            WHERE `id` = :id;'; 

            $sth = $this->pdo->prepare($request);
                            $sth->bindValue(':dateHour', $this->getDateHour(), PDO::PARAM_STR);
                            $sth->bindValue(':idPatients', $this->getIdPatient(), PDO::PARAM_INT);
                            $sth->bindValue(':id', $id, PDO::PARAM_INT);

            $sth->execute();
            
        } catch(PDOException $e)
        {
            
        }
        
    }

    public static function getAppointmentList() {
        
        try {

            $sth = Database::dbConnect()->query(' SELECT 
                                                    `dateHour`, `lastname`, `firstname`, `phone`, `mail`, `appointments`.`id`
                                                    FROM `appointments`, `patients`
                                                    WHERE `patients`.`id` = `appointments`.`idPatients`
                                                    ORDER BY `dateHour`
                                                    ;');
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

    public static function getFromId(int $id):object {

        $request =  'SELECT 
                    `dateHour`, `lastname`, `firstname`, `phone`, `mail`,`appointments`.`id`
                    FROM `appointments`, `patients`
                    WHERE `patients`.`id` = `appointments`.`idPatients`
                    AND `appointments`.`id` = :id
                    ;';

        try {
            $sth = Database::dbConnect()->prepare($request);
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


    public static function delete($id) {
            

        $request = 'DELETE 
            FROM `appointments` 
            WHERE `appointments`.`id` = :id ;';

        try {

            $sth = Database::dbConnect()->prepare($request);
            
            if (!$sth) {
                throw new PDOException();
            }
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
            $sth->execute(); 
            
            return 'le rdv a bien était supprimé.';

        } catch(PDOException $exception) {
            // header('location: /controllers/error-controller.php?id=2');
            return 'Il y\'a eu une erreur lors de la suppression du rdv.';
        }
        
    }

}
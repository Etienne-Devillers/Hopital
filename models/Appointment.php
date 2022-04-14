<?php 

require_once(dirname(__FILE__).'/../config/db.php');

class Appointment {

    private object $pdo;
    private string $dateHour;
    private int $idPatient;


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
    
//Section Méthodes

    public function add(){

        try {
            $sth = $this->pdo->prepare('INSERT INTO `appointments` ( `dateHour`, `idPatients`)
                                        VALUES (:datehour, :idpatient)');
                            $sth->bindValue(':datehour', $this->getDateHour(), PDO::PARAM_STR);
                            $sth->bindValue(':idpatient', $this->getIdPatient(), PDO::PARAM_INT);

            $verifPdo = $sth->execute();
            return $verifPdo;
        } catch(PDOException $exception)
        {
            $verifPdo = false;
            return $verifPdo;
        }
        
    }

    public static function getAppointmentList() {
        
        try {

            $sth = Database::dbConnect()->query(' SELECT 
                                                    `dateHour`, `lastname`, `firstname`, `phone`, `mail`
                                                    FROM `appointments`, `patients`
                                                    WHERE `patients`.`id` = `appointments`.`idPatients`
                                                    ORDER BY `dateHour`
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
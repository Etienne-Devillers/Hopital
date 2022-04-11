<?php




class Patient{

    private string $table;
    private string $lastname;
    private string $firstname;
    private string $birthdate;
    private string $phonenumber;
    private string $email;



    /**
     * @param string $table
     * @param string $lastname
     * @param string $firstname
     * @param string $birthdate
     * @param string $phonenumber
     * @param string $email
     * 
     *      méthode magique __construct, nécessite les champs à ajouter à la table.
     * */
    public function __construct(string $lastname, string $firstname, string $birthdate, string $phonenumber, string $email){
        $this->setLastname($lastname);
        $this->setFirstname($firstname);
        $this->setBirthdate($birthdate);
        $this->setPhonenumber($phonenumber);
        $this->setEmail($email);
    }



//Section SET


    /**
     * @param string $lastname
     * @return void
     */
    public function setLastname($lastname):void {
        $this->$lastname = $lastname;
    }

    /**
     * @param string $firstname
     * @return void
     */
    public function setFirstname($firstname):void {
        $this->$firstname = $firstname;
    }

    /**
     * @param string $birthdate
     * @return void
     */
    public function setBirthdate($birthdate):void {
        $this->$birthdate = $birthdate;
    }

    /**
     * @param string $phonenumber
     * @return void
     */
    public function setPhonenumber($phonenumber):void {
        $this->$phonenumber = $phonenumber;
    }

    /**
     * @param string $email
     * @return void
     */
    public function setEmail($email):void {
        $this->$email = $email;
    }

//Section GET

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
    public function getPhonenumber():string {
        return $this->phonenumber ;
    }

    /**
     *
     * @return string
     */
    public function getEmail():string {
        return $this->email ;
    }


// Section méthodes

    public function add($sql){

    $sth = $sql->prepare('INSERT INTO `patients( `lastname`, `firstname`, `birthdate`, `phonenumber`, `email`)
                        VALUES (:lastname, :fisrtname, :birthdate, :phonenumber, :email)');
                        $sth->bindValue(':lastname',$this->getLastname(), PDO::PARAM_STR);
                        $sth->bindValue(':firstname',$this->getFirstname(), PDO::PARAM_STR);
                        $sth->bindValue(':birthdate',$this->getBirthdate(), PDO::PARAM_STR);
                        $sth->bindValue(':phonenumber',$this->getPhonenumber(), PDO::PARAM_STR);
                        $sth->bindValue(':email',$this->getEmail(), PDO::PARAM_STR);
    $sth->execute();
    
    }
}

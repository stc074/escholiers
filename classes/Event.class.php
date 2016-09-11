<?php


/**
 * Description of Event
 *
 * @author pj
 */
class Event extends Objet {
    
    private $idSpectacle=0;
    private $idSalle=0;
    private $date="";
    //
    private $idSpectacleValidator=NULL;
    private $idSalleValidator=NULL;
    private $dateValidator=NULL;
    
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
        $this->idSpectacleValidator=new IdValidator();
        $this->idSalleValidator=new IdValidator();
        $this->dateValidator=new DateValidator();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function verifFormInput() {
        if(isset($_POST["subm"], $_POST["idSpectacle"], $_POST["idSalle"], $_POST["date"])) {
            $this->getPostsInsert();
            $this->verifPostsInsert();
            if(Validator::getOK()) {
                $this->insertDate();
            }
        }
    }
    
    private function getPostsInsert() {
        $this->idSpectacle=  addslashes(htmlspecialchars($_POST["idSpectacle"]));
        $this->idSalle=  addslashes(htmlspecialchars($_POST["idSalle"]));
        $this->date=  addslashes(htmlspecialchars($_POST["date"]));
    }
    
    private function verifPostsInsert() {
        Validator::setOK(TRUE);
        $this->idSpectacleValidator->validate($this->idSpectacle);
        $this->idSalleValidator->validate($this->idSalle);
        $this->dateValidator->validate($this->date);
    }
    
    private function insertDate() {
        $array=  explode(' ', $this->date);
        $arrayDate=explode('/', $array[0]);
        $arrayHoraire=explode(':', $array[1]);
        //$day=$arrayDate[0];
        //$month=$arrayDate[1];
        //$year=$arrayDate[2];
        list($day, $month, $year)=$arrayDate;
        //$hour=$arrayHoraire[0];
        //$minute=$arrayHoraire[1];
        list($hour, $minute)=$arrayHoraire;
        //
        $query="INSERT INTO table_evenements (id_spectacle, id_salle, horaire, tstp) VALUES (?,?,?,?)";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->idSpectacle,
            $this->idSalle,
            $year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':00',
            time()
        );
        $sth->execute($array);
        $this->message="Date $day-$month-$year à $hour:$minute enregistrée.";
        $this->blank();
        $this->test=1;
    }
    
    public function getGets() {
        if(isset($_GET["idSpectacle"])) {
            $this->idSpectacle=  addslashes(htmlspecialchars($_GET["idSpectacle"]));
            $this->idSalle=0;
        }
    }
    
    public function getValidator($validator) {
        switch ($validator) {
            case 'idSpectacle':
                return $this->idSpectacleValidator;
                break;
            case 'idSalle':
                return $this->idSalleValidator;
                break;
            case 'date':
                return $this->dateValidator;
                break;
        }
        return new Validator();
    }
    
    public function blank() {
        parent::blank();
        $this->date="";
    }
    
    public function getIdSpectacle() {
        return $this->idSpectacle;
    }
    
    public function getIdSalle() {
        return $this->idSalle;
    }
    
    public function getDate() {
        return str_replace('\\', '', $this->date);
    }
}

?>

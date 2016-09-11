<?php
/**
 * Description of Salle
 *
 * @author pj
 */
class Salle extends Objet {
    
    private $libelle="";
    private $id=0;
    private $idSpectacle=0;
    
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
     public function initNew() {
        if(isset($_GET["init"])) {
            unset($_SESSION["libelle"]);
        }
        if(isset($_SESSION["libelle"])) {
            $this->libelle=$_SESSION["libelle"];
        }
        if(isset($_GET["idSpectacle"])) {
           $this->idSpectacle=  addslashes(htmlspecialchars($_GET["idSpectacle"]));
        }
    }
    
    public function verifFormNew() {
        if(isset($_POST["subm"])) {
            $this->getPostsNew();
            $this->verifPostsNew();
            if(empty($this->errorMsg)) {
                $this->insertNew();
            }
        }
    }
    
  
    private function getPostsNew() {
        $this->idSpectacle=  addslashes(htmlspecialchars($_POST["idSpectacle"]));
        $_SESSION["libelle"]=$this->libelle=  addslashes(htmlspecialchars($_POST["libelle"]));
    }

    private function verifPostsNew() {
        if(empty($this->idSpectacle)) {
            $this->errorMsg.="Veuillez choisir un SPECTACLE SVP.<br/>";
        }
        //compte les spectacle ayant le même libellé
        $sth=NULL;
        $array=array();
        $nb=0;
        $query="SELECT COUNT(id) AS nb FROM table_salles WHERE id_spectacle=? AND libelle=?";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->idSpectacle,
            $this->libelle
        );
        $sth->execute($array);
        $row=$sth->fetchObject();
        if($row!=NULL) {
            $nb=$row->nb;
        }
        //tests
        if(empty($this->libelle)) {
            $this->errorMsg.="Champ LIBELLÉ vide.<br/>";
        } elseif(strlen($this->libelle)>100) {
            $this->errorMsg.="Champ LIBELLÉ trop long (100 Car. maxi).<br/>";
        } elseif($nb>0) {
            $this->errorMsg.="Une salle du même nom existe déjà pour ce spectacle.<br/>";
        }
    }
    
    private function insertNew() {
        $sth=NULL;
        $array=array();
        $query="INSERT INTO table_salles (id_spectacle, libelle, tstp) VALUES (?,?,?)";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->idSpectacle,
            $this->libelle,
            time()
        );
        $sth->execute($array);
        $this->message='Salle "'.$this->getLibelle().'" enregistrée !';
        $this->blank();
        $this->test=1;
    }

    public function blank() {
        parent::blank();
        $this->idSpectacle=0;
        $this->libelle="";
        unset($_SESSION["libelle"]);
    }


    public function getLibelle() {
        return str_replace('\\', '', $this->libelle);
    }
    
    public function setLibelle($libelle) {
        $this->libelle=$libelle;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getIdSpectacle() {
        return $this->idSpectacle;
    }
}

?>

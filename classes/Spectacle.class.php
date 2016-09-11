<?php
/**
 * Description of Spectacle
 *
 * @author pj
 */
class Spectacle extends Objet {
    
    private $id=0;
    private $libelle="";
    private $content="";
    private $title="";
    private $description="";
    private $idPres=0;
    //
    private $idSpectacleValidator=NULL;
    private $contentValidator=NULL;
    private $titleValidator=NULL;
    private $descriptionValidator=NULL;
    
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
        $this->idSpectacleValidator=new IdValidator();
        $this->contentValidator=new TextFieldValidator();
        $this->titleValidator=new TextFieldValidator();
        $this->descriptionValidator=new TextFieldValidator();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    private function getPostNew() {
        $this->libelle=  addslashes(htmlspecialchars($_POST["libelle"]));
    }
    
    private function verifPostNew() {
        //teste si un spectacle ayant le même libellé existe dans la base
        $nb=0;
        $sth=NULL;
        $array=array();
        $query="SELECT COUNT(id) AS nb FROM table_spectacles WHERE libelle=?";
        $sth=$this->dbh->prepare($query);
        $array=array($this->libelle);
        $sth->execute($array);
        $row=$sth->fetchObject();
        if($row!=NULL) {
            $nb=$row->nb;
        }
        if(empty($this->libelle)) {
            $this->errorMsg.="LIBELLÉ du nouveau spectacle vide.<br/>";
        } elseif (strlen($this->libelle)>200) {
            $this->errorMsg.="LIBELLÉ du nouveau spectacle trop long (200 Car. maxi).<br/>";
        } elseif($nb>0) {
            $this->errorMsg.="Un spectacle ayant le même libellé est déjà enregistré.<br/>";
        }
    }
    
    private function insertNew() {
        //on enregistre le new spectacle
        $sth=NULL;
        $array=array();
        $query="INSERT INTO table_spectacles (libelle) VALUES (?)";
        $sth=$this->dbh->prepare($query);
        $array=array($this->libelle);
        $sth->execute($array);
        $this->message="\"".$this->getLibelle()."\" enregistré !";
        $this->blank();
        $this->test=1;
    }
    
    public function testChangeAct() {
        if(isset($_GET["idChange"], $_GET["state"])) {
            $this->id=  addslashes(htmlspecialchars($_GET["idChange"]));
            $state=  addslashes(htmlspecialchars($_GET["state"]));
            //on vide tout
            /*$sth=NULL;
            $array=array();
            $query="UPDATE table_spectacles SET etat=?";
            $sth=$this->dbh->prepare($query);
            $array=array(0);
            $sth->execute($array);*/
            //on met a $state le spectacle choisi
            $sth=NULL;
            $array=array();
            $query="UPDATE table_spectacles SET etat=? WHERE id=?";
            $sth=$this->dbh->prepare($query);
            $array=array(
                $state,
                $this->id
            );
            $sth->execute($array);
        }
    }
    
    public function testDel() {
        if(isset($_GET["idDel"])) {
            $this->id=  addslashes(htmlspecialchars($_GET["idDel"]));
            //on efface les dates
            $sth=NULL;
            $array=array();
            $query="DELETE FROM table_evenements WHERE id_spectacle=?";
            $sth=$this->dbh->prepare($query);
            $array=array($this->id);
            $sth->execute($array);
            //on efface le spectacle
            $sth=NULL;
            $array=array();
            $query="DELETE FROM table_spectacles WHERE id=?";
            $sth=$this->dbh->prepare($query);
            $array=array($this->id);
            $sth->execute($array);
        }
    }
    
    public function testChange() {
        if(isset($_GET["idSpectacle"])) {
            $this->id=  addslashes(htmlspecialchars($_GET["idSpectacle"]));
        }
    }
    
    public function getAct() {
        $sth=NULL;
        $array=array();
        $query="SELECT id,libelle FROM table_spectacles WHERE etat=? LIMIT 0,1";
        $sth=$this->dbh->prepare($query);
        $array=array(1);
        $sth->execute($array);
        $row=$sth->fetchObject();
        if($row!=NULL) {
            $this->id=$row->id;
            $this->libelle=$row->libelle;
        }
    }
    
    public function verifFormNew() {
        if(isset($_POST["subm"], $_POST["libelle"])) {
            $this->getPostNew();
            $this->verifPostNew();
            if(empty($this->errorMsg)) {
                $this->insertNew();
            }
        }
    }
    
    public function initInfosPres() {
        if(!empty($this->id)) {
            $query="SELECT id,content,title,description FROM table_presentations WHERE id_spectacle=? LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $array=array($this->id);
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $this->content=$row->content;
                $this->title=$row->title;
                $this->description=$row->description;
                $this->idPres=$row->id;
            }
        }
    }
    
    public function verifFormTxtPres() {
        if(isset($_POST["subm"])) {
            $this->getPostsTxtPres();
            $this->verifPostsTxtPres();
            if(Validator::getOK()) {
                $this->insertTxtPres();
            }
        }
    }
    
    private function getPostsTxtPres() {
        $this->id=  addslashes(htmlspecialchars($_POST["idSpectacle"]));
        $this->content=$this->codeHTML($_POST["content"]);
        $this->title=  addslashes(htmlspecialchars($_POST["title"]));
        $this->description=  addslashes(htmlspecialchars($_POST["description"]));
    }
    
    private function verifPostsTxtPres() {
        Validator::setOK(TRUE);
        $this->idSpectacleValidator->validate($this->id);
        $this->contentValidator->validate($this->content, 10, 5000);
        $this->titleValidator->validate($this->title, 5, 200);
        $this->descriptionValidator->validate($this->description, 10, 500);
    }
    
    private function insertTxtPres() {
        if(empty($this->idPres)) {
            $query="INSERT INTO table_presentations (id_spectacle, content, title, description, tstp) VALUES (?,?,?,?,?)";
            $sth=$this->dbh->prepare($query);
            $array=  array(
                $this->id,
                $this->content,
                $this->title,
                $this->description,
                time()
            );
            $sth->execute($array);
        } else {
            $query="UPDATE table_presentations SET content=?,title=?,description=?,tstp=? WHERE id_spectacle=?";
            $sth=$this->dbh->prepare($query);
            $array=array(
                $this->content,
                $this->title,
                $this->description,
                time(),
                $this->id
            );
            $sth->execute($array);
        }
        $this->test=1;
    }

    public function blank() {
        parent::blank();
        $this->libelle="";
    }
    
    public function getGets() {
        if(isset($_GET["idSpectacle"])) {
            $this->id=  addslashes(htmlspecialchars($_GET["idSpectacle"]));
        }
    }
    
    public function getValidator($validator) {
        switch($validator) {
            case 'idSpectacle':
                return $this->idSpectacleValidator;
                break;
            case 'content':
                return $this->contentValidator;
                break;
            case 'title':
                return $this->titleValidator;
                break;
            case 'description':
                return $this->descriptionValidator;
                break;
        }
        return new Validator();
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id=$id;
    }

    public function getLibelle() {
        return str_replace('\\', '', $this->libelle);
    }
    
    public function setLibelle($libelle) {
        $this->libelle=$libelle;
    }
    
    public function getContent() {
        return str_replace('\\', '', $this->content);
    }
    
    public function getTitle() {
        return str_replace('\\', "", $this->title);
    }
    
    public function getDescription() {
        return str_replace('\\', '', $this->description);
    }
}

?>

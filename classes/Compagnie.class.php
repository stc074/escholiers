<?php
/**
 * Description of Compagnie
 *
 * @author pj
 */
class Compagnie extends Objet {
    
    private $idPresentation=0;
    private $titrePresentation="";
    private $contenuPresentation="";
    private $idHistorique=0;
    private $contenuHistorique="";
    
    function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    function __destruct() {
        parent::__destruct();
    }
    
    public function initPresentation() {
        $sth=NULL;
        $query="SELECT id,titre,contenu FROM table_presentation_compagnie LIMIT 0,1";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        $row=$sth->fetchObject();
        if($row!=NULL) {
            $this->idPresentation=$row->id;
            $this->titrePresentation=$row->titre;
            $this->contenuPresentation=$row->contenu;
        }
    }
    
    public function testFormPresentation() {
        if(isset($_POST["subm"])) {
            $this->getPostsPresentation();
            $this->verifPostsPresentation();
            if(empty($this->errorMsg)) {
                $this->updatePresentation();
            }
        }
    }
    
    private function getPostsPresentation() {
        $this->titrePresentation=  addslashes(htmlspecialchars($_POST["titre"]));
        $this->contenuPresentation=  addslashes($this->codeHTML($_POST["contenu"]));
    }
    
    private function verifPostsPresentation() {
        if(empty($this->titrePresentation)) {
            $this->errorMsg.="Champ TITRE vide.<br/>";
        } elseif(strlen($this->titrePresentation)>200) {
            $this->errorMsg.="Champ TITRE trop long (200 Car. maxi).<br/>";
        }
        if(empty($this->contenuPresentation)) {
            $this->errorMsg.="Champ CONTENU vide.<br/>";
        } elseif(strlen($this->contenuPresentation)>50000) {
            $this->errorMsg.="Champ CONTENU trop long (50000 Car. maxi).<br/>";
        }
    }
    
    private function updatePresentation() {
        $sth=NULL;
        $array=array();
        $query="UPDATE table_presentation_compagnie SET titre=?,contenu=? WHERE id=?";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->titrePresentation,
            $this->contenuPresentation,
            $this->idPresentation
        );
        $sth->execute($array);
        $this->test=1;
    }
    
    public function initHistorique() {
        $sth=NULL;
        $query="SELECT id,contenu FROM table_historique_compagnie LIMIT 0,1";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        $row=$sth->fetchObject();
        if($row!=NULL) {
            $this->idHistorique=$row->id;
            $this->contenuHistorique=$row->contenu;
        }
    }
    
    public function testFormHistorique() {
        if(isset($_POST["subm"], $_POST["contenu"])) {
            $this->getPostHistorique();
            $this->verifPostHistorique();
            if(empty($this->errorMsg)) {
                $this->updateHistorique();
            }
        }
    }
    
    private function getPostHistorique() {
        $this->contenuHistorique=  addslashes($this->codeHTML($_POST["contenu"]));
    }
    
    private function verifPostHistorique() {
        if(empty($this->contenuHistorique)) {
            $this->errorMsg.="Champ CONTENU DE L'HISTORIQUE vide.<br/>";
        } elseif(strlen($this->contenuHistorique)>50000) {
            $this->errorMsg.="Champ CONTENU DE L'HISTORIQUE trop long (50000 Car. maxi).<br/>";
        }
    }
    
    private function updateHistorique() {
        $sth=NULL;
        $array=array();
        $query="UPDATE table_historique_compagnie SET contenu=? WHERE id=?";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->contenuHistorique,
            $this->idHistorique
        );
        $sth->execute($array);
        $this->test=1;
    }

        public function getTitrePresentation() {
        return str_replace('\\', '', $this->titrePresentation);
    }
    
    public function getContenuPresentation() {
        return str_replace('\\', '', $this->contenuPresentation);
    }
    
    public function getContenuHistorique() {
        return str_replace('\\', '', $this->contenuHistorique);
    }
}

?>

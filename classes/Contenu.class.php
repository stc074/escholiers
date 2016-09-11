<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contenu
 *
 * @author pj
 */
class Contenu extends Objet {
    
    private $id=0;
    private $mainTitre="";
    private $titre="";
    private $contenu="";
    private $title="";
    private $description="";
    private $url="";
    private $date="";
    
    function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    function __destruct() {
        parent::__destruct();
    }
    
    public function verifForm() {
        if(isset($_POST["subm"])) {
            $this->getPosts();
            $this->verifPosts();
            if(empty($this->errorMsg)) {
                $this->enregPage();
            }
        }
    }
    
    private function getPosts() {
        $this->mainTitre=  addslashes(htmlspecialchars($_POST["mainTitre"]));
        $this->titre=  addslashes(htmlspecialchars($_POST["titre"]));
        $this->contenu=  addslashes($this->codeHTML($_POST["contenu"]));
        $this->title=  addslashes(htmlspecialchars($_POST["title"]));
        $this->description=  addslashes(htmlspecialchars($_POST["description"]));
    }
    
    private function verifPosts() {
        if(empty($this->mainTitre)) {
            $this->errorMsg.="Champ TITRE PRINCIPAL vide.<br/>";
        } elseif(strlen($this->mainTitre)>200) {
            $this->errorMsg.="Champ TITRE PRINCIPAL trop long (200 Car. maxi).<br/>";
        }
        if(empty($this->titre))
            $this->errorMsg.="Champ TITRE POUR URL vide.<br/>";
        elseif(strlen($this->titre)>100)
            $this->errorMsg.="Champ TITRE POUR URL trop long (100 Car. max).<br/>";
        if(empty($this->contenu))
            $this->errorMsg.="Champ CONTENU vide.<br/>";
        else if(strlen($this->contenu)>500000)
            $this->errorMsg.="Champ CONTENU trop long (500000 Car. max)";
        if(empty($this->title))
            $this->errorMsg.="Champ BALISE TITLE vide.<br/>";
        else if(strlen($this->title)>200)
            $this->errorMsg.="Champ BALISE TITLE trop long (200 Car. max).<br/>";
        if(empty($this->description))
            $this->errorMsg.="Champ DESCRIPTION vide.<br/>";
        elseif(strlen($this->description)>1000)
            $this->errorMsg.="Champ DESCRIPTION trop long (1000 Car. max).<br/>";
    }
    
    private function enregPage() {
        $sth=NULL;
        $array=array();
        $requete="INSERT INTO table_pages_contenu (main_titre,titre,contenu,title,description,date) VALUES (?,?,?,?,?,?)";
        $sth=$this->dbh->prepare($requete);
        $array=array(
            $this->mainTitre,
            $this->titre,
            $this->contenu,
            $this->title,
            $this->description,
            time()
        );
        $sth->execute($array);
        $this->id=$this->dbh->lastInsertId();
        $this->url=$this->codeURL($this->titre, $this->id);
        //
        $img=new Image();
        $img->resizeAll($this->getContenu());
        $this->test=1;
    }
    
    public function initInfosEdit() {
        if(isset($_GET["idPage"])) {
            $this->id=  htmlspecialchars($_GET["idPage"]);
            $sth=NULL;
            $array=array();
            $req="SELECT main_titre,titre,contenu,title,description,date FROM table_pages_contenu WHERE id=? LIMIT 0,1";
            $sth=$this->dbh->prepare($req);
            $array=array($this->id);
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $this->mainTitre=$row->main_titre;
                $this->titre=$row->titre;
                $this->contenu=$row->contenu;
                $this->title=$row->title;
                $this->description=$row->description;
                $this->date="le ".date("d-m-Y", $row->date);
                $this->url=$this->codeURL($this->titre, $this->id);
            } else {
                $this->test=2;
            }
        }
    }
    
    public function verifFormEdit() {
        if(isset($_POST["subm"])) {
            $this->getPosts();
            $this->verifPosts();
            if(empty($this->errorMsg)) {
                $this->enregPageEdit();
            }
        }
    }
    
    private function enregPageEdit() {
        $sth=NULL;
        $array=array();
        $req="UPDATE table_pages_contenu SET main_titre=?,titre=?,contenu=?,title=?,description=?,date=? WHERE id=?";
        $sth=$this->dbh->prepare($req);
        $array=array(
            $this->mainTitre,
            $this->titre,
            $this->contenu,
            $this->title,
            $this->description,
            time(),
            $this->id
        );
        $sth->execute($array);
        $img=new Image();
        $img->resizeAll($this->getContenu());
        $this->initInfosEdit();
        $this->test=1;
    }
    
    public function testNumPage() {
        if(isset($_GET["numPage"])) {
            $this->id=  addslashes(htmlspecialchars($_GET["numPage"]));
        }
    }
    
    public function initInfos() {
        if(!empty($this->id)) {
            $sth=NULL;
            $array=array();
            $query="SELECT contenu,title,description FROM table_pages_contenu WHERE id=? LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $array=array($this->id);
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $this->contenu=$row->contenu;
            }
        }
    }
    
    public function getMainTitre() {
        return str_replace('\\', '', $this->mainTitre);
    }
    
    public function getTitre() {
        return str_replace('\\', '', $this->titre);
    }
    
    public function getContenu() {
        return str_replace("\\", "", $this->contenu);
    }
    
    public function getTitle() {
        return str_replace('\\', '', $this->title);
    }
    
    public function getDescription() {
        return str_replace('\\', '', $this->description);
    }
    
    public function getUrl() {
        return str_replace('\\', '', $this->url);
    }
    
    public function getDate() {
        return str_replace('\\', '', $this->date);
    }
    
    public function getId() {
        return $this->id;
    }
}

?>

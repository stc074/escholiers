<?php
/**
 * Description of Personne
 *
 * @author pj
 */
class Personne extends Objet {
    
    private $groupe=NULL;
    private $libelle="";
    private $description="";
    private $extension="";
    private $filename="";
    private $filenameMini="";
    private $img=NULL;
    private $dossier="images/";
    private $dossierAdmin="../images/";
    
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
        $this->groupe=new Groupe();
        $this->groupe->setId(0);
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function testFormEnreg() {
        if(isset($_POST["subm"])) {
        $this->getPostsPers();
        $this->verifPostsPers();
        if(empty($this->errorMsg)) {
            $this->enregPers();
        }
        }
    }
    
    private function getPostsPers() {
        $this->groupe->setId(addslashes(htmlspecialchars($_POST["idGroupe"])));
        $this->libelle=  addslashes(htmlspecialchars($_POST["libelle"]));
        $this->description=  addslashes($this->codeHTML($_POST["description"]));
    }
    
    private function verifPostsPers() {
        if($this->groupe->getId()==0) {
            $this->errorMsg.="Veuillez choisir un GROUPE SVP.<br/>";
        }
        if(empty($this->libelle)) {
            $this->errorMsg.="Champ LIBELLÉ vide.<br/>";
        } elseif(strlen($this->libelle)>200) {
            $this->errorMsg.="Champ LIBELLÉ trop long (200 Car. maxi).<br/>";
        }
        if(empty($this->description)) {
            $this->errorMsg.="Champ DESCRIPTION DE LA PERSONNE vide.<br/>";
        } elseif(strlen($this->description)>2000) {
            $this->errorMsg.="Champ DESCRIPTION DE LA PERSONNE trop long (2000 Car. maxi).<br/>";
        }
    }
    
    private function enregPers() {
        if(isset($_SESSION["idPers"])) {
            $this->id=$_SESSION["idPers"];
            $sth=NULL;
            $array=array();
            $query="UPDATE table_personnes SET id_groupe=?,libelle=?,description=?,tstp=? WHERE id=?";
            $sth=$this->dbh->prepare($query);
            $array=array(
                $this->groupe->getId(),
                $this->libelle,
                $this->description,
                time(),
                $this->id
            );
            $sth->execute($array);
        } else {
            //
            $sth=NULL;
            $array=array();
            $query="INSERT INTO table_personnes (id_groupe, libelle, description, tstp) VALUES (?,?,?,?)";
            $sth=$this->dbh->prepare($query);
            $array=array(
                $this->groupe->getId(),
                $this->libelle,
                $this->description,
                time()
            );
            $sth->execute($array);
        }
         $this->blank();
       $this->test=1;
       $img=new UploadImage();
       $img->deleteOldPers();
    }
    
    public function initPersonne() {
        if(isset($_GET["idPers"], $_GET["idGroupe"])) {
            $this->id=  addslashes(htmlspecialchars($_GET["idPers"]));
            $this->groupe->setId(addslashes(htmlspecialchars($_GET["idGroupe"])));
            //recuperation de données
            $sth=NULL;
            $array=array();
            $query="SELECT libelle,description,extension FROM table_personnes WHERE id_groupe=? AND id=? LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $array=array(
                $this->groupe->getId(),
                $this->id
            );
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $this->libelle=$row->libelle;
                $this->description=$row->description;
                $this->extension=$row->extension;
                if(!empty($this->extension)) {
                    $this->filename=$this->dossierAdmin."imgPers".$this->id.$this->extension;
                    $this->filenameMini=$this->dossierAdmin."imgPersMini".$this->id.$this->extension;
                    if(file_exists($this->filename)&&  file_exists($this->filenameMini)) {
                    $this->img=new Image();
                    $this->img->init($this->filenameMini, $this->extension);
                    } else {
                        $this->extension="";
                    }
                }
                $_SESSION["idPers"]=$this->id;
            } else { ?>
<p></p>
<div class="erreur">
    <p>Personne inconnue !</p>
</div>
<p></p>
<?php
            }
        } else { ?>
<div class="erreur">
    <p>Personne inconnue !</p>
</div>
<?php
        }
    }
    
    public function initPersonne2() {
        if(isset($_GET["idPers"], $_GET["idGroupe"])) {
            $this->id=  addslashes(htmlspecialchars($_GET["idPers"]));
            $this->groupe->setId(addslashes(htmlspecialchars($_GET["idGroupe"])));
            //recuperation de données
            $sth=NULL;
            $array=array();
            $query="SELECT libelle,description,extension FROM table_personnes WHERE id_groupe=? AND id=? LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $array=array(
                $this->groupe->getId(),
                $this->id
            );
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $this->libelle=$row->libelle;
                $this->description=$row->description;
                $this->extension=$row->extension;
                if(!empty($this->extension)) {
                    $this->filename=$this->dossierAdmin."imgPers".$this->id.$this->extension;
                    $this->filenameMini=$this->dossierAdmin."imgPersMini".$this->id.$this->extension;
                    if(file_exists($this->filename)&&  file_exists($this->filenameMini)) {
                    $this->img=new Image();
                    $this->img->init($this->filenameMini, $this->extension);
                    $this->filename=$this->dossier."imgPers".$this->id.$this->extension;
                    $this->filenameMini=$this->dossier."imgPersMini".$this->id.$this->extension;
                    } else {
                        $this->extension="";
                    }
                }
                $_SESSION["idPers"]=$this->id;
            } else { ?>
<p></p>
<div class="erreur">
    <p>Personne inconnue !</p>
</div>
<p></p>
<?php
            }
        } else { ?>
<div class="erreur">
    <p>Personne inconnue !</p>
</div>
<?php
        }
    }
    
    public function verifFormModif() {
        if(isset($_POST["subm"], $_POST["libelle"], $_POST["description"])) {
            $this->getPostsModif();
            $this->verifPostsModif();
            if(empty($this->errorMsg)) {
                $this->updatePers();
            }
        }
    }
    
    private function getPostsModif() {
        $this->libelle=  addslashes(htmlspecialchars($_POST["libelle"]));
        $this->description=$this->codeHTML($_POST["description"]);
    }
    
    private function verifPostsModif() {
        if(empty($this->libelle)) {
            $this->errorMsg.="Champ LIBELLÉ vide.<br/>";
        } elseif(strlen($this->libelle)>200) {
            $this->errorMsg.="Champ LIBELLÉ trop long (200 Car. maxi).<br/>";
        }
        if(empty($this->description)) {
            $this->errorMsg.="Champ DESCRIPTION vide.<br/>";
        } elseif(strlen($this->description)>2000) {
            $this->errorMsg.="Champ DESCRIPTION trop long (2000 Car. maxi).<br/>";
        }
    }
    
    private function updatePers() {
        $sth=NULL;
        $array=array();
        $query="UPDATE table_personnes SET libelle=?,description=? WHERE id=? AND id_groupe=?";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->libelle,
            $this->description,
            $this->id,
            $this->groupe->getId()
        );
        $sth->execute($array);
        $this->test=1;
    }
    
    public function blank() {
        parent::blank();
        unset($_SESSION["idPers"]);
        $this->groupe->setId(0);
        $this->libelle="";
        $this->description="";
    }
    
    
    public function getId() {
        return $this->id;
    }


    public function getGroupe() {
        return $this->groupe;
    }
    
    public function setGroupe($groupe) {
        $this->groupe=$groupe;
    }
    
    public function getLibelle() {
        return str_replace('\\', '', $this->libelle);
    }
    
    public function getDescription() {
        return str_replace('\\', '', $this->description);
    }
    
    public function getExtension() {
        return str_replace('\\', '', $this->extension);
    }
    
    public function getFilename() {
        return str_replace('\\', '', $this->filename);
    }
    
    public function getFilenameMini() {
        return str_replace('\\', '', $this->filenameMini);
    }
    
    public function getImg() {
        return $this->img;
    }
}

?>

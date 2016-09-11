<?php
class UploadImage extends Upload {
    
    private $commentaires="";
    private $id=0;
    private $galerie=NULL;
    private $filename="";
    private $filenameMini="";
    private $dossier="../images/";
    private $HEIGHT=150;
    private $WLIMIT=800;
    private $HLIMIT=600;
    private $img;
    protected $extImages=array(
        ".png",
        ".gif",
        ".jpg",
        ".jpeg"
    );
    
    private $MAXSIZE=10000000;
    private $MAXSIZESTR="10 MEGA";
    
    function __construct() {
        parent::__construct();
        $this->galerie=new Galerie();
        $this->galerie->setId(0);
    }
    
    function __destruct() {
        parent::__destruct();
    }
    
    public function testForm() {
        if(isset($_POST["subm"], $_FILES["photo"])) {
            $this->getPosts();
            $this->verifPosts();
            if(empty($this->errorMsg)) {
            $this->fieldName="photo";
            $this->getInfos();
            $this->testErrors($this->MAXSIZESTR);
            if(empty($this->errorMsg)) {
                if(!$this->testSize($this->MAXSIZE)) {
                    $this->errorMsg.="Fichier trop gros ("+$this->MAXSIZESTR+" Maxi.).<br/>";
                }
                if(!$this->isExtension($this->extImages)) {
                    $this->errorMsg.="Ce n'est pas un fichier image (seulement PNG, GIF, JPG, JPEG).<br/";
                }
            }
            if(empty($this->errorMsg)) {
                $sth=NULL;
                $array=array();
                $req="INSERT INTO table_photos (id_galerie,commentaires,extension,timestamp) VALUES (?,?,?,?)";
                $sth=$this->dbh->prepare($req);
                $array=array(
                    $this->galerie->getId(),
                    $this->commentaires,
                    $this->extension,
                    time()
                );
                $sth->execute($array);
                $this->id=$this->dbh->lastInsertId();
                $this->filename=$this->dossier."img".$this->id.$this->extension;
                $this->filenameMini=  $this->dossier."imgMini".$this->id.$this->extension;
                $this->upload($this->filename);
                $this->img=new Image();
                $this->img->init($this->filename, $this->extension);
                $this->img->resizeHeight($this->HEIGHT, $this->filenameMini);
                $this->img->resizeLimits($this->WLIMIT, $this->HLIMIT);
                $this->img->init($this->filenameMini, $this->extension);
                $this->message=$this->getCommentaires();
                $this->blank();
                $this->test=1;
            }
            }
        }
    }
    
    public function getPosts() {
        $this->galerie->setId(addslashes(htmlspecialchars($_POST["idGalerie"])));
        $this->commentaires=  addslashes(htmlspecialchars($_POST["commentaires"]));
    }
    
    public function verifPosts() {
        if($this->galerie->getId()==0) {
            $this->errorMsg.="Veuillez choisir une GALERIE SVP.<br/>";
        }
        if(empty($this->commentaires))
            $this->errorMsg.="Champ COMMENTAIRES vide.<br/>";
        elseif(strlen($this->commentaires)>200)
            $this->errorMsg.="Champ COMMENTAIRES trop long (200 Car. maxi).<br/>";
    }
    
    public function testImgVideo() {
        if(isset($_POST["subm"], $_FILES["image"])) {
            $this->fieldName="image";
            $this->getInfos();
            $this->testErrors($this->MAXSIZESTR, "Image de présentation");
            if(empty($this->errorMsg)) {
                if(!$this->testSize($this->MAXSIZE)) {
                    $this->errorMsg.="Fichier IMAGE trop gros (".$this->MAXSIZESTR." Maxi.).<br/>";
                }
                if(!$this->isExtension($this->extImages)) {
                    $this->errorMsg.="Mauvais format d'image (uniquement GIF, PNG, JPG ou JPEG).<br/>";
                }
            }
            if(empty($this->errorMsg)) {
                $sth=NULL;
                $array=array();
                $query="INSERT INTO table_images_video (extension) VALUES (?)";
                $sth=$this->dbh->prepare($query);
                $array=array($this->extension);
                $sth->execute($array);
                $this->id=$this->dbh->lastInsertId();
                $this->filename=$this->dossier."imgVideo".$this->id.$this->extension;
                $this->upload($this->filename);
            }
        } else {
            $this->errorMsg.="Fichier IMAGE inexistant.<br/>";
        }
    }
    
    public function testFormPers() {
        if(isset($_POST["submFile"], $_FILES["photo"])) {
            $this->fieldName="photo";
            $this->getInfos();
            $this->testErrors($this->MAXSIZESTR, "image de la personne");
            if(empty($this->errorMsg)) {
                if(!$this->isExtension($this->extImages)) {
                    $this->errorMsg.="Mauvais format de fichier (PNG, GIF, JPG, JPEG).<br/>";
                }
                if(!$this->testSize($this->MAXSIZE)) {
                    $this->errorMsg.="Fichier image trop gros (".$this->MAXSIZESTR." Maxi.).<br/>";
                }
            }
            if(empty($this->errorMsg)) {
                $this->enregPhotoPers();
            }
        }
    }
    
    private function enregPhotoPers() {
        if(isset($_SESSION["idPers"])) {
            $idPers=$_SESSION["idPers"];
            //on efface l'ancienne image
            $sth=NULL;
            $array=array();
            $query="SELECT extension FROM table_personnes WHERE id=? LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $array=array($idPers);
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $extension=$row->extension;
                if(!empty($extension)) {
                    $filename=$this->dossier."imgPers".$idPers.$extension;
                    $filenameMini=$this->dossier."imgPersMini".$idPers.$extension;
                    if(file_exists($filename)) {
                        unlink($filename);
                    }
                    if(file_exists($filenameMini)) {
                        unlink($filenameMini);
                    }
                }
            }
            //
            $sth=NULL;
            $array=array();
            $query="UPDATE table_personnes SET extension=? WHERE id=?";
            $sth=$this->dbh->prepare($query);
            $array=array(
                $this->extension,
                $idPers,
            );
            $sth->execute($array);
        } else {
            $sth=NULL;
            $array=array();
            $query="INSERT INTO table_personnes (extension) VALUES (?)";
            $sth=$this->dbh->prepare($query);
            $array=array($this->extension);
            $sth->execute($array);
            $idPers=$this->dbh->lastInsertId();
        }
        
        $this->filename=$this->dossier."imgPers".$idPers.$this->extension;
        $this->filenameMini=$this->dossier."imgPersMini".$idPers.$this->extension;
        $this->upload($this->filename);
        $this->img=new Image();
        $this->img->init($this->filename, $this->extension);
        $this->img->resizeLimits($this->WLIMIT, $this->HLIMIT);
        $this->img->resizeHeight($this->HEIGHT, $this->filenameMini);
        $this->img->init($this->filenameMini, $this->extension);
        $this->id=$_SESSION["idPers"]=$idPers;
        $this->test=1;
    }
    
    public function initImagePers() {
        if(isset($_SESSION["idPers"])) {
            $idPers=$_SESSION["idPers"];
            //
            $sth=NULL;
            $array=array();
            $query="SELECT extension FROM table_personnes WHERE id=? LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $array=array($idPers);
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $this->extension=$row->extension;
                $this->filename=$this->dossier."imgPers".$idPers.$this->extension;
                $this->filenameMini=$this->dossier."imgPersMini".$idPers.$this->extension;
                $this->img=new Image();
                $this->img->init($this->filenameMini, $this->extension);
                $this->test=2;
            }
        }
    }
    
    public function testDelPhotoPers() {
        if(isset($_GET["idDel"])) {
            $idPers=  addslashes(htmlspecialchars($_GET["idDel"]));
            //
            $sth=NULL;
            $array=array();
            $query="SELECT extension FROM table_personnes WHERE id=? LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $array=array($idPers);
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $extension=$row->extension;
                $filename=$this->dossier."imgPers".$idPers.$extension;
                $filenameMini=$this->dossier."imgPersMini".$idPers.$extension;
                if(file_exists($filename)) {
                    unlink($filename);
                }
                if(file_exists($filenameMini)) {
                    unlink($filenameMini);
                }
            }
            //
            $sth=NULL;
            $array=array();
            $query="DELETE FROM table_personnes WHERE id=?";
            $sth=$this->dbh->prepare($query);
            $array=array($idPers);
            $sth->execute($array);
            unset($_SESSION["idPers"]);
            $this->deleteOldPers();
        }
    }
    
    public function deleteOldPers() {
        $sth=NULL;
        $array=array();
        $query="SELECT id,extension FROM table_personnes WHERE tstp=?";
        $sth=$this->dbh->prepare($query);
        $array=array(0);
        $sth->execute($array);
        while($row=$sth->fetchObject()) {
            $idPers=$row->id;
            $extension=$row->extension;
            $filename=$this->dossier."imgPers".$idPers.$extension;
            $filenameMini=$this->dossier."imgPersMini".$idPers.$extension;
            if(file_exists($filename)) {
                unlink($filename);
            }
            if(file_exists($filenameMini)) {
                unlink($filenameMini);
            }
        }
        //
        $sth=NULL;
        $array=array();
        $query="DELETE FROM table_personnes WHERE tstp=?";
        $sth=$this->dbh->prepare($query);
        $array=array(0);
        $sth->execute($array);
        unset($_SESSION["idPers"]);
    }
    
    public function testDelPhotoPersModif() {
        if(isset($_GET["idDel"], $_GET["idGroupe"])) {
            $idPers=  addslashes(htmlspecialchars($_GET["idDel"]));
            $idGroupe=  addslashes(htmlspecialchars($_GET["idGroupe"]));
            //on recupère l'extension
            $sth=NULL;
            $array=array();
            $query="SELECT extension FROM table_personnes WHERE id=? AND id_groupe=? LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $array=array(
                $idPers,
                $idGroupe
            );
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $extension=$row->extension;
                //si extension on efface les images
                if(!empty($extension)) {
                    $filename=$this->dossier."imgPers".$idPers.$extension;
                    $filenameMini=$this->dossier."imgPersMini".$idPers.$extension;
                    if(file_exists($filename)) {
                        unlink($filename);
                    }
                    if(file_exists($filenameMini)) {
                        unlink($filenameMini);
                    }
                    //on efface l'extension dans la base de données
                    $sth=NULL;
                    $array=array();
                    $query="UPDATE table_personnes SET extension=? WHERE id=? AND id_groupe=?";
                    $sth=$this->dbh->prepare($query);
                    $array=array(
                        "",
                        $idPers,
                        $idGroupe
                    );
                    $sth->execute($array);
                }
            }
        }
    }
    
    public function blank() {
        parent::blank();
        $this->galerie->setId(0);
        $this->commentaires="";
    }
    
    
    public function getCommentaires() {
        return str_replace('\\', '', $this->commentaires);
    }
    
    public function getId() {
        return $this->id;
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
    
    public function getGalerie() {
        return $this->galerie;
    }
}

?>

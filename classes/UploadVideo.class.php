<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UploadVideo
 *
 * @author pj
 */
class UploadVideo extends Upload {
    
    private $commentaires="";
    private $url;
    private $youtube=FALSE;
    private $image;
    private $MAXSIZE=60000000;
    private $MAXSIZESTR="60 Mo";
    private $arrayExtension=array(
        ".mov",
        ".mp4",
        ".flv",
        ".f4v",
        ".3gp",
        ".3g2"
    );
        
    private $dossier="../videos/";
    private $dossierImg="../images/";
    private $filename;
    
    function __construct() {
        parent::__construct();
        $this->image=new UploadImage();
    }
    
    function __destruct() {
        parent::__destruct();
    }
    
    public function verifForm() {
        if(isset($_POST["subm"])) {
            $this->getPosts();
            $this->verifPosts();
            if(empty($this->errorMsg)&&!empty($this->url)) {
                $this->enregUrl();
            } else {
            if(empty($this->errorMsg)) {
                $this->image->testImgVideo();
                $this->errorMsg.=$this->image->getErrorMsg();
                if(empty($this->errorMsg)) {
                    $this->verifUpload();
                }
            }
            if(empty($this->errorMsg)) {
                $this->recVideo();
            }
            }
        }
    }
    
    private function getPosts() {
        $this->commentaires=  addslashes(htmlspecialchars($_POST["commentaires"]));
        $this->url=  addslashes(htmlspecialchars($_POST["url"]));
    }
    
    private function verifPosts() {
        if(empty($this->commentaires))
            $this->errorMsg.="Champ COMMENTAIRES vide.<br/>";
        elseif(strlen($this->commentaires)>200)
            $this->errorMsg.="Champ COMMENTAIRES trop long (200 Car. max).<br/>";
        if(!empty($this->url)&&!@get_headers($this->url)) {
            $this->errorMsg.="L'adresse YOUTUBE fournie ne semble pas répondre.<br/>";
        }
    }

    private function verifUpload() {
        $this->fieldName="video";
        $this->getInfos();
        $this->testErrors($this->MAXSIZESTR, "Vidéo");
        if(empty($this->errorMsg)) {
            if(!$this->testSize($this->MAXSIZE))
                $this->errorMsg.="Fichier vidéo trop gros (".$this->MAXSIZESTR." Maxi.).<br/>";
            if(!$this->isExtension($this->arrayExtension))
                $this->errorMsg.="Mauvais format de fichier.<br/>";
        }
    }
    
    private function recVideo() {
        $sth=NULL;
        $array=array();
        $query="INSERT INTO table_videos (commentaires,extension,timestamp) VALUES (?,?,?)";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->commentaires,
            $this->extension,
            time()
        );
        $sth->execute($array);
        $this->id=$this->dbh->lastInsertId();
        $this->filename=$this->dossier."video".$this->id.$this->extension;
        $this->upload($this->filename);
        $this->test=1;
        $this->blank();
        //
        $sth=NULL;
        $array=array();
        $query="UPDATE table_images_video SET id_video=? WHERE id=?";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->id,
            $this->image->getId()
        );
        $sth->execute($array);
    }
    
    private function enregUrl() {
        $sth=NULL;
        $array=array();
        $query="INSERT INTO table_videos (url, commentaires, timestamp) VALUES (?,?,?)";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->url,
            $this->commentaires,
            time()
        );
        $sth->execute($array);
        $this->youtube=TRUE;
        $this->test=1;
        $this->blank();
    }
    
    public function delAlone() {
        $sth=NULL;
        $array=array();
        $query="SELECT id,extension FROM table_images_video WHERE id_video=?";
        $sth=$this->dbh->prepare($query);
        $array=array(0);
        $sth->execute($array);
        while($row=$sth->fetchObject()) {
            $idImg=$row->id;
            $extImg=$row->extension;
            $filenameImg=$this->dossierImg."imgVideo".$idImg.$extImg;
            if(file_exists($filenameImg)) {
                unlink($filenameImg);
            }
        }
        //on efface les tuples
        $sth=NULL;
        $array=array();
        $query="DELETE FROM table_images_video WHERE id_video=0";
        $sth=$this->dbh->prepare($query);
        $array=array(0);
        $sth->execute($array);
        
    }
    
    public function blank() {
        parent::blank();
        $this->commentaires="";
        $this->url="";
    }

    public function getCommentaires() {
        return str_replace('\\', '', $this->commentaires);
    }
    
    public function getMAXSIZE() {
        return $this->MAXSIZE;
    }
    
    public function getFilename() {
        return str_replace('\\', '', $this->filename);
    }
    
    public function getUrl() {
        return str_replace('\\', '', $this->url);
    }
    
    public function isYoutube() {
        return $this->youtube;
    }
}

?>

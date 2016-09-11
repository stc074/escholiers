<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GalerieAdmin
 *
 * @author pj
 */
class GalerieAdmin extends Galerie {
    
    private $id=0;
    private $dossier="../images/";
    private $commentaires="";
    private $idVideo=0;
    
    function __construct() {
        parent::__construct();
    }
    
    function __destruct() {
        parent::__destruct();
    }
    
    function displayList() {
        if(empty($this->id)) {
            ?>
<div class="info">
    <p>Choisissez une galerie.</p>
</div>
<p></p>
<?php
        } else {
        $sth=NULL;
        $array=array();
        $req="SELECT id,commentaires,extension FROM table_photos WHERE id_galerie=? ORDER BY timestamp ASC";
        $sth=  $this->dbh->prepare($req);
        $array=array($this->id);
        $sth->execute($array);
        $nb=0;
        while($row=$sth->fetchObject()) {
            $nb++;
            $id=$row->id;
            $this->commentaires=  str_replace('\\', '', $row->commentaires);
            $extension=$row->extension;
            $filename=$this->dossier."img".$id.$extension;
            $filenameMini=$this->dossier."imgMini".$id.$extension;
            $img=new Image();
            $img->init($filenameMini, $extension);
?>
<div id="form<?php echo $id; ?>" class="formVignette">
    <?php
    if($this->test==1&&$id==$this->idVideo) { ?>
    <p></p>
    <div class="info" style="margin: auto;">
        <p>Commentaires modifiés</p>
    </div>
    <p></p>
    <?php
    }
    if($this->test==0&&$this->idVideo==$id&&!empty($this->errorMsg)) { ?>
    <div class="erreur" style="margin: auto;">
        <p>Erreur lors de la modification du commentaire :</p>
        <p><?php echo $this->getErrorMsg(); ?></p>
    </div>
    <p></p>
    <?php } ?>
<div class="vignette">
    <div class="up" title="Déplacer avant" onclick="javascript:imageUp(<?php echo $id; ?>,<?php echo $this->id; ?>);"></div>
    <div>
    <a href="<?php echo $filename; ?>" title="<?php echo $this->commentaires; ?>">
        <img src="<?php echo $filenameMini; ?>" width="<?php echo $img->getLargeurSource(); ?>" height="<?php echo $img->getHauteurSource(); ?>" alt="<?php echo $this->commentaires; ?>" />
    </a>
    </div>
    <div class="down" title="Déplacer après" onclick="javascript:imageDown(<?php echo $id; ?>,<?php echo $this->id; ?>);"></div>
    <div class="delete" title="Effacer cette image" onclick="javascript:testDelImage(<?php echo $id; ?>,<?php echo $this->id; ?>);"></div>
</div>
<p></p>
                        <form action="modif-comment-<?php echo $id; ?>-<?php echo $this->id; ?>.html#form<?php echo $id; ?>" method="POST">
                            <p>
                                <label for="commentaires">Commentaires :</label>
                                <input type="text" name="commentaires" value="<?php echo $this->getCommentaires(); ?>" size="40" maxlength="200" />
                                <input type="submit" value="Modifier" name="subm" />
                            </p>
            </form>
</div>
<hr/>
<p></p>
<?php
        }
        if(empty($nb)) { ?>
<p></p>
<div class="info">
    <p>Galerie vide.</p>
</div>
<p></p>
<?php
        } else { ?>
<p></p>
<div class="info">
    <p><?php echo $nb; ?> photo(s).</p>
</div>
<p></p>
<?php
        }
        }
    }
    
    public function testDel() {
        if(isset($_GET["idDel"])) {
            $idPhoto=  addslashes(htmlspecialchars($_GET["idDel"]));
            $sth=NULL;
            $array=array();
            $req="SELECT extension FROM table_photos WHERE id=? LIMIT 0,1";
            $sth=$this->dbh->prepare($req);
            $array=array($idPhoto);
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $extension=$row->extension;
                $filename=$this->dossier."img".$idPhoto.$extension;
                $filenameMini=$this->dossier."imgMini".$idPhoto.$extension;
                if(file_exists($filename)) {
                    unlink($filename);
                }
                if(file_exists($filenameMini)) {
                    unlink($filenameMini);
                }
                //
                $sth=NULL;
                $array=array();
                $req="DELETE FROM table_photos WHERE id=?";
                $sth=$this->dbh->prepare($req);
                $array=array($idPhoto);
                $sth->execute($array);
            }
        }
    }
        public function testChangePos() {
            if(isset($_GET["idUp"])||isset($_GET["idDown"])) {
                $up=false;
                if(isset($_GET["idUp"])) {
                    $id1=  addslashes(htmlspecialchars($_GET["idUp"]));
                    $up=true;
                } elseif (isset($_GET["idDown"])) {
                    $id1=  addslashes(htmlspecialchars($_GET["idDown"]));
                }
                //
                $sth=NULL;
                $array=array();
                $query="SELECT timestamp FROM table_photos WHERE id=? LIMIT 0,1";
                $sth=$this->dbh->prepare($query);
                $array=array($id1);
                $sth->execute($array);
                $row=$sth->fetchObject();
                if($row!=NULL) {
                    $timestamp1=$row->timestamp;
                    //
                    $sth=NULL;
                    $array=array();
                    if($up) {
                        $query="SELECT id,timestamp FROM table_photos WHERE timestamp<? ORDER BY timestamp DESC LIMIT 0,1";
                    } else {
                        $query="SELECT id,timestamp FROM table_photos WHERE timestamp>? ORDER BY timestamp ASC LIMIT 0,1";
                    }
                    $sth=$this->dbh->prepare($query);
                    $array=array($timestamp1);
                    $sth->execute($array);
                    $row=$sth->fetchObject();
                    //
                    if($row!=NULL) {
                        $id2=$row->id;
                        $timestamp2=$row->timestamp;
                        //
                        $sth=NULL;
                        $array=array();
                        $query="UPDATE table_photos SET timestamp=? WHERE id=?";
                        $sth=$this->dbh->prepare($query);
                        $array=array(
                                $timestamp1,
                                $id2);
                        $sth->execute($array);
                        //
                        $array=array();
                        $array=array(
                            $timestamp2,
                            $id1
                        );
                        $sth->execute($array);
                    }
                }
            }
        }
        
        public function verifComment() {
            if(isset($_POST["subm"], $_GET["idModif"])) {
                $this->idVideo=  addslashes(htmlspecialchars($_GET["idModif"]));
            $this->getPost();
            $this->verifPost();
            if(empty($this->errorMsg)) {
                $this->updateComment();
            }
            }
        }
        
        private function getPost() {
            $this->commentaires=  addslashes(htmlspecialchars($_POST["commentaires"]));
        }
        
        private function verifPost() {
            if(empty($this->commentaires)) {
                $this->errorMsg.="Champ COMMENTAIRES vide.<br/>";
            } elseif(strlen($this->commentaires)>200) {
                $this->errorMsg.="Champ COMMENTAIRES trop long (200 Car. maxi).<br/>";
            }
        }
        
        private function updateComment() {
            $sth=NULL;
            $array=array();
            $query="UPDATE table_photos SET commentaires=? WHERE id=?";
            $sth=$this->dbh->prepare($query);
            $array=array(
                $this->commentaires,
                $this->idVideo
            );
            $sth->execute($array);
            $this->test=1;
        }
        
        public function dispSelect() {
            ?>
<select name="idGalerie" id="idGalerie" onchange="javascript:window.location.href='change-galerie-'+this.value+'.html';">
    <option value="0"<?php if($this->id==0) echo ' selected="selected"'; ?>>Choisissez</option>
    <?php
    $sth=NULL;
    $query="SELECT id,titre FROM table_galeries ORDER BY tstp ASC";
    $sth=$this->dbh->prepare($query);
    $sth->execute();
    while($row=$sth->fetchObject()) {
        $idGalerie=$row->id;
        $titre=  str_replace('\\', '', $row->titre);
        ?>
    <option value="<?php echo $idGalerie; ?>"<?php if($this->id==$idGalerie) { echo ' selected="selected"'; } ?>><?php echo $titre; ?></option>
    <?php
    }
    ?>
</select>
<?php
        }
        
        public function testChangeGalerie() {
            if(isset($_GET["idGalerie"])) {
                $this->id=  addslashes(htmlspecialchars($_GET["idGalerie"]));
            }
        }


        public function getCommentaires() {
            return str_replace('\\', '', $this->commentaires);
        }
        
        public function getId() {
            return $this->id;
        }
}

?>

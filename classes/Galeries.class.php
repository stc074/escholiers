<?php
/**
 * Description of Galeries
 *
 * @author pj
 */
class Galeries extends Objet {
    
    private $idGalerie=0;
    private $titre="";
    private $dossierImageAdmin="../images/";
    
    
    function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    function __destruct() {
        parent::__destruct();
    }
    
    public function dispListGestion() {
        $sth=NULL;
        $query="SELECT id,titre FROM table_galeries ORDER BY tstp ASC";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        while($row=$sth->fetchObject()) {
            $idGalerie=$row->id;
            $titre=  str_replace('\\', '', $row->titre);
            ?>
<div id="id<?php echo $idGalerie; ?>" style="width: 70%; margin: auto;">
    <?php
    if($this->test==0&&$this->idGalerie==$idGalerie&&!empty($this->errorMsg)) { ?>
    <div class="erreur">
        <p>Erreur lors de la validation du formulaire :</p>
        <p><?php echo $this->getErrorMsg(); ?></p>
    </div>
    <p></p>
    <?php
    }
    if($this->test==1&&$this->idGalerie==$idGalerie) { ?>
    <p></p>
    <div class="info">
        <p><?php echo $this->getMessage(); ?></p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <div class="up" onclick="javascript:upGalerie(<?php echo $idGalerie; ?>);"></div>
    <div style="display: inline-block; vertical-align: middle;">
    <form action="gestion-galeries-<?php echo $idGalerie; ?>.html#id<?php echo $idGalerie; ?>" method="POST">
        <p>
            <label for="titre<?php echo $idGalerie; ?>">Libelle :</label>
            <input type="text" name="titre" id="titre<?php echo $idGalerie; ?>" value="<?php echo $titre; ?>" size="40" maxlength="200" />
            <input type="submit" value="Modifier" name="submModif" />
        </p>
    </form>
    </div>
    <div class="delete2" onclick="javascript:deleteGalerie(<?php echo $idGalerie; ?>);"></div><span>&nbsp;[Effacer]</span>
    <div class="down" onclick="javascript:downGalerie(<?php echo $idGalerie; ?>);"></div>
</div>
<hr style="width: 50%; text-align: left;" />
<p></p>
<?php
        }
    }
    
    public function testModifTitre() {
        if(isset($_GET["idModif"], $_POST["submModif"], $_POST["titre"])) {
            $this->idGalerie=  addslashes(htmlspecialchars($_GET["idModif"]));
            $this->getPostModifTitre();
            $this->verifPostModifTitre();
            if(empty($this->errorMsg)) {
                $this->updateTitre();
            }
        }
    }
    
    private function getPostModifTitre() {
        $this->titre=  addslashes(htmlspecialchars($_POST["titre"]));
    }
    
    private function verifPostModifTitre() {
        if(empty($this->titre)) {
            $this->errorMsg.="Champ TITRE DE LA GALERIE vide.<br/>";
        } elseif(strlen($this->titre)>200) {
            $this->errorMsg.="Champ TITRE DE LA GALERIE trop long.<br/>";
        }
    }
    
    private function updateTitre() {
        $sth=NULL;
        $array=array();
        $query="UPDATE table_galeries SET titre=? WHERE id=?";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->titre,
            $this->idGalerie
        );
        $sth->execute($array);
        $this->test=1;
        $this->message="Libellé de la galerie modifié !";
    }
    
    public function testChangePos() {
        if(isset($_GET["idUp"])||isset($_GET["idDown"])) {
            $up=TRUE;
            if(isset($_GET["idUp"])) {
                $up=TRUE;
                $id1=  addslashes(htmlspecialchars($_GET["idUp"]));
            } elseif(isset($_GET["idDown"])) {
                $up=FALSE;
                $id1=  addslashes(htmlspecialchars($_GET["idDown"]));
            }
            //
            $sth=NULL;
            $array=array();
            $query="SELECT tstp FROM table_galeries WHERE id=? LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $array=array($id1);
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $timestamp1=$row->tstp;
                //
                $sth=NULL;
                $array=array();
                if($up) {
                    $query="SELECT id,tstp FROM table_galeries WHERE tstp<? ORDER BY tstp DESC LIMIT 0,1";
                } else {
                    $query="SELECT id,tstp FROM table_galeries WHERE tstp>? ORDER BY tstp ASC limit 0,1";
                }
                $sth=  $this->dbh->prepare($query);
                $array=array($timestamp1);
                $sth->execute($array);
                $row=$sth->fetchObject();
                if($row!=NULL) {
                    $id2=$row->id;
                    $timestamp2=$row->tstp;
                    //
                    $sth=NULL;
                    $array=array();
                    $query="UPDATE table_galeries SET tstp=? WHERE id=?";
                    $sth=$this->dbh->prepare($query);
                    //
                    $array=array(
                        $timestamp1,
                        $id2
                    );
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

    public function testDel() {
        if(isset($_GET["idDel"])) {
            $idGalerie=  addslashes(htmlspecialchars($_GET["idDel"]));
            //
            $sth=NULL;
            $array=array();
            $query="SELECT id,extension FROM table_photos WHERE id_galerie=?";
            $sth=$this->dbh->prepare($query);
            $array=array($idGalerie);
            $sth->execute($array);
            while($row=$sth->fetchObject()) {
                $idImg=$row->id;
                $extension=$row->extension;
                $filename=$this->dossierImageAdmin."img".$idImg.$extension;
                $filenameMini=$this->dossierImageAdmin."imgMini".$idImg.$extension;
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
            $query="DELETE FROM table_photos WHERE id_galerie=?";
            $sth=$this->dbh->prepare($query);
            $array=array($idGalerie);
            $sth->execute($array);
            //
            $sth=NULL;
            $array=array();
            $query="DELETE FROM table_galeries WHERE id=?";
            $sth=$this->dbh->prepare($query);
            $array=array($idGalerie);
            $sth->execute($array);
        }
    }
    
    public function dispList() {
        ?>
<p>Séléctionnez une galerie à visionner.</p>
<ul>
<?php
    $sth=NULL;
    $query="SELECT id,titre FROM table_galeries ORDER BY tstp";
    $sth=$this->dbh->prepare($query);
    $sth->execute();
    while($row=$sth->fetchObject()) {
        $id=$row->id;
        $titre=  str_replace('\\', '', $row->titre);
        ?>
    <li><a href="galerie-photo-<?php echo $id; ?>.html#galerie" title="<?php echo $titre; ?>"><?php echo $titre; ?></a></li>
    <?php
    }
    ?>
</ul>
<?php
    }

    public function blank() {
        parent::blank();
    }
}

?>

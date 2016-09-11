<?php
/**
 * Description of Groupes
 *
 * @author pj
 */
class Groupes extends Objet {
    
    private $idGroupe=0;
    private $libelle="";
    private $dossierAdmin="../images/";
    
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function initSelect($idSelected=0) {
        ?>
<select name="idGroupe">
    <option value="0"<?php if($idSelected==0) { ?> selected="selected"<?php } ?>>Choisisssez</option>
    <?php
        $sth=NULL;
        $query="SELECT id,libelle FROM table_groupes_personnes ORDER BY tstp ASC";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        while($row=$sth->fetchObject()) {
            $idGroupe=$row->id;
            $libelle=  str_replace('\\', '', $row->libelle);
            ?>
<option value="<?php echo $idGroupe; ?>"<?php if($idGroupe==$idSelected) { ?> selected="selected"<?php } ?>><?php echo $libelle; ?></option>
<?php
        }
        ?>
</select>
<?php
    }
    
    public function initSelect2($idSelected=0) {
        ?>
<select name="idGroupe" onchange="javascript:window.location.href='gestion-groupe-'+this.value+'.html';">
    <option value="0"<?php if($idSelected==0) { ?> selected="selected"<?php } ?>>Choisisssez</option>
    <?php
        $sth=NULL;
        $query="SELECT id,libelle FROM table_groupes_personnes ORDER BY tstp ASC";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        while($row=$sth->fetchObject()) {
            $idGroupe=$row->id;
            $libelle=  str_replace('\\', '', $row->libelle);
            ?>
<option value="<?php echo $idGroupe; ?>"<?php if($idGroupe==$idSelected) { ?> selected="selected"<?php } ?>><?php echo $libelle; ?></option>
<?php
        }
        ?>
</select>
<?php
    }
    
    public function dispListAdmin() {
        $sth=NULL;
        $query="SELECT id,libelle FROM table_groupes_personnes ORDER BY tstp ASC";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        while($row=$sth->fetchObject()) {
            $id=$row->id;
            $libelle=  str_replace('\\', '', $row->libelle);
            ?>
<div id="id<?php echo $id; ?>">
    <?php
    if($id==$this->idGroupe&&$this->test==0&&!empty($this->errorMsg)) {
        ?>
    <div class="erreur">
        <p>Erreur lors de la validation du formualaire :</p>
        <p><?php echo $this->getErrorMsg(); ?></p>
    </div>
    <p></p>
    <?php
    } elseif($id==$this->idGroupe&&$this->test==1) { ?>
    <p></p>
    <div class="info">
        <p>Libellé modifié !</p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <div class="fieldGroup">
    <div class="up2" onclick="javascript:upLibelle(<?php echo $id; ?>);"></div>
    <form action="gestion-groupes-<?php echo $id; ?>.html#id<?php echo $id; ?>" method="POST">
            <p>
                <label for="libelle<?php echo $id; ?>">Libellé du groupe :</label>
                <br/>
                <input type="text" name="libelle" id="libelle<?php echo $id; ?>" value="<?php echo $libelle; ?>" size="40" maxlength="200" />
                <br/>
                <input type="submit" value="Modifier" name="subm" />
                <br/>
            </p>
    </form>
    <div class="down2" onclick="javascript:downLibelle(<?php echo $id; ?>);"></div>
    </div>
    <div class="enLigne">
        <div class="delete2" onclick="javascript:testDelGroup(<?php echo $id; ?>);"></div>
        <div class="enLigne">
            <p>[Effacer]</p>
        </div>
    </div>
</div>
<p></p>
<?php
        }
    }
    
    public function testFormChangeLibelle() {
        if(isset($_POST["subm"], $_POST["libelle"], $_GET["idGroupe"])) {
            $this->idGroupe=  addslashes(htmlspecialchars($_GET["idGroupe"]));
            $this->getPostUpdateLibelle();
            $this->verifPostUpdateLibelle();
            if(empty($this->errorMsg)) {
                $this->updateLibelle();
            }
        }
    }
    
    private function getPostUpdateLibelle() {
        $this->libelle=  addslashes(htmlspecialchars($_POST["libelle"]));
    }
    
    private function verifPostUpdateLibelle() {
        if(empty($this->libelle)) {
            $this->errorMsg.="Champ LIBELLÉ vide.<br/>";
        } elseif(strlen($this->libelle)>200) {
            $this->errorMsg.="Champ LIBELLÉ trop long (200 Car. maxi).<br/>";
        }
    }
    
    private function updateLibelle() {
        $sth=NULL;
        $array=array();
        $query="UPDATE table_groupes_personnes SET libelle=? WHERE id=?";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->libelle,
            $this->idGroupe
        );
        $sth->execute($array);
        $this->test=1;
    }
    
    public function testChangePos() {
        if(isset($_GET["idUp"])||isset($_GET["idDown"])) {
            if(isset($_GET["idUp"])) {
                $up=TRUE;
                $id1=  addslashes(htmlspecialchars($_GET["idUp"]));
            } else {
                $up=FALSE;
                $id1=  addslashes(htmlspecialchars($_GET["idDown"]));
            }
            //
            $sth=NULL;
            $array=array();
            $query="SELECT tstp FROM table_groupes_personnes WHERE id=? LIMIT 0,1";
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
                    $query="SELECT id,tstp FROM table_groupes_personnes WHERE tstp<? ORDER BY tstp DESC LIMIT 0,1";
                } else {
                    $query="SELECT id,tstp FROM table_groupes_personnes WHERE tstp>? ORDER BY tstp ASC LIMIT 0,1";
                }
                $sth=$this->dbh->prepare($query);
                $array=array($timestamp1);
                $sth->execute($array);
                $row=$sth->fetchObject();
                if($row!=NULL) {
                    $id2=$row->id;
                    $timestamp2=$row->tstp;
                    //
                    $sth=NULL;
                    $array=array();
                    $query="UPDATE table_groupes_personnes SET tstp=? WHERE id=?";
                    $sth=$this->dbh->prepare($query);
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
    
    public function testDelGroup() {
        if(isset($_GET["idDel"])) {
            $idGroup=  addslashes(htmlspecialchars($_GET["idDel"]));
            //
            $sth=NULL;
            $array=array();
            $query="SELECT id,extension FROM table_personnes WHERE id_groupe=?";
            $sth=$this->dbh->prepare($query);
            $array=array($idGroup);
            $sth->execute($array);
            while($row=$sth->fetchObject()) {
                $idPers=$row->id;
                $extension=$row->extension;
                $filename=$this->dossierAdmin."imgPers".$idPers.$extension;
                $filenameMini=$this->dossierAdmin."imgPersMini".$idPers.$extension;
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
            $query="DELETE FROM table_personnes WHERE id_groupe=?";
            $sth=$this->dbh->prepare($query);
            $array=array($idGroup);
            $sth->execute($array);
            //
            $sth=NULL;
            $array=array();
            $query="DELETE FROM table_groupes_personnes WHERE id=?";
            $sth=$this->dbh->prepare($query);
            $array=array($idGroup);
            $sth->execute($array);
        }
    }
    
    public function display() {
        //affiche les groupes
        ?>
<div class="calcMidLeft">
    <ul>
    <?php
    $pers=new Personnes();
        $sth=NULL;
        $query="SELECT id,libelle FROM table_groupes_personnes ORDER BY tstp ASC";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        while($row=$sth->fetchObject()) {
            $idGrp=$row->id;
            $libGrp=  str_replace('\\', '', $row->libelle);
            ?>
        <li id="lbl<?php echo $idGrp; ?>" class="inLine">
            <span title="<?php echo $libGrp; ?>"><?php echo $libGrp; ?></span>
<div>
<?php
$pers->dispGroup($idGrp);
?>
</div>
        </li>
        <script type="text/javascript">
            document.getElementById("hid<?php echo $idGrp; ?>").style["display"]="none";
    </script>
<?php
        }
        ?>
    </ul>
</div>
<?php
    }
}

?>

<?php
/**
 * Description of Groupe
 *
 * @author pj
 */
class Groupe extends Objet {
    
    private $libelle="";
    private $id=0;
    private $dossierAdmin="../images/";
    
    function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    function __destruct() {
        parent::__destruct();
    }
    
    public function verifFormNewGroup() {
        if(isset($_POST["subm"], $_POST["libelle"])) {
            $this->getPostLibelle();
            $this->verifPostLibelle();
            if(empty($this->errorMsg)) {
                $this->insertGroup();
            }
        }
    }
    
    private function getPostLibelle() {
        $this->libelle=  addslashes(htmlspecialchars($_POST["libelle"]));
    }
    
    private function verifPostLibelle() {
        if(empty($this->libelle)) {
            $this->errorMsg.="Champ LIBELLÉ vide.<br/>";
        } elseif(strlen($this->libelle)>200) {
            $this->errorMsg.="Champ LIBELLÉ trop long (200 Car. maxi).<br/>";
        }
    }
    
    private function insertGroup() {
        $sth=NULL;
        $array=array();
        $query="INSERT INTO table_groupes_personnes (libelle, tstp) VALUES (?,?)";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->libelle,
            time()
        );
        $sth->execute($array);
        $this->message="Groupe \"".$this->getLibelle()."\" enregistré !";
        $this->blank();
        $this->test=1;
    }
    
    public function testChangeSelect() {
        if(isset($_GET["idGroupe"])) {
            $this->id=  addslashes(htmlspecialchars($_GET["idGroupe"]));
        }
    }
    
    public function dispListForm() {
        if(empty($this->id)) { ?>
<div class="info">
    <p>Choisissez un groupe ci-dessus.</p>
</div>
<?php
        } else {
            $nb=0;
            $sth=NULL;
            $array=array();
            $query="SELECT id,libelle FROM table_personnes WHERE id_groupe=? ORDER BY tstp ASC";
            $sth=$this->dbh->prepare($query);
            $array=array($this->id);
            $sth->execute($array);
            while($row=$sth->fetchObject()) {
                $nb++;
                $idPers=$row->id;
                $libelle=  str_replace('\\', '', $row->libelle);
                ?>
<div class="cadre1">
    <div class="up3" onclick="javascript:upPersonne(<?php echo $idPers; ?>, <?php echo $this->id; ?>);"></div>
                                <input type="radio" name="idPers" id="idPers<?php echo $idPers; ?>" value="<?php echo $idPers; ?>" />
                                <label for="idPers<?php echo $idPers; ?>">&nbsp;<?php echo $libelle; ?></label>
                                <div class="down3" onclick="javascript:downPersonne(<?php echo $idPers; ?>, <?php echo $this->id; ?>);"></div>
</div>
<br/>
                                <?php
            }
            if(!empty($nb)) { ?>
<input type="submit" value="Modifier" name="submModif" />
<span>&nbsp;</span>
<input type="submit" value="Effacer" name="submDel" onclick="javascript:return testDelPers();" />
<?php
            } else { ?>
<div class="info">
    <p>Groupe vide !</p>
</div>
<?php
            }
        }
    }
    
    public function testChangePosPers() {
        if(isset($_GET["idUp"])||isset($_GET["idDown"])) {
            if(isset($_GET["idUp"])) {
                $up=TRUE;
                $id1=  addslashes(htmlspecialchars($_GET["idUp"]));
            } else {
                $up=FALSE;
                $id1=  addslashes(htmlspecialchars($_GET["idDown"]));
            }
            // on recupere le timestamp1
            $sth=NULL;
            $array=array();
            $query="SELECT tstp FROM table_personnes WHERE id=? LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $array=array($id1);
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $timestamp1=$row->tstp;
                //on cherche l'autre personne
                $sth=NULL;
                $array=array();
                if($up) {
                    $query="SELECT id,tstp FROM table_personnes WHERE id_groupe=? AND tstp<? ORDER BY tstp DESC LIMIT 0,1";
                } else {
                    $query="SELECT id,tstp FROM table_personnes WHERE id_groupe=? AND tstp>? ORDER BY tstp ASC LIMIT 0,1";
                }
                $sth=$this->dbh->prepare($query);
                $array=array(
                    $this->id,
                    $timestamp1
                    );
                $sth->execute($array);
                $row=$sth->fetchObject();
                if($row!=NULL) {
                    $id2=$row->id;
                    $timestamp2=$row->tstp;
                    //on swap
                    $sth=NULL;
                    $array=array();
                    $query="UPDATE table_personnes SET tstp=? WHERE id=?";
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
    
    public function testModifPers() {
        if(isset($_POST["idPers"], $_POST["submModif"])) {
            $idPers=  addslashes(htmlspecialchars($_POST["idPers"]));
            ?>
<script type="text/javascript">
    window.location.href="modif-personne-<?php echo $idPers; ?>-<?php echo $this->id; ?>.html";
</script>
<?php
        }
    }
    
    public function testDelPers() {
        if(isset($_POST["submDel"], $_POST["idPers"])) {
            $idPers=  addslashes(htmlspecialchars($_POST["idPers"]));
            //on teste si il y a une image
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
                    $filename=$this->dossierAdmin."imgPers".$idPers.$extension;
                    $filenameMini=$this->dossierAdmin."imgPersMini".$idPers.$extension;
                    if(file_exists($filename)) {
                        unlink($filename);
                    }
                    if(file_exists($filenameMini)) {
                        unlink($filenameMini);
                    }
                }
            }
            //on efface le tuple dans la base
            $sth=NULL;
            $array=array();
            $query="DELETE FROM table_personnes WHERE id=?";
            $sth=$this->dbh->prepare($query);
            $array=array($idPers);
            $sth->execute($array);
        }
    }
    
    public function blank() {
        parent::blank();
        $this->libelle="";
    }


    public function getLibelle() {
        return str_replace('\\', '', $this->libelle);
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id=$id;
    }
}

?>

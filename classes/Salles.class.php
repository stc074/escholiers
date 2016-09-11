<?php
/**
 * Description of Salles
 *
 * @author pj
 */
class Salles extends Objet {
    
    private $idSalle=0;
    private $libelle="";
    private $idSpectacle=0;
    
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function dispListSelect($idSpectacle=0, $idSalle=0) {
        ?>
<select name="idSalle" id="idSalle">
    <option value="0"<?php if($idSalle==0) echo ' selected="selected"'; ?>>Choisissez</option>
<?php
        if(!empty($idSpectacle)) {
        $sth=NULL;
        $array=array();
        $query="SELECT id,libelle FROM table_salles WHERE id_spectacle=? ORDER BY tstp ASC";
        $sth=$this->dbh->prepare($query);
        $array=array($idSpectacle);
        $sth->execute($array);
        while($row=$sth->fetchObject()) {
            $id=$row->id;
            $libelle=  str_replace('\\', '', $row->libelle);
            ?>
    <option value="<?php echo $id; ?>"<?php if($id==$idSalle) echo ' selected="selected"'; ?>><?php echo $libelle; ?></option>
    <?php
        }
        }
        ?>
    </select>
<?php
    }
    
    public function dispListGestion($idSpectacle=0) {
        //affiche les salles dans "gestion"
        $sth=NULL;
        $array=array();
        $query="SELECT DISTINCT SA.id,SA.libelle FROM table_salles SA,table_evenements EV WHERE EV.id_spectacle=? AND SA.id=EV.id_salle ORDER BY SA.tstp";
        $sth=$this->dbh->prepare($query);
        $array=array($idSpectacle);
        $sth->execute($array);
        $nb=0;
        while($row=$sth->fetchObject()) {
            $nb++;
            $id=$row->id;
            $libelle=  str_replace('\\', '', $row->libelle);
            ?>
<div class="cadre1">
    <div class="up2" title="Déplacer avant" onclick="javascript:salleUp(<?php echo $idSpectacle; ?>, <?php echo $id; ?>);"></div>
    <div class="enLigne">
        <p><?php echo $libelle; ?></p>
    </div>
    <div class="down2" title="Déplacer après" onclick="javascript:salleDown(<?php echo $idSpectacle; ?>, <?php echo $id; ?>);"></div>
    <div class="delete2" title="Effacer cette salle" onclick="javascript:salleDel(<?php echo $idSpectacle; ?>, <?php echo $id; ?>);"></div>
</div>
<p></p>
<?php
        }
        if(empty($nb)) {
            ?>
<p></p>
<div class="info">
    <p>Aucune salle n'est associée à ce spectacle.</p>
</div>
<p></p>
<?php
        }
    }
    
    public function testChangePos($idSpectacle=0) {
        if(!empty($idSpectacle)) {
            if(isset($_GET["idUp"])||isset($_GET["idDown"])) {
                if(isset($_GET["idUp"])) {
                    $up=TRUE;
                    $id1=  addslashes(htmlspecialchars($_GET["idUp"]));
                } else {
                    $up=FALSE;
                    $id1=  addslashes(htmlspecialchars($_GET["idDown"]));
                }
                //on recupere le premier timestamp unix
                $sth=NULL;
                $array=array();
                $query="SELECT tstp FROM table_salles WHERE id=?";
                $sth=$this->dbh->prepare($query);
                $array=array($id1);
                $sth->execute($array);
                $row=$sth->fetchObject();
                if($row!=NULL) {
                    $timestamp1=$row->tstp;
                    //on recupere l'autre salle
                    $sth=NULL;
                    $array=array();
                    if($up) {
                        $query="SELECT id, tstp FROM table_salles WHERE id IN (SELECT id_salle FROM table_evenements WHERE id_spectacle=?) AND tstp<? ORDER BY tstp DESC LIMIT 0,1";
                    } else {
                        $query="SELECT id, tstp FROM table_salles WHERE id IN (SELECT id_salle FROM table_evenements WHERE id_spectacle=?) AND tstp>? ORDER BY tstp ASC LIMIT 0,1";
                    }
                    $sth=$this->dbh->prepare($query);
                    $array=array(
                        $idSpectacle,
                        $timestamp1
                    );
                    $sth->execute($array);
                    $row=$sth->fetchObject();
                    if($row!=NULL) {
                        $id2=$row->id;
                        $timestamp2=$row->tstp;
                        //on echange les 2 timestamp
                        $sth=NULL;
                        $array=array();
                        $query="UPDATE table_salles SET tstp=? WHERE id=?";
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
    }
    
    public function testDel() {
        if(isset($_GET["idDel"])) {
            $idSalle=  addslashes(htmlspecialchars($_GET["idDel"]));
            //
            $sth=NULL;
            $array=array();
            $query="DELETE FROM table_evenements WHERE id_salle=?";
            $sth=$this->dbh->prepare($query);
            $array=array($idSalle);
            $sth->execute($array);
            //
            $sth=NULL;
            $array=array();
            $query="DELETE FROM table_salles WHERE id=?";
            $sth=$this->dbh->prepare($query);
            $array=array($idSalle);
            $sth->execute($array);
        }
    }
    
    public function dispFormChg() {
        if(empty($this->idSpectacle)) {
            ?>
<p></p>
<div class="info">
    <p>Choisissez un spectacle !</p>
</div>
<p></p>
<?php
} else {
        $sth=NULL;
        $query="SELECT id,libelle FROM table_salles WHERE id_spectacle=? ORDER BY tstp";
        $sth=$this->dbh->prepare($query);
        $array=array($this->idSpectacle);
        $sth->execute($array);
        while($row=$sth->fetchObject()) {
            $id=$row->id;
            $libelle=  str_replace('\\', '', $row->libelle);
            ?>
<div id="form<?php echo $id; ?>">
    <?php
    if($id==$this->idSalle&&$this->test==0&&!empty($this->errorMsg)) { ?>
    <div class="erreur">
        <p>Erreur lors de la modification :</p>
        <p><?php echo $this->getErrorMsg(); ?></p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <div class="up3" title="En haut" onclick="javascript:window.location.href='modif-salles-up-<?php echo $this->idSpectacle; ?>-<?php echo $id; ?>.html';"></div>
    <form action="modif-salles.html#form<?php echo $id; ?>" method="POST">
        <input type="hidden" name="idSalle" value="<?php echo $id; ?>" />
        <fieldset>
            <legend><?php echo $libelle; ?></legend>
            <div class="inlineBlock">
                <label for="libelle<?php echo $id; ?>">Libellé :</label>
                <input type="text" name="libelle" id="libelle<?php echo $id; ?>" value="<?php echo $libelle; ?>" size="40" maxlength="200" />
                <input type="submit" value="Modifier" name="submModif" />
            </div>
            <div class="delete2" title="Effacer" onclick="javascript:window.location.href='modif-salles-delete-<?php echo $this->idSpectacle; ?>-<?php echo $id; ?>.html';"></div>
        </fieldset>
    </form>
    <div class="down3" title="En bas" onclick="javascript:window.location.href='modif-salles-down-<?php echo $this->idSpectacle; ?>-<?php echo $id; ?>.html';"></div>
</div>
<p></p>
<?php
        }
}
    }
    
    public function verifFormChg() {
        if(isset($_POST["submModif"], $_POST["idSalle"], $_POST["libelle"])) {
            $this->getPostsChg();
            $this->verifPostsChg();
            if(empty($this->errorMsg)) {
                $this->updateChg();
            }
        }
    }
    
    private function getPostsChg() {
        $this->idSalle=  addslashes(htmlspecialchars($_POST["idSalle"]));
        $this->libelle=  addslashes(htmlspecialchars($_POST["libelle"]));
    }
    
    private function verifPostsChg() {
        if(empty($this->libelle)) {
            $this->errorMsg.="Champ LIBELLÉ vide.<br/>";
        } elseif(strlen($this->libelle)>200) {
            $this->errorMsg.="Champ LIBELLÉ trop long (200 Car. maxi).<br/>";
        }
    }
    
    private function updateChg() {
        $sth=NULL;
        $array=array();
        $query="UPDATE table_salles SET libelle=? WHERE id=?";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->libelle,
            $this->idSalle
        );
        $sth->execute($array);
    }
    
    public function getGetGest() {
        if(isset($_GET["idSpectacle"])) {
            $this->idSpectacle=  addslashes(htmlspecialchars($_GET["idSpectacle"]));
        }
    }
    
    public function testModifPos() {
        if(!empty($this->idSpectacle)) {
        if(isset($_GET["idSalle"])&&(isset($_GET["up"])||isset($_GET["down"]))) {
            $up=FALSE;
            if(isset($_GET["up"])) {
                $up=TRUE;
            } elseif(isset($_GET["down"])) {
                $up=FALSE;
            }
            $id1=  addslashes(htmlspecialchars($_GET["idSalle"]));
            $query="SELECT tstp FROM table_salles WHERE id=? LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $array=array($id1);
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $tstp1=$row->tstp;
                //
                if($up) {
                    $query="SELECT id,tstp FROM table_salles WHERE id_spectacle=? AND tstp<? ORDER BY tstp DESC LIMIT 0,1";
                } else {
                    $query="SELECT id,tstp FROM table_salles WHERE id_spectacle=? AND tstp>? ORDER BY tstp ASC LIMIT 0,1";
                }
                $sth=$this->dbh->prepare($query);
                $array=array(
                    $this->idSpectacle,
                    $tstp1
                    );
                $sth->execute($array);
                $row=$sth->fetchObject();
                if($row!=NULL) {
                    $id2=$row->id;
                    $tstp2=$row->tstp;
                    //
                    $query="UPDATE table_salles SET tstp=? WHERE id=? AND id_spectacle=?";
                    $sth=$this->dbh->prepare($query);
                    $array=array(
                        $tstp1,
                        $id2,
                        $this->idSpectacle
                    );
                    $sth->execute($array);
                    //
                    $array=array(
                        $tstp2,
                        $id1,
                        $this->idSpectacle
                    );
                    $sth->execute($array);
                }
            }
        }
        }
    }
    
    public function testModifDel()  {
        if(isset($_GET["idDel"])&&isset($_GET["idSpectacle"])) {
            $idSalle=  addslashes(htmlspecialchars($_GET["idDel"]));
            $idSpectacle=  addslashes(htmlspecialchars($_GET["idSpectacle"]));
            $query="DELETE FROM table_evenements WHERE id_salle=? AND id_spectacle=?";
            $sth=$this->dbh->prepare($query);
            $array=array(
                $idSalle,
                $idSpectacle
            );
            $sth->execute($array);
            //
            $query="DELETE FROM table_salles WHERE id=? AND id_spectacle=?";
            $sth=$this->dbh->prepare($query);
            $sth->execute($array);
        }
    }
    
    public function dispListAjoutDate($idSpectacle=0,$idSalle=0) {
        ?>
<select name="idSalle" id="idSalle">
    <option value="0"<?php if($idSalle==0) { echo ' selected="selected"'; } ?>>Choisissez</option>
    <?php
    if($idSpectacle!=0) {
    $query="SELECT id,libelle FROM table_salles WHERE id_spectacle=? ORDER BY libelle ASC";
    $sth=$this->dbh->prepare($query);
    $array=array($idSpectacle);
    $sth->execute($array);
    while($row=$sth->fetchObject()) {
        $id=$row->id;
        $libelle=  str_replace('\\', '', $row->libelle);
        ?>
    <option value="<?php echo $id; ?>"<?php if($id==$idSalle) { echo ' selected="selected"'; } ?>><?php echo $libelle; ?></option>
    <?php
    }
    }
    ?>
</select>
<?php
    }
    
    public function getIdSpectacle() {
        return $this->idSpectacle;
    }
}

?>

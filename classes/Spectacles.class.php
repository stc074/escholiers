<?php
/**
 * Description of Spectacles
 *
 * @author pj
 */
class Spectacles extends Objet {
    
    private $idSpectacle=0;
    private $libelle="";
    private $libelleRec="";
    
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function initListSelect($idSpectacle=0) {
        ?>
<select name="idSpectacle" id="idSpectacle" onchange="javascript:window.location.href='edit-reservation-'+this.value+'.html#form';">
    <option value="0"<?php if($idSpectacle==0) echo ' selected="selected"'; ?>>Choisissez</option>
    <?php
    $sth=NULL;
    $query="SELECT id,libelle FROM table_spectacles ORDER BY libelle ASC";
    $sth=$this->dbh->prepare($query);
    $sth->execute();
    while($row=$sth->fetchObject()) {
        $id=$row->id;
        $libelle=  str_replace('\\', '', $row->libelle);
        ?>
    <option value="<?php echo $id; ?>"<?php if($idSpectacle==$id) echo ' selected="selected"'; ?>><?php echo $libelle; ?></option>
    <?php
    }
    ?>
</select>
<?php
    }
    
    public function initListChck() {
        $sth=NULL;
        $query="SELECT id,libelle,etat FROM table_spectacles";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        $nb=0;
        $noSpec=TRUE;
        while($row=$sth->fetchObject()) {
            $nb++;
            $id=$row->id;
            $libelle=  str_replace('\\', '', $row->libelle);
            $etat=$row->etat;
            if($etat==1) {
                $noSpec=FALSE;
            }
            ?>
    <input type="checkbox" id="idSpectacle<?php echo $id; ?>" name="idSpectacle<?php echo $id; ?>" value="<?php echo $id; ?>"<?php if($etat==1) { echo ' checked="checked"'; } ?> onclick="javascript:changeSpectAct(this, <?php echo $id; ?>);" />
                        <label for="idSpectacle<?php echo $id; ?>">&rarr;<?php echo $libelle; ?></label>
                        <br/>
                        <?php
        }
        if($noSpec) {
            ?>
                        <p></p>
                        <div class="erreur">
                            <p>Aucun specatcle selectionné pour la réservation</p>
                        </div>
                        <p></p>
                        <?php
        }
        if(empty($nb)) { ?>
                        <p></p>
                        <div class="info">
                            <p>Aucun spectacle enregistré !</p>
                        </div>
                        <?php
        }
    }
    
    public function dispListGestion($idSpectacle=0) {
        //on affiche tous les spectacles dans une liste déroulabnte
        ?>
                        <select name="idSpectacle" id="idSpectacle" onchange="javascript:window.location.href='salle-chge-spect-'+this.value+'.html#form';">
                            <option value="0"<?php if($idSpectacle==0) echo ' selected="selected"'; ?>>Choisissez</option>
                            <?php
                            $sth=NULL;
                            $query="SELECT id,libelle FROM table_spectacles";
                            $sth=$this->dbh->prepare($query);
                            $sth->execute();
                            while($row=$sth->fetchObject()) {
                                $id=$row->id;
                                $libelle=  str_replace('\\', '', $row->libelle);
                                ?>
                            <option value="<?php echo $id; ?>"<?php if($id==$idSpectacle) echo  ' selected="selected"'; ?>><?php echo $libelle; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <?php
    }
    
    public function dispListDates($idSpectacle=0) {
        ?>
                        <select name="idSpectacle" id="idSpectacle" onchange="javascript:window.location.href='gestion-dates-'+this.value+'.html#form';">
                            <option value="0"<?php if($idSpectacle==0) echo ' selected="selected"'; ?>>Choisissez</option>
                            <?php
                            //liste des spectacles
                            $sth=NULL;
                            $query="SELECT id,libelle FROM table_spectacles ORDER BY etat DESC";
                            $sth=$this->dbh->prepare($query);
                            $sth->execute();
                            while($row=$sth->fetchObject()) {
                                $id=$row->id;
                                $libelle=  str_replace('\\', '', $row->libelle);
                                ?>
                            <option value="<?php echo $id; ?>"<?php if($id==$idSpectacle) echo ' selected="selected"'; ?>><?php echo $libelle; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <?php
    }
    
    public function initFormChgLibelle() {
        $sth=NULL;
        $query="SELECT id,libelle FROM table_spectacles ORDER BY tstp ASC";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        while($row=$sth->fetchObject()) {
            $id=$row->id;
            $libelle=  str_replace('\\', '', $row->libelle);
            ?>
                        <div class="up3" onclick="javascript:window.location.href='libelle-spectacle-up-<?php echo $id; ?>.html';"></div>
                        <div id="form<?php echo $id; ?>">
                            <?php
                            if($id==$this->idSpectacle&&$this->test==0&&!empty($this->errorMsg)) { ?>
                            <div class="erreur">
                                <p>Erreur lors de la modification du libellé :</p>
                                <p><?php echo $this->getErrorMsg(); ?></p>
                            </div>
                            <p></p>
                            <?php
                            }
                            ?>
                        <form action="gestion-spectacles.html#form<?php echo $id; ?>" method="POST">
                            <input type="hidden" name="idSpectacle" value="<?php echo $id; ?>" />
                            <fieldset>
                                <legend>Spectacle #<?php echo $id; ?></legend>
                                <div class="inlineBlock">
                                    <label for="libelle<?php echo $id; ?>">Libelle :</label>
                                    <input type="text" name="libelle" id="libelle<?php echo $id; ?>" value="<?php echo $libelle; ?>" size="40" />
                                    <input type="submit" value="Modifier" name="submModif" />
                                </div>
                                <div class="delete2" title="Effacer ce spectacle" onclick="javascript:deleteSpectacle(<?php echo $id; ?>);"></div>
                            </fieldset>
                        </form>
                        </div>
                        <div class="down3" onclick="javascript:window.location.href='libelle-spectacle-down-<?php echo $id; ?>.html';"></div>
                        <p></p>
                        <?php
        }
    }
    
    public function verifFormChgLibelle() {
        if(isset($_POST["submModif"])) {
            $this->getPostsChgLibelle();
            $this->verifPostsChgLibelle();
            if(empty($this->errorMsg)) {
                $this->updateLibelle();
            }
        }
    }
    
    private function getPostsChgLibelle() {
        $this->idSpectacle=  addslashes(htmlspecialchars($_POST["idSpectacle"]));
        $this->libelle=  addslashes(htmlspecialchars($_POST["libelle"]));
    }
    
    private function verifPostsChgLibelle() {
        $query="SELECT COUNT(id) AS nb FROM table_spectacles WHERE libelle=?";
        $sth=$this->dbh->prepare($query);
        $array=array($this->libelle);
        $sth->execute($array);
        $row=$sth->fetchObject();
        $nb=0;
        if($row!=NULL) {
            $nb=$row->nb;
        }
        if(empty($this->libelle)) {
            $this->errorMsg.="Champ LIBELLÉ vide.<br/>";
        } elseif(strlen($this->libelle)>200) {
            $this->errorMsg.="Champ LIBELLE trop long (200 Car. max).<br/>";
        } elseif (!empty($nb)) {
            $this->errorMsg.="Ce LIBELLÉ est déjà pris !";
    }
    }
    
    private function updateLibelle() {
        $sth=NULL;
        $array=array();
        $query="UPDATE table_spectacles SET libelle=? WHERE id=?";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->libelle,
            $this->idSpectacle
        );
        $sth->execute($array);
    }
    
    public function dispListSpecSalle($idSpectacle=0) {
        $sth=NULL;
        $query="SELECT id, libelle FROM table_spectacles ORDER BY libelle";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        ?>
                        <select name="idSpectacle" id="idSpectacle" onchange="javascript:window.location.href='ajout-salle-'+this.value+'.html';">
                            <option value="0"<?php if($idSpectacle==0) { echo ' selected="selected"'; } ?>>Choisissez</option>
                            <?php
                            while($row=$sth->fetchObject()) {
                                $id=$row->id;
                                $libelle=  str_replace('\\', '', $row->libelle);
                                ?>
                            <option value="<?php echo $id; ?>"<?php if($id==$idSpectacle) { echo ' selected="selected"'; } ?>><?php echo $libelle; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <?php
    }
    
    public function testChgePosLib() {
        if((isset($_GET["up"])||isset($_GET["down"]))&&isset($_GET["idSpectacle"])) {
            $up=FALSE;
            if(isset($_GET["up"])) {
                $up=TRUE;
            } elseif (isset($_GET["down"])) {
                $up=FALSE;
            }
            $id1=  addslashes(htmlspecialchars($_GET["idSpectacle"]));
            //on récupère le timestamp unix
            $query="SELECT tstp FROM table_spectacles WHERE id=? LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $array=array($id1);
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $tstp1=$row->tstp;
                //
                if($up) {
                    $query="SELECT id,tstp FROM table_spectacles WHERE tstp<? ORDER BY tstp DESC LIMIT 0,1";
                } else {
                    $query="SELECT id,tstp FROM table_spectacles WHERE tstp>? ORDER BY tstp ASC LIMIT 0,1";
                }
                $sth=$this->dbh->prepare($query);
                $array=array($tstp1);
                $sth->execute($array);
                $row=$sth->fetchObject();
                if($row!=NULL) {
                    $id2=$row->id;
                    $tstp2=$row->tstp;
                    //on swap
                    $query="UPDATE table_spectacles SET tstp=? WHERE id=?";
                    $sth=$this->dbh->prepare($query);
                    $array=array(
                        $tstp1,
                        $id2
                    );
                    $sth->execute($array);
                    //
                    $array=array(
                        $tstp2,
                        $id1
                    );
                    $sth->execute($array);
                }
            }
        }
    }
    
    public function dispListChgSalle($idSpectacle=0) {
        $query="SELECT id,libelle FROM table_spectacles ORDER BY tstp";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        ?>
                        <select name="idSpectacle" id="idSpectacle" onchange="javascript:window.location.href='gestion-salle-spec-'+this.value+'.html';">
                            <option value="0"<?php if($idSpectacle==0) { echo ' selected="selected"'; } ?>>Choisissez</option>
                            <?php
                            while($row=$sth->fetchObject()) {
                                $id=$row->id;
                                $libelle=  str_replace('\\', '', $row->libelle);
                                ?>
                            <option value="<?php echo $id; ?>"<?php if($id==$idSpectacle) { echo ' selected="selected"'; } ?>><?php echo $libelle; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <?php
    }
    
    public function dispListAjoutDate($idSpectacle=0) {
        ?>
                        <select name="idSpectacle" id="idSpectacle" onchange="javascript:window.location.href='ajout-date-'+this.value+'.html#form';">
                            <option value="0"<?php if($idSpectacle==0) { echo ' selected="selected"'; } ?>>Choisissez</option>
                            <?php
                            $query="SELECT id,libelle FROM table_spectacles ORDER BY etat DESC";
                            $sth=$this->dbh->prepare($query);
                            $sth->execute();
                            while($row=$sth->fetchObject()) {
                                $id=$row->id;
                                $libelle=  str_replace('\\', '', $row->libelle);
                                ?>
                            <option value="<?php echo $id; ?>"<?php if($id==$idSpectacle) { echo ' selected="selected"'; } ?>><?php echo $libelle; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <?php
    }
    
    public function dispListTxtRes($idSpectacle=0) {
        ?>
                        <select name="idSpectacle" id="idSpectacle" onchange="javascript:window.location.href='texte-reservation-'+this.value+'.html#form';">
                            <option value="0"<?php if(empty($idSpectacle)) { echo ' selected="selected"'; } ?>>Choisissez</option>
                            <?php
                            $query="SELECT id,libelle FROM table_spectacles ORDER BY etat DESC";
                            $sth=$this->dbh->prepare($query);
                            $sth->execute();
                            while($row=$sth->fetchObject()) {
                                $id=$row->id;
                                $libelle=  str_replace('\\', '', $row->libelle);
                                ?>
                            <option value="<?php echo $id; ?>"<?php if($id==$idSpectacle) { echo ' selected="selected"'; } ?>><?php echo $libelle; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <?php
    }
    
    public function dispMenu() {
        $query="SELECT id,libelle FROM table_spectacles WHERE etat=? ORDER BY tstp";
        $sth=$this->dbh->prepare($query);
        $array=array(1);
        $sth->execute($array);
        while($row=$sth->fetchObject()) {
            $id=$row->id;
            $libelle=  str_replace('\\', '', $row->libelle);
            ?>
                        <li>
                            <a href="#" class="parent"><span>"<?php echo ucfirst($libelle); ?>"</span></a>
                            <div>
                                <ul>
                                    <li><a href="presentation-<?php echo $id; ?>.html"><span>Présentation</span></a></li>
                                    <li><a href="reservation-<?php echo $id; ?>.html"><span>Réservation</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <?php
        }
    }
    
    public function testDelete() {
        if(isset($_GET["idDel"])) {
            $idSpectacle=  addslashes(htmlspecialchars($_GET['idDel']));
            //
            $query="DELETE FROM table_reservations WHERE id_evenement IN (SELECT id FROM table_evenements WHERE id_spectacle=?)";
            $sth=$this->dbh->prepare($query);
            $array=array($idSpectacle);
            $sth->execute($array);
            //
            $query="DELETE FROM table_evenements WHERE id_spectacle=?";
            $sth=$this->dbh->prepare($query);
            $sth->execute($array);
            //
            $query="DELETE FROM table_salles WHERE id_spectacle=?";
            $sth=  $this->dbh->prepare($query);
            $sth->execute($array);
            //
            $query="DELETE FROM table_spectacles WHERE id=?";
            $sth=$this->dbh->prepare($query);
            $sth->execute($array);
        }
    }
    
}

?>

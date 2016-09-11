<?php
/**
 * Description of Galerie
 *
 * @author pj
 */
class Galerie extends Objet {
    
    private $id=0;
    private $titre="";
    private $folder="images/";
    private $dossierAdmin="../images/";
    
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    /**
     * Description de display
     * 
     *
     * @todo Affiche la gallerie de photos
     */
    
    public function display($idGalerie) {
        if(!empty($idGalerie)) {
            $this->id=$idGalerie;
            //nombre de photos;
            $sth=NULL;
            $array=array();
            $query="SELECT COUNT(id) AS nb FROM table_photos WHERE id_galerie=?";
            $sth=$this->dbh->prepare($query);
            $array=array($this->id);
            $sth->execute($array);
            $row=$sth->fetchObject();
            $nb=$row->nb;
            if(!empty($nb)) {
                //affiche le titre
                $sth=NULL;
                $array=array();
                $query="SELECT titre FROM table_galeries WHERE id=? LIMIT 0,1";
                $sth=$this->dbh->prepare($query);
                $array=array($this->id);
                $sth->execute($array);
                $row=$sth->fetchObject();
                if($row!=NULL) {
                    $titre=  str_replace('\\', '', $row->titre);
                    ?>
<h2><?php echo $titre; ?></h2>
<?php
                }
        ?>
<div id="divScroller">
<ul id="scroller">
    <?php
    $sth=NULL;
    $array=array();
    $req="SELECT id,commentaires,extension FROM table_photos WHERE id_galerie=? ORDER BY timestamp ASC";
    $sth=$this->dbh->prepare($req);
    $array=array($this->id);
    $sth->execute($array);
    while($row=$sth->fetchObject()) {
        $id=$row->id;
        $commentaires=  str_replace('\\', '', $row->commentaires);
        $extension=$row->extension;
        $filename=$this->dossierAdmin."img".$id.$extension;
        $filenameMini=$this->dossierAdmin."imgMini".$id.$extension;
        $img=new Image();
        $img->init($filenameMini, $extension);
        $width=$img->getLargeurSource();
        $height=$img->getHauteurSource();
        ?>
    <li>
        <a href="<?php echo $filename; ?>" title="<?php echo $commentaires; ?>">
            <img src="<?php echo $filenameMini; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="<?php echo $commentaires; ?>"/>
        </a>
    </li>
    <?php
    }
    ?>
</ul>
</div>
<?php
            }
        }
    }
    
    public function displaySite() {
        if(!empty($this->id)) {
            //nombre de photos;
            $sth=NULL;
            $array=array();
            $query="SELECT COUNT(id) AS nb FROM table_photos WHERE id_galerie=?";
            $sth=$this->dbh->prepare($query);
            $array=array($this->id);
            $sth->execute($array);
            $row=$sth->fetchObject();
            $nb=$row->nb;
            if(!empty($nb)) {
                //affiche le titre
                $sth=NULL;
                $array=array();
                $query="SELECT titre FROM table_galeries WHERE id=? LIMIT 0,1";
                $sth=$this->dbh->prepare($query);
                $array=array($this->id);
                $sth->execute($array);
                $row=$sth->fetchObject();
                if($row!=NULL) {
                    $titre=  str_replace('\\', '', $row->titre);
                    ?>
<div id="galerie">
<h2><?php echo $titre; ?></h2>
<?php
                }
        ?>
<div id="divScroller">
<ul id="scroller">
    <?php
    $sth=NULL;
    $array=array();
    $req="SELECT id,commentaires,extension FROM table_photos WHERE id_galerie=? ORDER BY timestamp ASC";
    $sth=$this->dbh->prepare($req);
    $array=array($this->id);
    $sth->execute($array);
    while($row=$sth->fetchObject()) {
        $id=$row->id;
        $commentaires=  str_replace('\\', '', $row->commentaires);
        $extension=$row->extension;
        $filename=$this->folder."img".$id.$extension;
        $filenameMini=$this->folder."imgMini".$id.$extension;
        $img=new Image();
        $img->init($filenameMini, $extension);
        $width=$img->getLargeurSource();
        $height=$img->getHauteurSource();
        ?>
    <li>
        <a href="<?php echo $filename; ?>" title="<?php echo $commentaires; ?>">
            <img src="<?php echo $filenameMini; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="<?php echo $commentaires; ?>"/>
        </a>
    </li>
    <?php
    }
    ?>
</ul>
</div>
</div>
<?php
            }
        }
    }
    
    public function testFormNouv() {
        if(isset($_POST["subm"], $_POST["titre"])) {
            $this->getPostNouv();
            $this->verifPostNouv();
            if(empty($this->errorMsg)) {
                $this->recNouv();
            }
        }
    }
    
    private function getPostNouv() {
        $this->titre=  addslashes(htmlspecialchars($_POST["titre"]));
    }
    
    private function verifPostNouv() {
        if(empty($this->titre)) {
            $this->errorMsg.="Champ LIBELLÉ DE LA GALERIE vide.<br/>";
        } elseif(strlen($this->titre)>200) {
            $this->errorMsg.="Champ LIBELLÉ DE LA GALERIE trop long (200 Car. maxi).<br/>";
        }
    }
    
    private function recNouv() {
        $sth=NULL;
        $array=array();
        $query="INSERT INTO table_galeries (titre, tstp) VALUES (?,?)";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->titre,
            time()
        );
        $sth->execute($array);
        $this->message="La galerie \"".  $this->getTitre()."\" a bien été enregistrée.";
        $this->blank();
        $this->test=1;
    }
    
    public function displaySelects($id=0) {
        ?>
<select name="idGalerie">
    <option value="0"<?php if($id==0) echo ' selected="selected"'; ?>>Choisissez</option>
    <?php
    $sth=NULL;
    $query="SELECT id,titre FROM table_galeries ORDER BY tstp";
    $sth=$this->dbh->prepare($query);
    $sth->execute();
    while($row=$sth->fetchObject()) {
        $idGalerie=$row->id;
        $titre=  str_replace('\\', '', $row->titre);
        ?>
    <option value="<?php echo $idGalerie; ?>"<?php if($idGalerie==$id) echo ' selected="selected"'; ?>><?php echo $titre; ?></option>
    <?php
    }
    ?>
</select>
<?php
    }
    
    public function testNewGalerie() {
        if(isset($_GET["idGalerie"])) {
            $this->id=  addslashes(htmlspecialchars($_GET["idGalerie"]));
        }
    }
    
    public function blank() {
        parent::blank();
        $this->titre="";
    }


    public function getTitre() {
        return str_replace('\\','', $this->titre);
    }
    
    public function setId($id) {
        $this->id=$id;
    }
    
    public function getId() {
        return $this->id;
    }
}

?>

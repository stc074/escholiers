<?php
/**
 * Description of Personnes
 *
 * @author pj
 */
class Personnes extends Objet {
    
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function dispGroup($idGrp) {
        //on affiche les personnes du groupe $idGrp
        ?>
<ul class="personnes">
    <?php
        $sth=NULL;
        $array=array();
        $query="SELECT id,libelle FROM table_personnes WHERE id_groupe=? ORDER BY tstp ASC";
        $sth=$this->dbh->prepare($query);
        $array=array($idGrp);
        $sth->execute($array);
        while($row=$sth->fetchObject()) {
            $id=$row->id;
            $libelle=  str_replace('\\', '', $row->libelle);
            ?>
<li id="li<?php echo $id; ?>">
    <a href="personne-<?php echo $id; ?>-<?php echo $idGrp; ?>.html" title="<?php echo $libelle; ?>" rel="superbox[iframe]"><?php echo $libelle; ?></a>
</li>
<?php
        }
        ?>
</ul>
<?php
    }
}

?>

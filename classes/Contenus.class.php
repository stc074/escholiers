<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contenus
 *
 * @author pj
 */
class Contenus extends Objet {
    
    function __construct() {
        parent::__construct();
    }
    
    function __destruct() {
        parent::__destruct();
    }
    
    public function dispListForm() {
        $this->dbConnect();
        $sth=NULL;
        $requete="SELECT id,main_titre,titre FROM table_pages_contenu ORDER BY titre ASC";
        $sth=$this->dbh->prepare($requete);
        $sth->execute();
        while($row=$sth->fetchObject()) {
            $id=$row->id;
            $mainTitre=  str_replace('\\', '', $row->main_titre);
            $titre=str_replace('\\','', $row->titre);
            $url=$this->codeURL($titre, $id);
            ?>
                        <input type="radio" name="idPage" id="idPage<?php echo $id; ?>" value="<?php echo $id; ?>" />
                        <label for="idPage<?php echo $id; ?>">&rarr;<?php echo $mainTitre; ?>(&nbsp;<?php echo $titre; ?>)</label>
                        <span>&nbsp;Adresse : <?php echo $url; ?></span>
                        <br/>
                        <?php
        }
    }
    
    public function testDelPage() {
        if(isset($_POST["submDel"], $_POST["idPage"])) {
            $idPage=  htmlspecialchars($_POST["idPage"]);
            $this->dbConnect();
            $sth=NULL;
            $array=array();
            $req="DELETE FROM table_pages_contenu WHERE id=?";
            $sth=$this->dbh->prepare($req);
            $array=array($idPage);
            $sth->execute($array);
        }
    }
    
    public function testModifPage() {
        if(isset($_POST["submModif"], $_POST["idPage"])) {
            $idPage=  htmlspecialchars($_POST["idPage"]);
            ?>
                        <script type="text/javascript">
                    window.location.href="modifier-page-<?php echo $idPage; ?>.html";    
                    </script>
                    <?php
        }
    }
}

?>

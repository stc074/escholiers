<?php

/**
 * Description of Tags
 *
 * @author pj
 */
class Tags extends Objet {
    
    private $title="Les escholiers - Annecy";
    private $description="Troupe de théatre Les escholiers - Annecy.";
    private $page=0;
    private $numPage=0;
    
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function initTags() {
        switch ($this->page) {
            case 2:
                if(!empty($this->numPage)) {
                    $this->loadTags("table_pages_contenu", $this->numPage);
                }
                break;
                case 1:
                    $this->loadTags("table_presentation_compagnie");
                    break;
                case 3:
                    $this->title="Les escholiers - Historique de la compagnie";
                    $this->description.="Historique de la compagnie.";
                    break;
                case 4:
                    $this->title="Les escholiers - Les personnes";
                    $this->description="Les personnes de la troupe les escholiers.";
                    break;
                case 5:
                    $this->loadTagsRes();
                   break;
                case 6:
                    $this->title="Les escholiers - Galeries de photos";
                    $this->description="Découvrez nos galeries de photos.";
                    break;
                case 7:
                    $this->title="Les escholiers - Nos vidéos";
                    $this->description="Les Escholiers - Découvrez nos nombreuses vidéos.";
                    break;
                case 8:
                    $this->title="Les escholiers Annecy - Plan d'accès";
                    $this->description="Plan d'accès pour venir nous voir.";
                    break;
                case 9:
                    $this->title="Les escholiers Annecy - Contact";
                    $this->description="Contactez la troupe des escholiers.";
                    break;
                case 10:
                    $this->title="Les escholiers - Livre d'or du site";
                    $this->description="Signez notre livre d'or !";
                    break;
                case 11:
                    $this->loadTagsPres();
                    break;
        }
    }
    
    private function loadTags($table, $id=0) {
        $query="SELECT title,description FROM $table";
        if(!empty($id)) {
            $query.=" WHERE id=?";
        }
        $query.=" LIMIT 0,1";
        $sth=$this->dbh->prepare($query);
        if(!empty($id)) {
            $array=array($id);
            $sth->execute($array);
        } else {
            $sth->execute();
        }
        //echo $query;
        $row=$sth->fetchObject();
        if($row!=NULL) {
            $this->title=$row->title;
            $this->description=$row->description;
        }
    }
    
    private function loadTagsRes() {
        $this->title="Les escholiers Annecy - Réservation";
        $this->description="Réservation, les Escholiers Annecy";
        //
        if(isset($_GET['idSpectacle'])) {
            $idSpectacle=  addslashes(htmlspecialchars($_GET['idSpectacle']));
        $query="SELECT libelle FROM table_spectacles WHERE id=? LIMIT 0,1";
        $sth=$this->dbh->prepare($query);
        $array=array($idSpectacle);
        $sth->execute($array);
        $row=$sth->fetchObject();
        if($row!=NULL) {
            $libelle=  str_replace('\\', '', $row->libelle);
            $this->title='Les Escholiers Annecy - Reservation pour "'.$libelle.'"';
            $this->description='Réservation pour le spectacle :'.$libelle.'.';
        }
        }       
    }
    
    private function loadTagsPres() {
        if(isset($_GET['idSpectacle'])) {
            $idSpectacle=  addslashes(htmlspecialchars($_GET['idSpectacle']));
            //
            $query="SELECT title,description FROM table_presentations WHERE id_spectacle=? LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $array=array($idSpectacle);
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $this->title=  str_replace('\\', '', $row->title);
                $this->description=  str_replace('\\', '', $row->description);
            }
        }
    }
    
    public function getGets() {
        if(isset($_GET["page"])) {
            $this->page=  addslashes(htmlspecialchars($_GET["page"]));
        }
        if(isset($_GET["numPage"])) {
            $this->numPage=  addslashes(htmlspecialchars($_GET["numPage"]));
        }
    }
    
    public function getTitle() {
        return str_replace('\\', '', $this->title);
    }
    
    public function getDescription() {
        return str_replace('\\', '', $this->description);
    }
}

?>

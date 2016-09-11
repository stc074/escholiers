<?php

/**
 * Description of Presentation
 *
 * @author pj
 */
class Presentation extends Objet {
    
    private $idSpectacle=0;
    private $content="";
    private $title="";
    private $description="";
    
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function initContent() {
        if(!empty($this->idSpectacle)) {
            $query="SELECT content FROM table_presentations WHERE id_spectacle=? LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $array=array($this->idSpectacle);
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $this->content=$row->content;
            }
        }
    }
    
    public function getGets() {
        if(isset($_GET['idSpectacle'])) {
            $this->idSpectacle=  addslashes(htmlspecialchars($_GET['idSpectacle']));
        }
    }
    
    public function getContent() {
        return str_replace('\\', '', $this->content);
    }
    
    public function getTitle() {
        return str_replace('\\', '', $this->title);
    }
    
    public function getDescription() {
        return str_replace('\\', '', $this->description);
    }
}

?>

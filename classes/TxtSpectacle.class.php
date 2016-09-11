<?php

/**
 * Description of TxtSpectacle
 *
 * @author pj
 */
class TxtSpectacle extends Objet {
    
    private $id=0;
    private $idSpectacle=0;
    private $content="";
    private $date="";
    //
    private $idValidator=NULL;
    private $contentValidator=NULL;


    public function __construct() {
        parent::__construct();
        $this->dbConnect();
        $this->idValidator=new IdValidator();
        $this->contentValidator=new TextFieldValidator();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function initInfos() {
        if(!empty($this->idSpectacle)) {
            $query="SELECT id,content,tstp FROM table_texte_reservation WHERE id_spectacle=? LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $array=array($this->idSpectacle);
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $this->id=$row->id;
                $this->content=$row->content;
                $this->date="Dernière modification, le ".date("d-m-Y", $row->tstp);
            }
        }
    }
    
    public function verifFormUpdate() {
        if(isset($_POST["subm"], $_POST["idSpectacle"], $_POST["content"])) {
            $this->getPostsUpdate();
            $this->verifPostsUpdate();
            if(Validator::getOK()) {
                $this->update();
            }
        }
    }
    
    private function getPostsUpdate() {
        $this->idSpectacle=  addslashes(htmlspecialchars($_POST["idSpectacle"]));
        $this->content=$this->codeHTML($_POST["content"]);
    }
    
    private function verifPostsUpdate() {
        Validator::setOK(TRUE);
        $this->idValidator->validate($this->idSpectacle);
        $this->contentValidator->validate($this->content, 0, 2000);
    }
    
    private function update() {
        if(empty($this->id)) {
            $query="INSERT INTO table_texte_reservation (id_spectacle, content, tstp) VALUES (?,?, ?)";
            $sth=$this->dbh->prepare($query);
            $array=array(
                $this->idSpectacle,
                $this->content,
                time()
            );
            $sth->execute($array);
        } else {
            $query="UPDATE table_texte_reservation SET content=?,tstp=? WHERE id=? AND id_spectacle=?";
            $sth=$this->dbh->prepare($query);
            $array=array(
                $this->content,
                time(),
                $this->id,
                $this->idSpectacle
            );
            $sth->execute($array);
        }
        $this->test=1;
    }
    
    public function getGets() {
        if(isset($_GET["idSpectacle"])) {
            $this->idSpectacle=  addslashes(htmlspecialchars($_GET["idSpectacle"]));
        }
    }
    
    public function getValidator($validator) {
        switch($validator) {
            case 'id':
                return $this->idValidator;
                break;
            case 'content':
                return $this->contentValidator;
                break;
        }
        return new Validator();
    }
    
    public function getIdSpectacle() {
        return $this->idSpectacle;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getContent() {
        return str_replace('\\', '', $this->content);
    }
    
    public function getDate() {
        return str_replace('\\', '', $this->date);
    }
}

?>

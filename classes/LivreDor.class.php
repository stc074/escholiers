<?php

/**
 * Description of LivreDor
 *
 * @author pj
 */
class LivreDor extends Objet {
    
    private $page=0;
    private $nbPages=0;
    private $nbMsgPage=2;
    
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function initPages() {
        $nbMessages=0;
        $query="SELECT COUNT(id) AS nb FROM table_messages_ldo";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        $row=$sth->fetchObject();
        if($row!=NULL) {
            $nbMessages=$row->nb;
        }
        $nb=$nbMessages/$this->nbMsgPage;
        $this->nbPages=  ceil($nb);
        //echo $this->nbPages;
    }
    
    public function dispMessages() {
        $query="SELECT author,content,tstp FROM table_messages_ldo ORDER BY tstp DESC LIMIT ".($this->page*$this->nbMsgPage).",".($this->nbMsgPage);
        //echo $query;
        $sth=  $this->dbh->prepare($query);
        $sth->execute();
        while($row=$sth->fetchObject()) {
            $author=  str_replace('\\', '', $row->author);
            $content=  str_replace('\\', '', $row->content);
            $date=" posté le ".date("d/m/Y", $row->tstp);
            ?>
<div class="msgLdo">
    <h1>Message de : <?php echo $author; ?><?php echo $date; ?></h1>
    <p><?php echo $content; ?></p>
</div>
<p></p>
<?php
        }
        ?>
<p></p>
<div class="pagesLdo">
    <?php
        $first=$this->page-5;
        if($first<0) {
            $first=0;
        }
        $last=$this->page+5;
        if($last>=$this->nbPages) {
            $last=$this->nbPages-1;
        }
        for($i=$first; $i<=$last; $i++) {
            ?>
    <span class="pageLdo"><a href="livre-d-or-page-<?php echo $i; ?>.html" title="ALLER À LA PAGE N°<?php echo $i+1; ?>"><?php echo $i+1; ?></a></span>
    <?php
        }
        ?>
</div>
<?php
}

    public function dispListDel() {
        $query="SELECT id,author,content,tstp FROM table_messages_ldo ORDER BY tstp DESC";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        while($row=$sth->fetchObject()) {
            $id=$row->id;
            $author=  str_replace('\\', '', $row->author);
            $content=  str_replace('\\', '', $row->content);
            $date="le ".date("d-m-Y", $row->tstp);
            ?>
<div class="ldo">
    <h1>Message de <?php echo $author; ?> posté <?php echo $date; ?> :</h1>
    <p><?php echo $content; ?></p>
</div>
<div class="delete2" title="Effacer ce message" onclick="javascript:deleteMessage(<?php echo $id; ?>);"></div>
<p></p>
<?php
        }
    }
    
    public function testDelMsg() {
        if(isset($_GET['idDel'])) {
            $idMessage=  addslashes(htmlspecialchars($_GET['idDel']));
            //
            $query="DELETE FROM table_messages_ldo WHERE id=?";
            $sth=  $this->dbh->prepare($query);
            $array=array($idMessage);
            $sth->execute($array);
        }
    }

    public function getGets() {
        if(isset($_GET['p'])) {
            $this->page=  addslashes(htmlspecialchars($_GET['p']));
        }
    }
}

?>

<?php

/**
 * Description of PlaylistVideo
 *
 * @author pj
 */
class PlaylistVideo extends Objet {
    
    private $dossierVideo="";
    private $dossierImage="";
    
    function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    function __destruct() {
        parent::__destruct();
    }
    
    public function displayXML($mode=FALSE) {
        if($mode) {
            $this->dossierImage="images/";
            $this->dossierVideo="videos/";
        } else {
            $this->dossierImage="../images/";
            $this->dossierVideo="../videos/";
        }
        ?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/">
    <channel>
        <title>Playlist</title>
        <?php
    $sth=NULL;
        $array=array();
        $query="SELECT id,url,commentaires,extension FROM table_videos ORDER BY timestamp ASC";
        $sth=$this->dbh->prepare($query);
        $array=array("");
        $sth->execute($array);
        while($row=$sth->fetchObject()) {
            $idVideo=$row->id;
            $url=$row->url;
            $extVideo=$row->extension;
            $commentaires=  str_replace('\\', '', $row->commentaires);
            if(!empty($url)) {
                ?>
        <item>
            <description><?php echo $commentaires; ?></description>
            <media:content url="<?php echo $url; ?>" />
        </item>
        <?php
            } elseif(!empty($extVideo)) {
                $sth2=NULL;
                $array2=array();
                $query="SELECT id,extension FROM table_images_video WHERE id_video=? LIMIT 0,1";
                $sth2=$this->dbh->prepare($query);
                $array2=array($idVideo);
                $sth2->execute($array2);
                $row2=$sth2->fetchObject();
                if($row2!=NULL) {
                    $idImg=$row2->id;
                    $extImg=$row2->extension;
                    $filenameVideo=$this->dossierVideo."video".$idVideo.$extVideo;
                    $filenameImg=$this->dossierImage."imgVideo".$idImg.$extImg;
                    if(file_exists($filenameImg)&&  file_exists($filenameVideo)) {
                    ?>
                <item>
                    <description><?php echo $commentaires; ?></description>
                    <media:content url="<?php echo $filenameVideo; ?>" />
                    <media:thumbnail url="<?php echo $filenameImg; ?>" />
                </item>
                <?php
                    }
                }
            }
        }
?>
        </channel>
</rss>
<?php
    }
    
    public function dispListVideos() {
        ?>
<h2>Vidéos</h2>
<?php
    $sth=NULL;
    $query="SELECT id,commentaires FROM table_videos ORDER BY timestamp ASC";
    $sth=$this->dbh->prepare($query);
    $sth->execute();
    while($row=$sth->fetchObject()) {
        $idVideo=$row->id;
        $commentaires=  str_replace('\\', '', $row->commentaires);
        ?>
<div class="itemVideoModif">
    <div class="down2" onclick="javascript:downVideo(<?php echo $idVideo; ?>);"></div>
    <div class="commentsMod"><?php echo $commentaires; ?></div>
    <div class="up2" onclick="javascript:upVideo(<?php echo $idVideo; ?>);"></div>
    <div class="delete2" onclick="javascript:deleteVideo(<?php echo $idVideo; ?>);"></div>
</div>
<p></p>
<?php
    }
}

    public function testMov() {
        if((isset($_GET["up"])||isset($_GET["down"]))&&isset($_GET["idVideo"])) {
            $idVideo1=  addslashes(htmlspecialchars($_GET["idVideo"]));
            $up=FALSE;
            $youtube=FALSE;
            $type=0;
            if(isset($_GET["up"])) {
                $up=TRUE;
            } elseif(isset($_GET["down"])) {
                $up=FALSE;
            }
            //
            $sth=NULL;
            $array=array();
            $query="SELECT timestamp FROM table_videos WHERE id=? LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $array=array($idVideo1);
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $timestamp1=$row->timestamp;
                //recherche de l'autre tuple
                $sth=NULL;
                $array=array();
                $query="";
                if($up) {
                    $query="SELECT id,timestamp FROM table_videos WHERE timestamp<? ORDER BY timestamp DESC LIMIT 0,1";
                } else {
                    $query="SELECT id,timestamp FROM table_videos WHERE timestamp>? ORDER BY timestamp ASC LIMIT 0,1";
                }
                $sth=$this->dbh->prepare($query);
                $array=array($timestamp1);
                $sth->execute($array);
                $row=$sth->fetchObject();
                if($row!=NULL) {
                    $idVideo2=$row->id;
                    $timestamp2=$row->timestamp;
                    //swap
                    $sth=NULL;
                    $array=array();
                    $query="UPDATE table_videos SET timestamp=? WHERE id=?";
                    $sth=$this->dbh->prepare($query);
                    $array=array(
                        $timestamp1,
                        $idVideo2
                    );
                    $sth->execute($array);
                    //
                    $array=array(
                        $timestamp2,
                        $idVideo1
                    );
                    $sth->execute($array);
                }
            }
        }
    }
    
    public function testDel() {
        if(isset($_GET["idDel"])) {
            $this->dossierImage="../images/";
            $this->dossierVideo="../videos/";
            $idVideo=  addslashes(htmlspecialchars($_GET["idDel"]));
            $sth=NULL;
            $array=array();
            $query="SELECT extension FROM table_videos WHERE id=?";
            $sth=$this->dbh->prepare($query);
            $array=array($idVideo);
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $extension=$row->extension;
                if(!empty($extension)) {
                    $filenameVideo=$this->dossierVideo."video".$idVideo.$extension;
                    if(file_exists($filenameVideo)) {
                        unlink($filenameVideo);
                    }
                    $sth=NULL;
                    $array=array();
                    $query="SELECT id,extension FROM table_images_video WHERE id_video=? LIMIT 0,1";
                    $sth=  $this->dbh->prepare($query);
                    $array=array($idVideo);
                    $sth->execute($array);
                    $row=$sth->fetchObject();
                    if($row!=NULL) {
                        $idImg=$row->id;
                        $extension=$row->extension;
                        $filenameImage=$this->dossierImage."imgVideo".$idImg.$extension;
                        if(file_exists($filenameImage)) {
                            unlink($filenameImage);
                        }
                    }
                    //effacement du tuple image
                    $sth=NULL;
                    $array=array();
                    $query="DELETE FROM table_images_video WHERE id_video=?";
                    $sth=$this->dbh->prepare($query);
                    $array=array($idVideo);
                    $sth->execute($array);
                }
            }
            //Effacement du tuple
            $sth=NULL;
            $array=array();
            $query="DELETE FROM table_videos WHERE id=?";
            $sth=$this->dbh->prepare($query);
            $array=array($idVideo);
            $sth->execute($array);
        }
    }
}

?>

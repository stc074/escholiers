<h2>Ajouter une nouvelle vidéo</h2>
<p>Pour ajouter une vidéo, utilmisez le formulaire ci-dessous.</p>
<p>Formats acceptés : H.264 (.mp4, .mov, .f4v), FLV (.flv), 3GPP (.3gp, .3g2), YouTube.</p>
<?php
$video=new UploadVideo();
$video->verifForm();
$video->delAlone();
?>
<div id="form">
    <?php
    $error=$video->getErrorMsg();
    if($video->getTest()==0&&!empty($error)) { ?>
    <div class="erreur">
        <p>Erreur :</p>
        <p><?php echo $error; ?></p>
    </div>
    <?php } ?>
    <form action="ajouter-video.html#form" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Upload de vidéo via un fichier</legend>
            <p>Vous avez le choix entre uploader un fichier ou poster une adresse youtube.</p>
            <p>
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $video->getMAXSIZE(); ?>">
                <label for="video">Fichier de vidéo :</label>
                <input type="file" id="video" name="video" value="" />
                <br/>
                <label for="image">Fichier de l'image de présentation de la vidéo :</label>
                <input type="file" id="image" name="image" value="" />
                <br/>
            </p>
        </fieldset>
        <br/>
        <fieldset>
            <legend>Vidéo youtube</legend>
            <p>
                <label for="url">Adresse de la vidéo sur youtube :</label>
                <br/>
                <input type="text" name="url" id="url" value="<?php echo $video->getUrl(); ?>" size="50" maxlength="200" />
                <br/>
            </p>
        </fieldset>
        <br/>
        <fieldset>
            <legend>Commentaire</legend>
            <p>
                <label for="commentaires">Court commmentaire sur cette vidéo :</label>
                <br/>
                <input type="text" name="commentaires" value="<?php echo $video->getCommentaires(); ?>" size="50" maxlength="200" />
                <br/>                
            </p>
        </fieldset>
        <br/>
        <input type="submit" value="Enregistrer" name="subm" />
    </form>
</div>
<p></p>
<h2>Playliste de vidéos</h2>
<div id='mediaspace' class="mediaspace">This text will be replaced</div>
 
<script type='text/javascript'>
  jwplayer('mediaspace').setup({
    'flashplayer': '../mediaplayer-5.10-viral/player.swf',
    'playlistfile': '../videos/playlist.php',
    'playlist': 'bottom',
    'controlbar': 'bottom',
    'width': '470',
    'height': '470'
  });
</script>

<h2>Ajouter une photo</h2>
<p>Pour ajouter une photo à la gallerie, utilisez le formulaire ci-dessous, les dernières sont ajoutés en dernier.</p>
<?php
$img=new UploadImage();
$galerie=new Galerie();
$img->testForm();
?>
<div id="form">
    <?php
    if($img->getTest()==1) { ?>
    <p></p>
    <div class="vignette">
        <a href="<?php echo $img->getFilename(); ?>" title="<?php echo $img->getMessage(); ?>">
        <img src="<?php echo $img->getFilenameMini(); ?>" width="<?php echo $img->getImg()->getLargeurSource(); ?>" height="<?php echo $img->getImg()->getHauteurSource(); ?>" alt="vignette" />
        </a>
        <p>Image enregistrée (cliquez dessus pour voir en taille réelle).</p>
    </div>
    <p></p>
    <?php
    }
    $error=$img->getErrorMsg();
    if($img->getTest()==0&&!empty($error)) { ?>
    <div class="erreur">
        <p>Erreur(s) lors de l'upload de l'image :</p>
        <p><?php echo $error; ?></p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <form action="ajouter-photo.html#form" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Image à télécharger</legend>
            <p>
                <label for="idGalerie">Choisissez la galerie contenant la photo :</label>
                <?php
                $galerie->displaySelects($img->getGalerie()->getId());
                ?>
                <br/>
                <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
                <label for="photo">Image à uploader :</label>
                <input type="file" name="photo" id="photo" value="" />
                <br/>
                <label for="commentaires">Commentaires sur l'image :</label>
                <br/>
                <input type="text" name="commentaires" id="commentaires" value="<?php echo $img->getCommentaires(); ?>" size="50" maxlength="200" />
                <br/>
                <input type="submit" value="Enregistrer" name="subm" />
            </p>
        </fieldset>
    </form>
</div>
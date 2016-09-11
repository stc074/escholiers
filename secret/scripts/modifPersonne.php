<h2>Modifier une personne</h2>
<p>Pour modifier une personne utilisez les 2 formulaires ci-dessous</p>
<?php
$img=new UploadImage();
$img->testFormPers();
$img->testDelPhotoPersModif();
$pers=new Personne();
$pers->initPersonne();
$pers->verifFormModif();
?>
<div id="form1">
    <?php
    $error=$img->getErrorMsg();
    if(!empty($error)&&$img->getTest()==0) { ?>
    <div class="erreur">
        <p>Erreur(s) lors de l'upload :</p>
        <p><?php echo $error; ?></p>
    </div>
    <p></p>
    <?php
    }
    if($img->getTest()==1) { ?>
    <p></p>
    <div class="info">
        <p>Image modifiée !</p>
    </div>
    <p></p>
    <?php } ?>
    <form action="modif-personne-<?php echo $pers->getId(); ?>-<?php echo $pers->getGroupe()->getId(); ?>.html" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
        <fieldset>
            <legend>Image (optionel)</legend>
            <p>
                <label for="photo">Fichier de l'image :</label>
                <input type="file" name="photo" value="" />
                <br/>
                <input type="submit" value="Enregistrer" name="submFile" />
                <br/>
            </p>
            <?php
            $extension=$pers->getExtension();
            if(!empty($extension)) {
                ?>
            <h2>Image enregistrée :</h2>
            <div class="vignette">
                <a href="<?php echo $pers->getFilename(); ?>?<?php echo time(); ?>">
                    <img src="<?php echo $pers->getFilenameMini(); ?>?<?php echo time(); ?>" width="<?php echo $pers->getImg()->getLargeurSource(); ?>" height="<?php echo $pers->getImg()->getHauteurSource(); ?>"/>
                </a>
                <p></p>
                <div><a href="del-pers-photo-2-<?php echo $pers->getId(); ?>-<?php echo $pers->getGroupe()->getId(); ?>.html" title="Effacer l'image">Effacer cette image</a></div>
                <p></p>
            </div>
            <?php
            }
            ?>
        </fieldset>
    </form>
</div>
<p></p>
<div id="form2">
    <?php
    $error=$pers->getErrorMsg();
    if(!empty($error)&&$pers->getTest()==0) { ?>
    <div class="erreur">
        <p>Erreur(s) lors de la validation du formulaire:</p>
        <p><?php echo $error; ?></p>
    </div>
    <p></p>
    <?php
    }
    if($pers->getTest()==1) { ?>
    <p></p>
    <div class="info">
        <p>Personne modifiée !</p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <form action="modif-personne-<?php echo $pers->getId(); ?>-<?php echo $pers->getGroupe()->getId(); ?>.html#form2" method="POST">
        <fieldset>
            <legend>Infos sur la personne</legend>
            <p>
                <label for="libelle">Libellé de la personne :</label>
                <br/>
                <input type="text" name="libelle" id="libelle" value="<?php echo $pers->getLibelle(); ?>" size="40" maxlength="200" />
                <br/>
                <label for="description">Description de la personne :</label>
                <br/>
                <textarea name="description" id="description" rows="4" cols="20"><?php echo $pers->getDescription(); ?></textarea>
                <br/>
                <input type="submit" value="Modifier" name="subm" />
                <br/>
            </p>
        </fieldset>
    </form>
</div>
        <script type="text/javascript">
                CKEDITOR.replace( 'description');
        </script>

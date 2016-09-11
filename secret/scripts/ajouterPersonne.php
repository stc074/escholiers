<h2>Ajouter une personne</h2>
<p>Pour ajouter une personne, sélectionnez le groupe et remplissez le formulaire.</p>
<p>Pour une personne avec photo, il faut préalablement enregistrer l'image.</p>
<?php
$groupes=new Groupes();
$upload=new UploadImage();
$upload->testDelPhotoPers();
$upload->testFormPers();
$upload->initImagePers();
$pers=new Personne();
$pers->testFormEnreg();
?>
<div id="form">
    <?php
    $error=$upload->getErrorMsg();
    if(!empty($error)&&$upload->getTest()==0) { ?>
    <div class="erreur">
        <p>Erreur(s) lors de l'upload de l'image :</p>
        <p><?php echo $error; ?></p>
    </div>
    <p></p>
    <?php
    }
    if($upload->getTest()==1) { ?>
    <p></p>
    <div class="info">
        <p>Image enregistrée !</p>
    </div>
    <p></p>
    <?php
    }
    $error=$pers->getErrorMsg();
    if(!empty($error)&&$pers->getTest()==0) {
        ?>
    <div class="erreur">
        <p>Erreur(s) lors de la validation du formulaire :</p>
        <p><?php echo $error; ?></p>
    </div>
    <p></p>
    <?php
    }
    if($pers->getTest()==1) {
        $upload->deleteOldPers();
        ?>
    <p></p>
    <div class="info">
        <p>Personne enregistrée !</p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <form action="ajouter-personne.html#form" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
        <fieldset>
            <legend>Photo (optionnelle)</legend>
            <p>
                <label for="photo">Fichier de la photo :</label>
                <input type="file" name="photo" value="" />
                <br/>
                <input type="submit" value="Enregistrer" name="submFile" />
                <br/>
                <?php
                if(isset($_SESSION["idPers"])&&$upload->getTest()==2) { ?>
            <h2>Image actuelle :</h2>
            <div class="vignette">
                <a href="<?php echo $upload->getFilename(); ?>" title="image">
                    <img src="<?php echo $upload->getFilenameMini(); ?>" width="<?php $upload->getImg()->getLargeurSource(); ?>" height="<?php echo $upload->getImg()->getHauteurSource(); ?>" />
                </a>
                <p></p>
                <div><a href="del-pers-photo-<?php echo $upload->getId(); ?>.html" title="Effacer">Effacer cette photo</a></div>
                <p></p>
            </div>
            <p></p>
            <?php
                }
                ?>
            </p>
        </fieldset>
    </form>
    <p></p>
    <form action="ajouter-personne.html#form" method="POST">
        <fieldset>
            <legend>Ajouter une personne</legend>
            <p>
                <label for="idGroupe">Choisissez un groupe :</label>
                <?php
                $groupes->initSelect($pers->getGroupe()->getId());
                ?>
                <br/>
                <br/>
                <label for="libelle">Libellé :</label>
                <br/>
                <input type="text" name="libelle" id="libelle" value="<?php echo $pers->getLibelle(); ?>" size="40" maxlength="200" />
                <br/>
                 <label for="description">Description :</label>
                <br/>
                <textarea name="description" id="description" rows="4" cols="20"><?php echo $pers->getDescription(); ?></textarea>
                <br/>
                <input type="submit" value="Valider" name="subm" />
                <br/>
            </p>
        </fieldset>
        <script type="text/javascript">
                CKEDITOR.replace( 'description');
        </script>
    </form>
</div>
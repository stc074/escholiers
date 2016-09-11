<h2>Présentation</h2>
<p>Utilisez le formulaire ci-dessous pour la présentation.</p>
<?php
$comp=new Compagnie();
$comp->initPresentation();
$comp->testFormPresentation();
?>
<div id="form">
    <?php
    $error=$comp->getErrorMsg();
    if($comp->getTest()==0&&!empty($error)) { ?>
    <div class="erreur">
        <p>Erreur(s) lors de la validation du formulaire :</p>
        <p><?php echo $error; ?></p>
    </div>
    <p></p>
    <?php
    }
    if($comp->getTest()==1) { ?>
    <p></p>
    <div class="info">
        <p>Présentation modifiée !</p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <form action="presentation-compagnie.html#form" method="POST">
        <fieldset>
            <legend>Présentation</legend>
            <p>
                <label for="titre">Titre de la présentation :</label>
                <br/>
                <input type="text" name="titre" id="titre" value="<?php echo $comp->getTitrePresentation(); ?>" size="40" maxlength="200" />
                <br/>
                <label for="contenu">Contenu de la présentation :</label>
                <br/>
                <textarea name="contenu" rows="4" cols="20"><?php echo $comp->getContenuPresentation(); ?></textarea>
                <br/>
                <input type="submit" value="Valider" name="subm" />
                <br/>
            </p>
        </fieldset>
    </form>
        <script type="text/javascript">
                CKEDITOR.replace( 'contenu',
            {
        filebrowserBrowseUrl : '../datas/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl : '../datas/ckfinder/ckfinder.html?Type=Images',
        filebrowserFlashBrowseUrl : '../datas/ckfinder/ckfinder.html?Type=Flash',
        filebrowserUploadUrl : '../datas/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl : '../datas/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl : '../datas/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
        </script>
</div>
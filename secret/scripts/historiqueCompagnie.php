<h2>Historique</h2>
<p>Utilisez le formulaire ci-dessous pour changer l'historique.</p>
<?php
$comp=new Compagnie();
$comp->initHistorique();
$comp->testFormHistorique();
?>
<div id="form">
    <?php
    $error=$comp->getErrorMsg();
    if(!empty($error)&&$comp->getTest()==0) { ?>
    <div class="erreur">
        <p>Erreur lors de la validation du formulaire :</p>
        <p><?php echo $error; ?></p>
    </div>
    <p></p>
    <?php
    }
    if($comp->getTest()==1) { ?>
    <p></p>
    <div class="info">
        <p>Historique modifiée !</p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <form action="historique-compagnie.html#form" method="POST">
        <fieldset>
            <legend>Historique</legend>
            <p>
                <label for="contenu">Contenu de l'historique :</label>
                <br/>
                <textarea name="contenu" id="contenu" rows="4" cols="20"><?php echo $comp->getContenuHistorique(); ?></textarea>
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
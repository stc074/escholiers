<h2>Modifier une page de contenu</h2>
<p>Pour modifier cette page, editer le contenu grâce au formulaire ci-dessous.</p>
<?php
$contenu=new Contenu();
$contenu->initInfosEdit();
$contenu->verifFormEdit();
if($contenu->getTest()==2) {
    ?>
<p></p>
<div class="erreur">
    <p>Erreur: le script n'a pas pu charger les informations de cette page.</p>
</div>
<?php
} else {
?>
<div class="info">
    <p>Dernière modification: <?php echo $contenu->getDate(); ?>.</p>
</div>
<p>Adresse :<br/>
<textarea name="code" class="code" rows="1" cols="80"><?php echo $contenu->getUrl(); ?></textarea>
</p>
<div id="form">
    <?php
    if($contenu->getTest()==1) { ?>
    <p></p>
    <div class="info">
        <p>Modifications enregistrées !</p>
    </div>
    <p></p>
    <?php
    }
    $error=$contenu->getErrorMsg();
    if($contenu->getTest()==0&&!empty($error)) {
        ?>
<div class="erreur">
    <p>Erreur(s) lors de la validation du formulaire :</p>
    <p><?php echo $error; ?></p>
</div>
<?php
    }
    ?>
    <form action="modifier-page-<?php echo $contenu->getId(); ?>.html#form" method="POST">
        <fieldset>
            <legend>Infos</legend>
            <p>
                <label for="mainTitre">Titre principal (texte du lien dans le menu) :</label>
                <br/>
                <input type="text" name="mainTitre" id="mainTitre" value="<?php echo $contenu->getMainTitre(); ?>" size="40" maxlength="200" />
                <br/>
                <label for="titre">Titre pour url (évitez les caractères accentués ou spéciaux) :</label>
                <br/>
                <input type="text" name="titre" id="titre" value="<?php echo $contenu->getTitre(); ?>" size="40" maxlength="100" />
            </p>
        </fieldset>
        <p></p>
        <fieldset>
            <legend>Contenu de la page</legend>
            <p>
                <label for="contenu">Contenu de la page :</label>
                <br/>
                <textarea name="contenu" rows="4" cols="20"><?php echo $contenu->getContenu(); ?></textarea>
                <br/>
            </p>
        </fieldset>
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
        <p></p>
        <fieldset>
            <legend>Référencement</legend>
            <p>
                <label for="title">Balise title (Titre dans les moteurs de recherche) :</label>
                <br/>
                <input type="text" name="title" id="title" value="<?php echo $contenu->getTitle(); ?>" size="50" maxlength="200" />
                <br/>
                <label for="description">Description dans les moteurs de recherche :</label>
                <br/>
                <textarea name="description" rows="4" cols="80"><?php echo $contenu->getDescription(); ?></textarea>
                <br/>
            </p>
        </fieldset>
        <p>
            <br/>
            <input type="submit" value="Modifier" name="subm" />
            <br/>
        </p>
        </form>
</div>
    <?php
}
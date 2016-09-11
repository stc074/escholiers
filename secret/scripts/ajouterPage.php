<h2>Ajouter une page de contenu</h2>
<p>Pour ajouter une page de contenu, utilisez le formulaire ci-dessous :</p>
<?php
$contenu=new Contenu();
$contenu->verifForm();
$error=$contenu->getErrorMsg();
if($contenu->getTest()==0) {
if($contenu->getTest()==0&&!empty($error)) {
?>
<div id="form">
<div class="erreur">
    <p>Erreur(s) lors de la validation du formulaire :</p>
    <p><?php echo $error; ?></p>
</div>
<p></p>
<?php
}
?>
    <form action="ajouter-page-contenu.html#form" method="POST">
        <fieldset>
            <legend>Infos</legend>
            <p>
                <label for="mainTitre">Titre principal (apparait dans le menu) :</label>
                <br/>
                <input type="text" name="mainTitre" id="mainTitre" value="<?php echo $contenu->getMainTitre(); ?>" size="40" maxlength="200" />
                <br/>
                <label for="titre">Titre pour url(Attention sert a construire l'adresse de la page, les caractères spéciaux ou accentués sont à éviter) :</label>
                <br/>
                <input type="text" name="titre" id="titre" value="<?php echo $contenu->getTitre(); ?>" size="50" maxlength="100" />
                <br/>
            </p>
        </fieldset>
        <p></p>
        <fieldset>
            <legend>Contenu de la page</legend>
            <p>
                <label for="contenu">Contenu de la page :</label>
                <br/>
                <textarea name="contenu" id="contenu" rows="4" cols="20"><?php echo $contenu->getContenu(); ?></textarea>
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
                <label for="title">Balise title (texte du lien dans les moteurs de recherche) :</label>
                <br/>
                <input type="text" name="title" id="title" value="<?php echo $contenu->getTitle(); ?>" size="50" maxlength="200" />
                <br/>
                <label for="description">Description dans les moteurs de recherche :</label>
                <br/>
                <textarea name="description" id="description" rows="4" cols="80"><?php echo $contenu->getDescription(); ?></textarea>
            </p>
        </fieldset>
        <p>
            <br/>
            <input type="submit" value="Valider" name="subm" />
            <br/>
        </p>
    </form>
</div>
<?php
} elseif($contenu->getTest()==1) { ?>
<div class="info">
    <p>Page de contenu enregistrée !</p>
    <p>Ci dessous l'adresse relative de la page (pour configurer le menu).</p>
</div>
<p></p>
        <textarea name="code" class="code" rows="4" cols="80"><?php echo $contenu->getUrl(); ?></textarea>
<?php } ?>

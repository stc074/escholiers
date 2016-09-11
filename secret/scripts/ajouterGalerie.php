<h2>Ajouter une galerie</h2>
<p>Pour ajouter une galerie, utilisez le formulaire ci-dessous.</p>
<?php
$galerie=new Galerie();
$galerie->testFormNouv();
?>
<div id="form">
    <?php
    $error=$galerie->getErrorMsg();
    if($galerie->getTest()==0&&!empty($error)) {
        ?>
    <div class="erreur">
        <p>Erreur lors de la validation du formulaire :</p>
        <p><?php echo $error; ?></p>
    </div>
    <p></p>
    <?php
    }
    if($galerie->getTest()==1) { ?>
    <p></p>
    <div class="info">
        <p><?php echo $galerie->getMessage(); ?></p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <form action="ajouter-galerie.html#form" method="POST">
        <fieldset>
            <legend>Nouvelle galerie</legend>
            <p>
                <label for="titre">Libellé de la nouvelle galerie :</label>
                <br/>
                <input type="text" name="titre" id="titre" value="<?php echo $galerie->getTitre(); ?>" size="40" maxlength="200" />
                <br/>
                <input type="submit" value="Valider" name="subm" />
                <br/>
            </p>
        </fieldset>
    </form>
</div>
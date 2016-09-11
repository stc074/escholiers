<h2>Ajouter un spectacle</h2>
<p>Pour ajouter un spectacle, utilisez le formulaire ci-dessous.</p>
<?php
$spectacle=new Spectacle();
$spectacle->verifFormNew();
?>
<div id="form">
    <?php
    $error=$spectacle->getErrorMsg();
    if(!empty($error)&&$spectacle->getTest()==0) {
        ?>
    <div class="erreur">
        <p>Erreur lors de l'enregistrement :</p>
        <p><?php echo $error; ?></p>
    </div>
    <p></p>
    <?php
    }
    if($spectacle->getTest()==1) {
        ?>
    <p></p>
    <div class="info">
        <p><?php echo $spectacle->getMessage(); ?></p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <form action="ajout-spectacle.html#form" method="POST">
        <fieldset>
            <legend>Nouveau spectacle</legend>
            <p>
                <label for="libelle">Libellé du nouveau spectacle :</label>
                <br/>
                <input type="text" name="libelle" id="libelle" value="<?php echo $spectacle->getLibelle(); ?>" size="50" maxlength="200" />
                <br/>
                <input type="submit" value="Valider" name="subm" />
                <br/>
            </p>
        </fieldset>
    </form>
</div>
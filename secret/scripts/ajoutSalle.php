<h2>Ajouter une salle à un spectacle</h2>
<p>Pour ajouter une salle à un spectacle, utilisez le formulaire ci-dessous.</p>
<?php
$salle=new Salle();
$salle->initNew();
$salle->verifFormNew();
$spectacles=new Spectacles();
?>
<div id="form">
    <?php
    $error=$salle->getErrorMsg();
    if(!empty($error)&&$salle->getTest()==0) {
        ?>
    <div class="erreur">
        <p>Erreur(s) lors de la validation du formulaire :</p>
        <p><?php echo $error; ?></p>
    </div>
    <p></p>
    <?php
    }
    if($salle->getTest()==1) {
        ?>
    <p></p>
    <div class="info">
        <p><?php echo $salle->getMessage(); ?></p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <form action="ajout-salle-<?php echo $salle->getIdSpectacle(); ?>.html#form" method="POST">
    <fieldset>
        <legend>Nouvelle salle</legend>
        <p>
            <label for="idSpectacle">Choisissez le spectacle dont dépend la salle :</label>
            <?php $spectacles->dispListSpecSalle($salle->getIdSpectacle()); ?>
            <br/>
            <label for="libelle">Libellé de la nouvelle salle :</label>
            <br/>
            <input type="text" name="libelle" id="libelle" value="<?php echo $salle->getLibelle(); ?>" size="50" maxlength="100" />
            <br/>
            <input type="submit" value="Valider" name="subm" />
            <br/>
        </p>
    </fieldset>
    </form>
</div>
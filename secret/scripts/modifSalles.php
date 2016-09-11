<h2>Gestion des salles</h2>
<p>Vous pouvez modifier le libellé des salles ci-desous, changer l'ordre d'apparitions, ou effacer.</p>
<?php
$salles=new Salles();
$salles->getGetGest();
$salles->testModifPos();
$salles->testModifDel();
$spectacles=new Spectacles();
?>
<div id="form">
    <form action="modif-salles.html#form" method="POST">
        <fieldset>
            <legend>Spectacle</legend>
        <p>
        <label for="idSpectacle">Choisissez un spectacle : </label>
        <?php $spectacles->dispListChgSalle($salles->getIdSpectacle()); ?>
        <br/>
        </p>
        </fieldset>
    </form>
</div>
<h2>Salles associées</h2>
<?php
$salles->dispFormChg();
<h2>Gestion des salles</h2>
<p>Vous pouvez modifier l'ordre, supprimer une salle.</p>
<?php
$salles=new Salles();
$spectacle=new Spectacle();
$spectacle->testChange();
$spectacles=new Spectacles();
$salles->testChangePos($spectacle->getId());
$salles->testDel();
?>
<div id="form">
    <form action="gestion-salles.html#form" method="POST">
        <fieldset>
            <legend>Spectacle</legend>
            <p>
                <label for="idSpectacle">Choisissez un spectacle</label>
                <?php
                $spectacles->dispListGestion($spectacle->getId());
                ?>
            </p>
        </fieldset>
    </form>
</div>
<p></p>
<?php
$salles->dispListGestion($spectacle->getId());
?>
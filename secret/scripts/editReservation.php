<h2>Enregistrer les dates pour les réservations</h2>
<p>Utilisez le formulaire pour ajouter des dates ou|et des spectacles futurs.</p>
<?php
$spectacles=new Spectacles();
$salles=new Salles();
$reservation=new Reservation();
$reservation->testGet();
$reservation->verifFormEvent();
?>
<div id="form">
    <?php
    $error=$reservation->getErrorMsg();
    if(!empty($error)&&$reservation->getTest()==0) {
        ?>
    <div class="erreur">
        <p>Erreur(s) lors de la validation du formulaire :</p>
        <p><?php echo $error; ?></p>
    </div>
    <p></p>
    <?php
    }
    if($reservation->getTest()==1) {
        ?>
    <p></p>
    <div class="info">
        <p><?php echo $reservation->getMessage(); ?></p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <form action="edit-reservation-<?php echo $reservation->getIdSpectacle(); ?>.html#form" method="POST">
        <fieldset>
            <legend>Spectacle</legend>
            <p>
                <label for="idSpectacle">Choisissez un spectacle :</label>
                <?php
                $spectacles->initListSelect($reservation->getIdSpectacle());
                ?>
                <br/>
                <br/>
                <label for="idSalle">Choisissez une salle :</label>
                <?php
                $salles->dispListSelect($reservation->getIdSpectacle(),$reservation->getIdSalle());
                ?>
                <br/>
                <br/>
                <label for="dateTime">Date et horaire à enregistrer :</label>
                <input type="text" name="dateTime" id="dateTime" value="<?php echo $reservation->getDateTimeTxt(); ?>" size="16" maxlength="16" />
                <br/>
            </p>
        </fieldset>
        <p>
            <br/>
            <input type="submit" value="Valider" name="subm" />
            <br/>
        </p>
    </form>
</div>
<h2>Changer l'email des reservation</h2>
<p>Pour modifier l'adresse email qui sera prévenue des réservations, utilisez le formulaire ci-dessous.</p>
<?php
$reservation=new Reservation();
$reservation->loadEmail();
$reservation->testChangeEmail();
?>
<div id="form">
    <?php
    $error=$reservation->getErrorMsg();
    if(!empty($error)&&$reservation->getTest()==0) {
        ?>
    <div class="erreur">
        <p>Erreur(s) lors du changement d'email :</p>
        <p><?php echo $error; ?></p>
    </div>
    <p></p>
    <?php
    }
    if($reservation->getTest()==1) {
        ?>
    <p></p>
    <div class="info">
        <p>Email modifié !</p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <form action="email-reservation.html#form" method="POST">
        <fieldset>
            <legend>Email de reservation</legend>
            <p>
                <label for="email">Email de réservation :</label>
                <br/>
                <input type="text" name="email" id="email" value="<?php echo $reservation->getEmailReservation(); ?>" size="40" maxlength="200" />
                <br/>
                <input type="submit" value="Valider" name="subm" />
                <br/>
            </p>
        </fieldset>
    </form>
</div>

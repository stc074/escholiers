<h1>Reservation</h1>
<?php
$reservation=new Reservation();
$reservation->dispReservation();
$reservation->verifSendMsg();
if($reservation->getId()!=0) {
    ?>
<p></p>
<div id="form">
    <?php
    $error=$reservation->getErrorMsg();
    if(!empty($error)&& $reservation->getTest()==0) {
        ?>
    <div class="erreur">
        <p>Erreur(s) lors de l'envoi du message :</p>
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
    <form action="reservation-<?php echo $reservation->getId(); ?>.html" method="POST">
        <fieldset>
            <legend>Envoyer un message à <?php echo $reservation->getPrenom(); ?> <?php echo $reservation->getNom(); ?></legend>
            <p>
            <label for="objet">Objet du message :</label>
            <br/>
            <input type="text" name="objet" id="objet" value="<?php echo $reservation->getObjet(); ?>" size="40" maxlength="100" />
            <br/>
            <label for="message">Message :</label>
            <br/>
            <textarea name="message" id="message" rows="4" cols="20"><?php echo $reservation->getMsg(); ?></textarea>
            <br/>
            <br/>
            <input type="submit" value="Valider" name="subm" />
            <br/>
            </p>
        </fieldset>
        </form>
</div>
        <script type="text/javascript">
                CKEDITOR.replace( 'message');
        </script>
<?php
}
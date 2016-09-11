<h2>Adresse postale</h2>
<p>Utilisez le formulaire ci-dessous pour changer l'adresse postale.</p>
<?php
$ctc=new Contact();
$ctc->initAddress();
$ctc->verifFormAddress();
?>
<div id="form">
    <?php
    $error=$ctc->getErrorMsg();
    if($ctc->getTest()==0&&!empty($error)) {
        ?>
    <div class="erreur">
        <p>Erreur lors de la validation du formulaire :</p>
        <p><?php echo $error; ?></p>
    </div>
    <p></p>
    <?php
    }
    if($ctc->getTest()==1) { ?>
    <p></p>
    <div class="info">
        <p>Adresse mise à jour !</p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <form action="change-address.html#form" method="POST">
        <fieldset>
            <legend>Adresse</legend>
            <p>
                <label for="address">Adresse postale :</label>
                <br/>
                <textarea name="address" id="address" rows="6" cols="50"><?php echo $ctc->getAddress(); ?></textarea>
                <br/>
                <input type="submit" value="Valider" name="subm" />
                <br/>
            </p>
        </fieldset>
    </form>
</div>
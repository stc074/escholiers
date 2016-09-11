<h2>Modifier l'Email</h2>
<p>Pour modifier l'email du formulaire de contact, utilisez le formulaire ci-dessous.</p>
<?php
$ctc=new Contact();
$ctc->initEmail();
$ctc->verifFormEmail();
?>
<div id="form">
    <?php
    $error=$ctc->getErrorMsg();
    if($ctc->getTest()==0&&!empty($error)) { ?>
    <div class="erreur">
        <p>Erreur(s) lors de la validation du formulaire :</p>
        <p><?php echo $error; ?></p>
    </div>
    <p></p>
    <?php
    }
    if($ctc->getTest()==1) { ?>
    <p></p>
    <div class="info">
        <p>Adresse E-Mail modifiée !</p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <form action="change-email.html#form" method="POST">
        <fieldset>
            <legend>EMail</legend>
            <p>
                <label for="email">Email de contact (modifiez) :</label>
                <br/>
                <input type="text" name="email" id="email" value="<?php echo $ctc->getEmail(); ?>" size="40" maxlength="200" />
                <br/>
                <input type="submit" value="Valider" name="subm" />
                <br/>
            </p>
        </fieldset>
    </form>
</div>
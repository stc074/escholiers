<h1>Contact</h1>
<p>Pour nous contacter, utilisez le formulaire ci-dessous :</p>
<?php
$ctc=new Contact();
$ctc->verifFormCtc();
?>
<div id="form">
    <?php
    $error=$ctc->getErrorMsg();
    if($ctc->getTest()==0&&!empty($error)) {
        ?>
    <div class="error">
        <p>Erreur(s) lors de la validation du formulaire :</p>
        <p><?php echo $error; ?></p>
    </div>
    <p></p>
    <?php
    }
    if($ctc->getTest()==1) {
        ?>
    <p></p>
    <div class="info">
        <p>Message envoyé !<br/>Nous vous répondrons dés que possible.</p>
    </div>
    <p></p>
    <?php
    }
    if($ctc->getTest()==0) {
    ?>
    <form action="contact.html#form" method="POST">
        <p>
            <label for="prenom">Votre prénom :</label>
            <br/>
            <input type="text" name="prenom" id="prenom" value="<?php echo $ctc->getPrenom(); ?>" size="40" maxlength="100" />
            <br/>
            <label for="nom">Votre nom :</label>
            <br/>
            <input type="text" name="nom" id="nom" value="<?php echo $ctc->getNom(); ?>" size="40" maxlength="100" />
            <br/>
            <label for="email">Votre adresse Email :</label>
            <br/>
            <input type="text" name="email" id="email" value="<?php echo $ctc->getEmail(); ?>" size="40" maxlength="100" />
            <br/>
            <label for="subject">Objet de votre message :</label>
            <br/>
            <input type="text" name="subject" id="subject" value="<?php echo $ctc->getSubject(); ?>" size="60" maxlength="100" />
            <br/>
            <label for="content">Votre message :</label>
            <br/>
            <textarea name="content" rows="10" cols="80"><?php echo $ctc->getContent(); ?></textarea>
            <br/>
        </p>
        <div class="inlineBlock">
            <img id="captcha" src="securimage/securimage/securimage_show.php" alt="CAPTCHA Image" />
        </div>
        <div class="inlineBlock">
            <label for="captchaCode">&rarr; Copiez le code SVP &rarr;</label>
            <input type="text" name="captcha" size="10" maxlength="6" />
        </div>
        <p>
            <a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage/securimage_show.php?' + Math.random(); return false">[ Changer de code ]</a>
        </p>
        <p>
            <br/>
            <input type="submit" value="Envoyer" name="subm" />
            <br/>
        </p>
    </form>
    <?php
    }
    ?>
</div>
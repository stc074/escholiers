<h2>Livre d'or</h2>
<p>Laissez un message sur notre livre d'or grâce au formulaire ci-dessous</p>
<?php
$message=new Message();
$message->verifFormInsertLDO();
$ldo=new LivreDor();
$ldo->getGets();
$ldo->initPages();
?>
<div id="signLDO" onclick="javascript:signLDO();"><h2>Signer le livre d'or</h2></div>
<p></p>
<?php
if($message->getTest()==2) {
    ?>
<div class="info">
    <p>Message enregistré !</p>
</div>
<p></p>
<?php
}
?>
<div id="formLDO"<?php if($message->getTest()==1) { echo ' style="display: block;"'; } ?>>
    <form action="livre-d-or.html#formLDO" method="POST">
        <fieldset>
            <legend>Signez le livre d'or</legend>
            <div class="inlineBlock">
            <label for="nom">Votre nom/pseudonyme :</label>
            </div>
            <div class="inlineBlock">
                <?php
                $error=$message->getValidator('author')->getErrorMsg();
                if(!empty($error)) {
                    ?>
                <span class="red"><?php echo $error; ?></span>
                <?php
                }
                ?>
            </div>
            <br/>
            <input type="text" name="author" id="nom" value="<?php echo $message->getAuthor(); ?>" size="40" maxlength="200" />
            <br/>
            <label for="content">Votre message : </label>
            <?php
            $error=$message->getValidator('content')->getErrorMsg();
            if(!empty($error)) {
                ?>
            <span class="red"><?php echo $error; ?></span>
            <?php
            }
            ?>
            <br/>
            <textarea name="content" rows="6" cols="50"><?php echo $message->getContent(); ?></textarea>
            <br/>
            <br/>
        <div class="inlineBlock">
            <img id="captcha" src="securimage/securimage/securimage_show.php" alt="CAPTCHA Image" />
        </div>
        <div class="inlineBlock">
            <label for="captchaCode">&rarr; Copiez le code SVP &rarr;</label>
            <input type="text" name="captcha" size="6" maxlength="6" />
        </div>
            <?php
            $error=$message->getValidator('captcha')->getErrorMsg();
            if(!empty($error)) {
                ?>
            <span class="red"><?php echo $error; ?></span>
            <?php
            }
            ?>
        <p>
            <a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage/securimage_show.php?' + Math.random(); return false">[ Changer de code ]</a>
        </p>
            <br/>
            <input type="submit" value="Signer le livre d'or" name="subm" />
            <br/>
        </fieldset>
    </form>
</div>
<?php
if($message->getTest()==1) {
    ?>
<script type="text/javascript">
window.onload=function() {
    
}
</script>
<?php
}
$ldo->dispMessages();
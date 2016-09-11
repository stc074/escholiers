<h2>Envoyer une newsletter</h2>
<p>La newsletter sera envoyé à tous les inscrits dans la base de données.</p>
<p>Il est possible de tester l'envoi en remplissant le champ "email de test".</p>
<p>Pour faire une newsletter "personnalisée", dans l'objet et le message:<br/>
#1 sera remplacé par le prénom de celui qui reçoit.<br/>
#2 sera remplacé par le nom de celui qui reçoit.</p>
<?php
$newsletter=new Newsletter();
$newsletter->testRest();
$newsletter->testFormSend();
$newsletter->testRec();
?>
<div id="form">
    <?php
    $error=$newsletter->getErrorMsg();
    if(!empty($error)&&$newsletter->getTest()==0) {
        ?>
    <div class="erreur">
        <p>Erreur(s) lors de l'envoi :</p>
        <p><?php echo $error; ?></p>
    </div>
    <p></p>
    <?php
    }
    if($newsletter->getTest()!=0) {
        ?>
    <p></p>
    <div class="info">
        <p><?php echo $newsletter->getMessage(); ?></p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <form action="send-newsletter.html#form" method="POST">
        <fieldset>
            <legend>Restaurer la newsletter :</legend>
            <p>
                <label for="restaurer">Pour restaurer la dernière newsletter sauvegardée cliquez sur "Restaurer"</label>
                <br/>
                <input type="submit" value="Restaurer" id="restaurer" name="submRest" />
                <br/>
            </p>
        </fieldset>
        <p></p>
        <fieldset>
            <legend>Tester la newsletter</legend>
            <p>
                <label for="emailTest">Email de test (laisser vide pour l'envoi final) :</label>
                <br/>
                <input type="text" name="emailTest" id="emailTest" value="<?php echo $newsletter->getEmailTest(); ?>" size="40" maxlength="200" />
            </p>
        </fieldset>
        <p></p>
        <fieldset>
            <legend>La newsletter</legend>
            <p>
                <label for="object">Objet de la newsletter :</label>
                <br/>
                <input type="text" name="object" id="object" value="<?php echo $newsletter->getObject(); ?>" size="40" maxlength="150" />
                <br/>
                <label for="content">Contenu de la newsletter :</label>
                <br/>
                <textarea name="content" id="content" rows="4" cols="20"><?php echo $newsletter->getContent(); ?></textarea>
                <br/>
            </p>
        </fieldset>
        <p>
            <br/>
            <input type="submit" value="Envoyer" name="subm" />
            <span>&nbsp;</span>
            <input type="submit" value="Enregistrer dans la base de données" name="submRec" />
            <br/>
        </p>
    </form>
        <script type="text/javascript">
                CKEDITOR.replace( 'content');
        </script>
</div>
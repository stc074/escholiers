<h2>Texte tarifs reservation</h2>
<p>Choisissez un spectacle, et éditer le texte de présentation associé.</p>
<?php
$txt=new TxtSpectacle();
$txt->getGets();
$txt->initInfos();
$txt->verifFormUpdate();
$spectacles=new Spectacles();
?>
<div id="form">
    <?php
    if($txt->getTest()==1) {
        ?>
    <p></p>
    <div class="info">
        <p>Modifications enregistrées !</p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <form action="texte-reservation-<?php echo $txt->getIdSpectacle(); ?>.html#form" method="POST">
        <fieldset>
            <legend>Spectacle associé</legend>
            <?php
            $error=$txt->getValidator("id")->getErrorMsg();
            if(!empty($error)) {
                ?>
            <p></p>
            <div class="erreur">
                <p><?php echo $error; ?></p>
            </div>
            <p></p>
            <?php
            }
            ?>
            <label for="idSpectacle">Choisissez un spectacle : </label>
            <?php
            $spectacles->dispListTxtRes($txt->getIdSpectacle());
            ?>
        </fieldset>
        <p></p>
        <fieldset>
            <p><?php echo $txt->getDate(); ?></p>
            <?php
            $error=$txt->getValidator('content')->getErrorMsg();
            if(!empty($error)) {
                ?>
            <p></p>
            <div class="erreur">
                <p><?php echo $error; ?></p>
            </div>
            <p></p>
            <?php
            }
            ?>
            <legend>Contenu du texte</legend>
            <label for="content">Contenu du texte :</label>
            <br/>
            <textarea name="content" id="content" rows="4" cols="20"><?php echo $txt->getContent(); ?></textarea>
            <p></p>
            <p>
                <br/>
                <input type="submit" value="Enregistrer" name="subm" />
                <br/>
            </p>
        </fieldset>
    </form>
        <script type="text/javascript">
                CKEDITOR.replace( 'content');
        </script>
</div>
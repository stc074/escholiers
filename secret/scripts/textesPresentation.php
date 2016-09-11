<h2>Textes de présentation des spectacles</h2>
<p>Choisissez votre spectacle, et éditez son texte de présentation.</p>
<?php
$spectacle=new Spectacle();
$spectacle->getGets();
$spectacle->initInfosPres();
$spectacle->verifFormTxtPres();
?>
<div id="form">
    <?php
    if($spectacle->getTest()==1) {
        ?>
    <p></p>
    <div class="info">
        <p>Modifications enregistrées !</p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <form action="textes-presentation-<?php echo $spectacle->getId(); ?>.html#form" method="POST">
        <fieldset>
            <legend>Spectacle</legend>
            <label for="idSpectacle">Choisissez un spectacle :</label>
            <select name="idSpectacle" id="idSpectacle" onchange="javascript:window.location.href='textes-presentation-'+this.value+'.html#form';">
                <?php
                $spectacle->dispSelect("table_spectacles", $spectacle->getId());
                ?>
            </select>
            <?php
            $error=$spectacle->getValidator('idSpectacle')->getErrorMsg();
            if(!empty($error)) {
                ?>
            <span class="red"><?php echo $error; ?></span>
            <?php
            }
            ?>
        </fieldset>
        <p></p>
        <?php
        if($spectacle->getId()==0) {
            ?>
        <div class="info">
            <p>Aucun spectacle choisi !</p>
        </div>
        <p></p>
        <?php
        } else {
            ?>
        <fieldset>
            <legend>Texte de présentation</legend>
            <?php
            $error=$spectacle->getValidator('content')->getErrorMsg();
            if(!empty($error)) {
                ?>
            <div class="red"><?php echo $error; ?></div>
            <?php
            }
            ?>
            <label for="content">Texte de présentation :</label>
            <br/>
            <textarea name="content" rows="4" cols="20"><?php echo $spectacle->getContent(); ?></textarea>
        </fieldset>
        <p></p>
        <fieldset>
            <legend>Référencement</legend>
            <label for="title">Titre dans google :</label>
            <?php
            $error=$spectacle->getValidator('title')->getErrorMsg();
            if(!empty($error)) {
                ?>
            <span class="red"><?php echo $error; ?></span>
            <?php
            }
            ?>
            <br/>
            <input type="text" name="title" id="title" value="<?php echo $spectacle->getTitle(); ?>" size="40" maxlength="200" />
            <br/>
            <label for="description">Description dans google :</label>
            <?php
            $error=$spectacle->getValidator('description')->getErrorMsg();
            if(!empty($error)) {
                ?>
            <span class="red"><?php echo $error; ?></span>
            <?php
            }
            ?>
            <br/>
            <textarea name="description" rows="5" cols="60"><?php echo $spectacle->getDescription(); ?></textarea>
        </fieldset>
        <p>
            <br/>
            <input type="submit" value="Enregistrer" name="subm" />
            <br/>
        </p>
        <script type="text/javascript">
                CKEDITOR.replace( 'content');
        </script>
        <?php
        }
        ?>
    </form>
</div>
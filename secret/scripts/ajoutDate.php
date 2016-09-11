<h2>Ajouter une date</h2>
<p>Pour ajouter une date, utilisez le formulaire ci-dessous.</p>
<?php
$event=new Event();
$event->getGets();
$event->verifFormInput();
$spectacles=new Spectacles();
$salles=new Salles();
?>
<div id="form">
    <?php
    if($event->getTest()==1) {
        ?>
    <p></p>
    <div class="info">
        <p><?php echo $event->getMessage(); ?></p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <form action="ajout-date-<?php echo $event->getIdSpectacle(); ?>.html#form" method="POST">
        <fieldset>
            <legend>Spectacle</legend>
            <p>
                <label for="idSpectacle">Choisissez un spectacle :</label>
                <?php
                $spectacles->dispListAjoutDate($event->getIdSpectacle());
                $error=$event->getValidator('idSpectacle')->getErrorMsg();
                if(!empty($error)) {
                    ?>
                <span class="red">&nbsp;<?php echo $error; ?></span>
                <?php
                }
                ?>
            </p>
        </fieldset>
        <p></p>
        <fieldset>
            <legend>Salle</legend>
            <label for="idSalle">Choisissez une salle :</label>
            <?php
            $salles->dispListAjoutDate($event->getIdSpectacle(), $event->getIdSalle());
            $error=$event->getValidator('idSalle')->getErrorMsg();
            if(!empty($error)) {
                ?>
            <span class="red">&nbsp;<?php echo $error; ?></span>
            <?php
            }
            ?>
        </fieldset>
        <p></p>
        <fieldset>
            <legend>Nouvelle date</legend>
            <label for="date">Nouvelle date :</label>
            <input type="text" name="date" id="date" value="<?php echo $event->getDate(); ?>" size="16" maxlength="16" />
            <?php
            $error=$event->getValidator('date')->getErrorMsg();
            if(!empty($error)) {
                ?>
            <span class="red">&nbsp;<?php echo $error; ?></span>
            <?php
            }
            ?>
        </fieldset>
        <p></p>
        <p>
            <br/>
            <input type="submit" value="Enregistrer" name="subm" />
            <br/>
        </p>
    </form>
</div>
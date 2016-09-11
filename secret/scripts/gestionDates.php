<h2>Gestion des dates</h2>
<p>Choisissez le spectacle, la salle, ensuite vous pouvez effacer des dates.</p>
<?php
$event=new Event();
$event->getGets();
?>
<div id="form">
    <form action="gestion-dates.html#form" method="POST">
        <fieldset>
            <legend>Spectacle</legend>
            <label for="idSpectacle">Choisissez votre spectacle</label>
            <select name="idSpectacle" id="idSpectacle" onchange="javascript:window.location.href='gestion-dates1-'+this.value+'.html#form'">
                <?php
                $event->dispSelect("table_spectacles",$event->getIdSpectacle());
                ?>
            </select>
        </fieldset>
    </form>
</div>

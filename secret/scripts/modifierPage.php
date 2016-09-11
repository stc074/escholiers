<h2>Modifier ou effacer une page</h2>
<p>Selectionnez la page à modifier ou à effacer.</p>
<?php
$contenus=new Contenus();
$contenus->testDelPage();
$contenus->testModifPage();
?>
<div id="form">
    <form name="formu" action="modifier-page-contenu.html#form" method="POST">
        <fieldset>
            <legend>Pages de contenu</legend>
            <p>
                <?php $contenus->dispListForm(); ?>
                <br/>
                <input type="submit" value="Modifier" name="submModif" />
                &nbsp;&nbsp;
                <input type="submit" value="Effacer" name="submDel" onclick="javascript:return testSubmDelPage();" />
                <br/>
            </p>
        </fieldset>
    </form>
</div>
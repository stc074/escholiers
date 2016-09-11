<h2>Spectacle actuel</h2>
<p>Cochez les cases correspondantes aux spectacles pour lesquels on peut réserver.</p>
<?php
$spectacles=new Spectacles();
$spectacle=new Spectacle();
$spectacle->testChangeAct();
$spectacle->testDel();
?>
<div id="form">
    <form action="spectacle-actuel.html#form" method="POST">
        <fieldset>
            <legend>Spectacles</legend>
                <?php
                $spectacles->initListChck();
                ?>
        </fieldset>
    </form>
</div>
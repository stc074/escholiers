<?php
$galAdm=new GalerieAdmin();
$galAdm->testChangeGalerie();
$galAdm->verifComment();
$galAdm->testDel();
$galAdm->testChangePos();
$galerie=new Galerie();
?>
<h2>Gestion de la galerie</h2>
<p>1-Choisissez une galerie.</p>
<p>Vous pouvez effacer des images et changer leur position dans la galerie (les premiers à gauche).</p>
<p>Utilisez les flêches pour changer les images de place dans la galerie, ou la croix pour effacer.</p>
<div id="form">
    <form action="modifier-photos.html#form" method="POST">
        <fieldset>
            <legend>Choix de la galerie</legend>
            <p>
                <label for="idGalerie">Choisissez votre galerie :</label>
                <?php
                $galAdm->dispSelect();
                ?>
            </p>
        </fieldset>
    </form>
</div>
<p></p>
<?php
$galerie->display($galAdm->getId());
$galAdm->displayList();
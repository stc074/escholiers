<h2>Gestion d'un groupe</h2>
<p>Choisisser le groupe.</p>
<p>Changez l'ordre d'apparition avec les flèches.</p>
<p>Selectionnez la personne pour l'effacer ou la modifier.</p>
<?php
$grps=new Groupes();
$grp=new Groupe();
$grp->testChangeSelect();
$grp->testChangePosPers();
$grp->testModifPers();
$grp->testDelPers();
?>
<div id="form">
    <form action="gestion-groupe.html#form" method="POST">
        <fieldset>
            <legend>Groupe :</legend>
            <p>
                <label for="idGroupe">Choisissez le groupe</label>
                <br/>
                <?php
                $grps->initSelect2($grp->getId());
                ?>
            </p>
        </fieldset>
    </form>
    <p></p>
    <div id="form2">
    <form action="gestion-groupe-<?php echo $grp->getId(); ?>.html#form2" method="POST" name="formu">
        <fieldset>
            <legend>Gestion du groupe</legend>
                <?php
                $grp->dispListForm();
                ?>
        </fieldset>
    </form>
    </div>
</div>
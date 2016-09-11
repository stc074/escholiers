<h1>Ajouter un groupe</h1>
<p>Pour ajouter un groupe de paersonnes, utilisez le formulaire ci-dessous.</p>
<?php
$groupe=new Groupe();
$groupe->verifFormNewGroup();
?>
<div id="form">
    <?php
    $error=$groupe->getErrorMsg();
    if(!empty($error)&&$groupe->getTest()==0) { ?>
    <div class="erreur">
        <p>Erreur lors de la validation du formulaire :</p>
        <p><?php echo $error; ?></p>
    </div>
    <p></p>
    <?php
    }
    if($groupe->getTest()==1) { ?>
    <p></p>
    <div class="info">
        <p><?php echo $groupe->getMessage(); ?></p>
    </div>
    <p></p>
    <?php
    }
    ?>
    <form action="ajouter-groupe-personnes.html#form" method="POST">
        <fieldset>
            <legend>Nouveau groupe de personne.</legend>
            <p>
                <label for="libelle">Libellé du nouveau groupe de personnes :</label>
                <br/>
                <input type="text" name="libelle" value="<?php echo $groupe->getLibelle(); ?>" size="40" maxlength="200" />
                <br/>
                <input type="submit" value="Valider" name="subm" />
                <br/>
            </p>
        </fieldset>
    </form>
</div>
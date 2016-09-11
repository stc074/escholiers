<?php
$reservation=new Reservation();
$txt=new TxtSpectacle();
$txt->getGets();
$txt->initInfos();
echo $txt->getContent();
$reservation->getGets();
$reservation->initInfosSpectacle();
$reservation->verifFormRes();
?>
<div id="form">
    <?php
    $error=$reservation->getErrorMsg();
    if(!empty($error)&&$reservation->getTest()==0) {
        ?>
    <div class="error">
        <p>Erreur(s) lors de la validation du formulaire :</p>
        <p><?php echo $error; ?></p>
    </div>
    <p></p>
    <?php
    }
    if($reservation->getTest()==1) { ?>
    <p></p>
    <div class="info">
        <p><?php echo $reservation->getMessage(); ?></p>
    </div>
    <p></p>
    <?php
    } elseif($reservation->getTest()==0) {
    ?>
    <form action="reservation-<?php echo $reservation->getIdSpectacle(); ?>.html#form" method="POST">
        <fieldset>
            <legend>Réservez une date pour "<?php echo $reservation->getSpectacle()->getLibelle(); ?>"</legend>
            <div class="table tableau">
                <div class="tr">
                    <div class="td cell">
                <label for="idDate">Choisissez une date :</label>
                    </div>
                    <div class="td cell">
                <?php
                $reservation->dispDates();
                ?>
                    </div>
                </div>
                <div class="tr">
                    <div class="td cell">
                <label for="nom">Votre nom :</label>
                    </div>
                    <div class="td cell">
                <input type="text" name="nom" id="nom" value="<?php echo $reservation->getNom(); ?>" size="40" maxlength="100" />
                    </div>
                </div>
                <div class="tr">
                    <div class="td cell">
                <label for="prenom">Votre prénom :</label>
                    </div>
                    <div class="td cell">
                <input type="text" name="prenom" id="prenom" value="<?php echo $reservation->getPrenom(); ?>" size="40" maxlength="100" />
                    </div>
                </div>
                <div class="tr">
                    <div class="td cell">
                <label for="email">Votre adresse Email :</label>
                    </div>
                    <div class="td cell">
                <input type="text" name="email" id="email" value="<?php echo $reservation->getEmail(); ?>" size="40" maxlength="200" />
                    </div>
                </div>
                <div class="tr">
                    <div class="td cell">
                <label for="telephone">Votre N° de téléphone :</label>
                    </div>
                    <div class="td cell">
                <input type="text" name="telephone" id="telephone" value="<?php echo $reservation->getTelephone(); ?>" size="14" maxlength="20" />
                    </div>
                </div>
                <div class="tr">
                    <div class="td cell">
                <label for="nbPlaces">Nombre de places :</label>
                    </div>
                    <div class="td cell">
                <input type="text" name="nbPlaces" id="nbPlaces" value="<?php echo $reservation->getNbPlaces(); ?>" size="4" maxlength="4" />
                    </div>
                </div>
            </div>
            <p>
                <input type="checkbox" name="groupes" id="groupes" value="0"<?php if($reservation->isGroupes()) { echo ' checked="checked"'; } ?> />
                <label for="groupes">Je désire des places groupées</label>
                <br/>
                <input type="checkbox" name="newsletter" id="newsletter" value="0"<?php if($reservation->isNewsletter()) { echo ' checked="checked"'; } ?> />
                <label for="newsletter">Je veux recevoir la newsletter</label>
                <br/>
                <br/>
                <input type="submit" value="Valider" name="subm" />
                <br/>
            </p>
        </fieldset>
    </form>
    <?php } ?>
</div>
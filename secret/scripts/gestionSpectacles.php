<h2>Gestion des spectacles</h2>
<p>Vous pouvez modifier le libellé des spectacles ci-dessous et choisir l'ordre d'apparition dans le menu.</p>
<?php
$spectacles=new Spectacles();
$spectacles->testDelete();
$spectacles->testChgePosLib();
$spectacles->verifFormChgLibelle();
$spectacles->initFormChgLibelle();
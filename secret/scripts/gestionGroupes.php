<h2>Gestion des groupes</h2>
<p>Vous pouvez : modifier le libellé d'un groupe, changer son ordre d'apparition, ou l'effacer.</p>
<p>Si vous effacez un groupe, toutes les personnes qu'il contient seront effacées.</p>
<p></p>
<?php
$groupes=new Groupes();
$groupes->testFormChangeLibelle();
$groupes->testChangePos();
$groupes->testDelGroup();
$groupes->dispListAdmin();
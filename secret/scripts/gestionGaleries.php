<h2>Gestion des galeries</h2>
<p>Vous pouvez modifier/changer la position de/effacer chaque galerie.</p>
<p>Attention : si vous effacez une galerie, toutes les photos qu'elle contient seront effacées.</p>
<?php
$galeries=new Galeries();
$galeries->testChangePos();
$galeries->testDel();
$galeries->testModifTitre();
$galeries->dispListGestion();
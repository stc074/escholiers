<?php
$compagnie=new Compagnie();
$compagnie->initHistorique();
echo $compagnie->getContenuHistorique();
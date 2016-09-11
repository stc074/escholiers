<h1>Galeries de photos</h1>
<?php
$galeries=new Galeries();
$galeries->dispList();
$galerie=new Galerie();
$galerie->testNewGalerie();
if($galerie->getId()!=0) {
    $galerie->displaySite();
}
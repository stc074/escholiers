<?php
$presentation=new Presentation();
$presentation->getGets();
$presentation->initContent();
echo $presentation->getContent();
?>

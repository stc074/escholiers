<?php
$reservation=new Reservation();
$reservation->testDelDate();
$spectacle=new Spectacle();
$spectacle->getAct();
$reservation->setActualSpec($spectacle->getLibelle());
$reservation->setIdSpectacle($spectacle->getId());
?>
<h2>Réservations pour "<?php echo $reservation->getActualSpec(); ?>"</h2>
<?php
$reservation->dispListRes();
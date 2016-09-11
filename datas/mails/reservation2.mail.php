<?php
$mail->addMsg('<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Nouvelle Réservation</title>
        <meta charset="utf-8"/>
    </head>
    <style type="text/css">
        body {
                font-family: Arial, Serif;
                font-size: 1em;
                font-weight: normal;
              }
        h1 {
                color: #ddae70;
            }
        p, div {
                color: #333333;
        }
    </style>
    <body>
        <h1>R&eacute;servation pour "'.$this->spectacle->getLibelle().'"</h1>
        <p>Cher(e) '.$this->getPrenom().', nous avons pris en compte votre r&eacute;servation.<p>
        <br/>
        <p>Nombre de places souhait&eacute; : '.$this->getNbPlaces().'</p>
        <p>Places group&eacute;es :');
if($this->isGroupes()) {
    $mail->addMsg('Oui');
} else {
    $mail->addMsg('Non');
}
$mail->addMsg('.</p>
    <p>Newsletter: ');
if($this->isNewsletter()) {
    $mail->addMsg('Oui');
} else {
    $mail->addMsg('Non');
}
    $mail->addMsg('.</p>
        <br/>
<p>Ce message est envoy&eacute; automatiquement, inutile d\'y r&eacute;pondre.</p>');
$mail->addMsg('    </body>
</html>
')
?>

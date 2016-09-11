<?php
//message
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
        <h1>Nouvelle r&eacute;servation</h1>
        <p>Une nouvelle r&eacute;servation depuis le site Les Escholiers.<p>
        <br/>
        <p>Spectacle : '.$this->getActualSpec().'</p>
        <p>'.$this->getPrenom().' '.$this->getNom().' a reserv&eacute; pour le '.$dateTxt.'.</p>
            <p>Le contacter via <a href="mailto:'.$this->getEmail().'">'.$this->getEmail().'</a>
        <p>Nombre de places d&eacute;sir&eacute; : '.$this->getNbPlaces().'</p>
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
        <p>Voir le d&eacute;tail &agrave; <a href="'.Datas::$URL_ROOT.'secret/reservation-'.$this->id.'.html" title="Voir le détail">'.Datas::$URL_ROOT.'secret/reservation-'.$this->id.'.html</a></p>');
    $mail->addMsg('    </body>
</html>
')
    ?>

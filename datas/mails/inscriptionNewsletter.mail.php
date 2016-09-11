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
        <h1>Nouvelle inscripion à la newsletter</h1>
        <p>'.$this->getPrenom().' '.$this->getNom().' desire s\'inscrire à la newsletter.</p>
        <p>Son adresse email correspond a l\'adresse expediteur de ce mail.</p>');
$mail->addMsg('    </body>
</html>
')
    ?>

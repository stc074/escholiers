<?php
$this->mail->addMsg('<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Nouvelle Réservation</title>
        <meta charset="utf-8"/>
    <style type="text/css">
div.info {
    width: 70%;
    border: solid 1px #c1bdc4;
    background-color: #cbd2d7;
    font-weight: bold;
    padding: 10px 10px 10px 10px;
    border-radius: 7px;
    color: #333333;
    font-size: 0.9em;
}
    </style>
    </head>
    <body>');
$this->mail->addMsg('
    <div class="info">
    <p>Mail envoyé depuis le formulaire de contact du site des Escholiers.</p>
    </div>
    <p></p>');
$this->mail->addMsg('<p>'.$this->getContent().'</p>');
    $this->mail->addMsg('    </body>
</html>
');

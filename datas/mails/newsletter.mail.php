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
$this->mail->addMsg($this->getContent());
$this->mail->addMsg('
    <div class="info">
        <p>Pour ne plus recevoir notre newsletter RDV ici : <a href="'.Datas::$URL_ROOT.'unsuscribe-'.$this->id.'-'.$this->code.'.html" title="Désabonnement">'.Datas::$URL_ROOT.'unsuscribe-'.$this->id.'-'.$this->code.'.html</a></p>
        <p>Ceci est un messsage automatique, inutile d\'y répondre.</p>
    </div>');
    $this->mail->addMsg('    </body>
</html>
');

<?php
$mail->addMsg('<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <meta charset="utf-8"/>
    </head>
    <body>');
$mail->addMsg($this->getMsg());
   $mail->addMsg('    </body>
</html>
');

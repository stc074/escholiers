<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Newsletter - Désabonnement</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
        <div id="section">
        <h1>Newsletter : désabonnement</h1>
        <?php
function autoloader($class) {
    include_once '../classes/'.$class.'.class.php';
}

spl_autoload_register(autoloader);
$newsletter=new Newsletter();
$newsletter->testUnsuscribe();
if($newsletter->getTest()==0) {
    ?>
        <div class="error">
            <p>Erreur, abonné(e) inconnu(e) !</p>
        </div>
        <?php
} elseif($newsletter->getTest()==1) {
    ?>
        <div class="info">
            <p>Vous n'êtes plus abonné(e) à la newsletter !</p>
        </div>
        <?php
}
        ?>
        </div>
    </body>
</html>

<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
function __autoload($class) {
    include_once '../classes/'.$class.'.class.php';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="datas/jquery-superbox-0.9.1/jquery.superbox.css" type="text/css" media="all" />
        <link type="text/css" rel="stylesheet" href="css/stylePers.css"/>
        <script type="text/javascript" src="js-global/FancyZoom.js"></script>
        <script type="text/javascript" src="js-global/FancyZoomHTML.js"></script>
        <title>TITRE</title>
    </head>
    <body onload="setupZoom()">
        <div id="section">
        <?php
        //
        $personne=new Personne();
        $personne->initPersonne2();
        ?>
        <h1><?php echo $personne->getLibelle(); ?></h1>
        <?php
        if($personne->getImg()==NULL) {
            ?>
        <div class="info">
            <p>Aucune photo disponible</p>
        </div>
        <p></p>
        <?php
        } else {
            ?>
        <h2>Photo :</h2>
        <div class="vignette">
            <a href="<?php echo $personne->getFilename(); ?>" title="<?php echo $personne->getLibelle(); ?>">
                <img src="<?php echo $personne->getFilenameMini(); ?>" width="<?php echo $personne->getImg()->getLargeurSource(); ?>" height="<?php echo $personne->getImg()->getHauteurSource(); ?>"/>
            </a>
            <p>(Cliquez dessus pour voir en taille réelle)</p>
        </div>
        <?php
        }
        ?>
        <p></p>
        <p><?php echo $personne->getDescription(); ?></p>
        </div>
    </body>
</html>

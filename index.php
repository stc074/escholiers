<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include_once('settings.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?php echo $tags->getTitle(); ?></title>
        <meta name="description" content="<?php echo $tags->getDescription(); ?>"/>
        <meta charset="utf-8"/>
        <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <link type="text/css" href="menu/menu.css" rel="stylesheet" />
        <link type="text/css" href="jscrollpane/style/jquery.jscrollpane.css" rel="stylesheet" media="all" />
        <?php
        switch($page) {
            case 4: ?>
        <link rel="stylesheet" href="datas/jquery-superbox-0.9.1/jquery.superbox.css" type="text/css" media="all" />
        <?php
        break;
            case 6: ?>
        <link rel="stylesheet" type="text/css" href="css/simplyScroll.css"/>
        <?php
            break;
        }
        ?>
        <script type="text/javascript" src="menu/jquery.js"></script>
        <script type="text/javascript" src="menu/menu.js"></script>
        <script type="text/javascript" src="jscrollpane/script/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="jscrollpane/script/jquery.jscrollpane.min.js"></script>
        <script type="text/javascript" src="scripts/scripts.js"></script>
        <?php
        switch($page) {
            case 4: ?>
        <script type="text/javascript" src="datas/jquery-superbox-0.9.1/jquery.superbox-min.js"></script>
        <script type="text/javascript">
        $(function(){
                $.superbox();
        });
$.superbox.settings = {
	boxId: "superbox", // Attribut id de l'élément "superbox"
	boxClasses: "", // Classes de l'élément "superbox"
	overlayOpacity: .8, // Opacité du fond
	boxWidth: "700", // Largeur par défaut de la box
	boxHeight: "540", // Hauteur par défaut de la box
	loadTxt: "Chargement...", // Texte de loading
	closeTxt: "Fermer", // Texte du bouton "Close"
	prevTxt: "Precedant", // Texte du bouton "previous"
	nextTxt: "Suivant" // Texte du bouton "Next"
};
</script>
        <?php
        break;
            case 6: ?>
        <script type="text/javascript" src="js-global/FancyZoom.js"></script>
        <script type="text/javascript" src="js-global/FancyZoomHTML.js"></script>
        <script type="text/javascript" src="scripts/jquery.simplyscroll.min.js"></script>
        <script type="text/javascript">
        (function($) {
                $(function() { //on DOM ready
                        $("#scroller").simplyScroll({
                        auto: false,
			speed: 10
                        });
                });
        })(jQuery);
</script>
<?php
 break;
        case 7: ?>
<script type="text/javascript" src="mediaplayer-5.10-viral/jwplayer.js"></script>
<?php
        break;
        case 8: ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<?php
        break;
        }
        ?>
        <script type="text/javascript">
            $(function() {
                $('#section').jScrollPane();
            });
        </script>
    <meta name="google-site-verification" content="9fkSk0fwXIzZ9T3w7OKOkLcvuNmKVbcDVVNjPBzl8qo" />    </head>
    <body<?php if($page==6) { echo ' onload="setupZoom()"'; } ?>>
        <div id="page">
            <div id="logo"></div>
            <div id="nav">
                <?php
                include_once 'scripts/menu.php';
                ?>
            </div>
        <div id="section">
            <?php
            //echo $page;
            switch($page) {
                case 0:
                include_once 'scripts/accueil.php';
                    break;
                case 1:
                    include_once 'scripts/dispPresentation.php';
                    break;
                case 2:
                    include_once 'scripts/affichePage.php';
                    break;
                case 3:
                    include_once 'scripts/dispHistoric.php';
                    break;
                case 4:
                    include_once 'scripts/personnes.php';
                    break;
                case 5:
                    include_once 'scripts/reservation.php';
                    break;
                case 6:
                    include_once 'scripts/galeriesPhoto.php';
                    break;
                case 7:
                    include_once 'scripts/videos.php';
                    break;
                case 8:
                    include_once 'scripts/plan.php';
                    break;
                case 9:
                    include_once 'scripts/contact.php';
                    break;
                case 10:
                    include_once 'scripts/livreDor.php';
                    break;
                case 11:
                    include_once 'scripts/presentation.php';
                    break;
            }
            ?>
        </div>
        <div id="footer">
            <?php
                        include_once 'scripts/footer.php';
                        ?>
        </div>
        </div>
    </body>
</html>

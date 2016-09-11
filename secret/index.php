<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include_once('settings.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Les escholiers :: Administration du site</title>
        <meta name="description" content=""/>
        <meta charset="utf-8"/>
        <link rel="shortcut icon" type="image/png" href="../images/favicon.png"/>
        <?php
        switch($page) {
            case 5: ?>
        <link rel="stylesheet" type="text/css" href="../css/simplyScroll.css"/>
        <?php
            break;
        }
        ?>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <link type="text/css" href="../menuH1/menu.css" rel="stylesheet" />
        <script type="text/javascript" src="../menuH1/jquery.js"></script>
        <script type="text/javascript" src="../menuH1/menu.js"></script>
        <script type="text/javascript" src="scripts/scripts.js"></script>
        <?php
        switch($page) {
            case 1:
                case 3:
                    case 12:
                        case 13: ?>
        <script type="text/javascript" src="../datas/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="../datas/ckfinder/ckfinder.js"></script>
        <?php
        break;
            case 4: ?>
        <script type="text/javascript" src="js-global/FancyZoom.js"></script>
        <script type="text/javascript" src="js-global/FancyZoomHTML.js"></script>
        <?php
            break;
        case 5: ?>
        <script type="text/javascript" src="js-global/FancyZoom.js"></script>
        <script type="text/javascript" src="js-global/FancyZoomHTML.js"></script>
        <script type="text/javascript" src="../scripts/jquery.simplyscroll.min.js"></script>
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
        case 6:
            case 7: ?>
<script type="text/javascript" src="../mediaplayer-5.10-viral/jwplayer.js"></script>
<?php
 break;
    case 15:
        case 18: ?>
        <script type="text/javascript" src="../datas/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="../datas/ckfinder/ckfinder.js"></script>
        <script type="text/javascript" src="js-global/FancyZoom.js"></script>
        <script type="text/javascript" src="js-global/FancyZoomHTML.js"></script>
        <?php
            break;
        case 32: ?>
        <link type="text/css" rel="stylesheet" href="css/jquery-ui.css"/>
        <script type="text/javascript" src="scripts/jquery-1.8.2.js"></script>
        <script type="text/javascript" src="scripts/jquery-ui.js"></script>
        <script type="text/javascript" src="scripts/jquery-ui-timepicker-addon.js"></script>
        <script type="text/javascript" src="scripts/i18n/jquery.ui.datepicker-fr.js"></script>
            <script type="text/javascript">
            $(function() {
                $('#date').datetimepicker(
         $.datepicker.regional[ "fr" ],
         {timeFormat: "tt hh:mm"}
        );
            });
            
        </script>
        <?php
        break;
            case 27:
                case 28:
                    case 33:
                        case 35: ?>
        <script type="text/javascript" src="../datas/ckeditor/ckeditor.js"></script>
        <?php
            break;
        }
        ?>
     </head>
     <body<?php if($page==4||$page==5||$page==15||$page==18) { echo ' onload="setupZoom()"'; } ?>>
         <div id="header">
             <h1>Administration</h1>
             <div id="nav">
             <?php
             include_once 'scripts/menuTop.php';
             ?>
             </div>
         </div>
         <div id="section">
             <?php
             switch($page) {
                 case 1:
                 include_once 'scripts/ajouterPage.php';
                     break;
                 case 2:
                     include_once 'scripts/modifierPage.php';
                     break;
                 case 3:
                     include_once 'scripts/editPage.php';
                     break;
                 case 4:
                     include_once 'scripts/ajouterPhoto.php';
                     break;
                 case 5:
                     include_once 'scripts/modifierPhotos.php';
                     break;
                 case 6:
                     include_once 'scripts/ajouterVideo.php';
                     break;
                 case 7:
                     include_once 'scripts/gestionPlaylist.php';
                     break;
                 case 8:
                     include_once 'scripts/changeEmail.php';
                     break;
                 case 9:
                     include_once 'scripts/changeAddress.php';
                     break;
                 case 10:
                     include_once 'scripts/ajouterGalerie.php';
                     break;
                 case 11:
                     include_once 'scripts/gestionGaleries.php';
                     break;
                 case 12:
                     include_once 'scripts/presentationCompagnie.php';
                     break;
                 case 13:
                     include_once 'scripts/historiqueCompagnie.php';
                     break;
                 case 14:
                     include_once 'scripts/ajouterGroupePersonnes.php';
                     break;
                 case 15:
                     include_once 'scripts/ajouterPersonne.php';
                     break;
                 case 16:
                     include_once 'scripts/gestionGroupes.php';
                     break;
                 case 17:
                     include_once 'scripts/gestionGroupe.php';
                     break;
                 case 18:
                     include_once 'scripts/modifPersonne.php';
                     break;
                 case 19:
                     include_once 'scripts/ajouterPersonne0.php';
                     break;
                 case 20:
                     include_once 'scripts/editReservation.php';
                     break;
                 case 21:
                     include_once 'scripts/spectacleActuel.php';
                     break;
                 case 22:
                     include_once 'scripts/gestionSalles.php';
                     break;
                 case 23:
                     include_once 'scripts/gestionDates.php';
                     break;
                 case 24:
                     include_once 'scripts/gestionSpectacles.php';
                     break;
                 case 25:
                     include_once 'scripts/modifSalles.php';
                     break;
                 case 26:
                     include_once 'scripts/reservations.php';
                     break;
                 case 27:
                     include_once 'scripts/reservation.php';
                     break;
                 case 28:
                     include_once 'scripts/sendNewsletter.php';
                     break;
                 case 29:
                     include_once 'scripts/emailReservation.php';
                     break;
                 case 30:
                     include_once 'scripts/ajoutSpectacle.php';
                     break;
                 case 31:
                     include_once 'scripts/ajoutSalle.php';
                     break;
                 case 32:
                     include_once 'scripts/ajoutDate.php';
                     break;
                 case 33:
                     include_once 'scripts/txtReservation.php';
                     break;
                 case 34:
                     include_once 'scripts/gestionDates.php';
                     break;
                 case 35:
                     include_once 'scripts/textesPresentation.php';
                     break;
                 case 36:
                     include_once 'scripts/gestionMessages.php';
                     break;
             }
             ?>
         </div>
         <div id="footer">
             <?php
             include_once 'scripts/footer.php';
             ?>
         </div>
     </body>
</html>

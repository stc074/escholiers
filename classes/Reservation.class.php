<?php
/**
 * Description of Reservation
 *
 * @author pj
 */
class Reservation extends Objet {
    
    private $id=0;
    private $idEvenement=0;
    private $dateTimeTxt="";
    private $idSpectacle=0;
    private $idSalle=0;
    private $arrayDays=array(
        "dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"
    );
    private $arrayMonths=array(
        "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "aout",
        "septembre", "octobre", "novembre", "décembre"
    );
    //
    private $nom="";
    private $prenom="";
    private $email="";
    private $telephone="";
    private $nbPlaces="";
    private $groupes=FALSE;
    private $newsletter=FALSE;
    private $actualSpec="";
    private $salle=NULL;
    private $spectacle=NULL;
    private $objet="";
    private $msg="";
    //
    private $emailReservation="";
    private $idEmailReservation=0;
    
    
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
        $this->spectacle=new Spectacle();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function verifFormEvent() {
        if(isset($_POST["subm"])) {
            $this->getPostsEvent();
            $this->verifPostsEvent();
            if(empty($this->errorMsg)) {
                $this->insertEvent();
            }
        }
    }
    
    private function getPostsEvent() {
        $this->idSpectacle=  addslashes(htmlspecialchars($_POST["idSpectacle"]));
        $this->idSalle=addslashes(htmlspecialchars($_POST["idSalle"]));
        $this->dateTimeTxt=  addslashes(htmlspecialchars($_POST["dateTime"]));
    }
    
    private function verifPostsEvent() {
        if(empty($this->idSpectacle)) {
            $this->errorMsg.="Veuillez choisir un SPECTACLE SVP.<br/>";
        }
        if(empty($this->idSalle)) {
            $this->errorMsg.="Veuillez choisir une SALLE SVP<br/>";
        }
        if(empty($this->dateTimeTxt)) {
            $this->errorMsg.="Champ HORAIRE vide.<br/>";
        } elseif(!preg_match("#^[0-9]{2}\/[0-9]{2}\/[0-9]{4} [0-9]{2}:[0-9]{2}$#", $this->getDateTimeTxt())) {
            $this->errorMsg.="Champ HORAIRE non valide.<br/>";
        }
    }
    
    private function insertEvent() {
        //on decompose la date;
        $date=array();
        $time=array();
        $datetime=array();
        $datetime=  split(' ', $this->getDateTimeTxt());
        $date=split('/', $datetime[0]);
        $time=  split(':', $datetime[1]);
        $sqlDate=$date[2]."-".$date[1].'-'.$date[0]." ".$time[0].":".$time[1].":00";
        //on enregistre l'evenement dans la base
        $sth=NULL;
        $array=array();
        $query="INSERT INTO table_evenements (id_spectacle,id_salle,horaire,tstp) VALUES (?,?,?,?)";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->idSpectacle,
            $this->idSalle,
            $sqlDate,
            time()
        );
        $sth->execute($array);
        $this->message="Reservation enregistrée : ".date("\L\e d-m-Y \à H:i", strtotime($sqlDate));
        $this->blank2();
        $this->test=1;
    }
    
    public function dispListDates() {
        if(empty($this->idSpectacle)) { ?>
<p></p>
<div class="info">
    <p>Choisissez un spectacle SVP.</p>
</div>
<p></p>
<?php
    } else {
        //liste les dates du spectacles en cours
        $sth=NULL;
        $array=array();
        $query="SELECT DISTINCT SA.id,SA.libelle FROM table_salles SA, table_evenements EV WHERE SA.id=EV.id_salle AND EV.id_spectacle=? ORDER BY SA.tstp ASC";
        $sth=$this->dbh->prepare($query);
        $array=array($this->idSpectacle);
        $sth->execute($array);
        $nb1=0;
        $nb2=0;
        while($row=$sth->fetchObject()) {
            $nb1++;
            $idSalle=$row->id;
            $libelle=  str_replace('\\', '', $row->libelle);
            ?>
<h3><?php echo $libelle; ?></h3>
<?php
        //on affiche les dates de cette salle
        $sth2=NULL;
        $array2=array();
        $query2="SELECT id,horaire FROM table_evenements WHERE id_spectacle=? AND id_salle=? ORDER BY horaire ASC";
        $sth2=$this->dbh->prepare($query2);
        $array2=array(
            $this->idSpectacle,
            $idSalle
        );
        $sth2->execute($array2);
        while($row2=$sth2->fetchObject()) {
            $nb2++;
            $idEvent=$row2->id;
            $horaire=$row2->horaire;
            $horaireTxt=date("\L\e d-m-Y \à H:i:s", strtotime($horaire));
            ?>
<div class="cadre1">
    <div class="enLigne">
        <p><?php echo $horaireTxt; ?></p>
    </div>
    <div class="delete2" title="Supprimer cette date" onclick="javascript:testDelDate(<?php echo $this->idSpectacle; ?>, <?php echo $idEvent; ?>);"></div>
</div>
<p></p>
<?php
        }
        if(empty($nb2)) { ?>
<p></p>
<div class="info">
    <p>Pas de date enregistrée pour cette salle.</p>
</div>
<p></p>
<?php
        }
        }
        if(empty($nb1)) { ?>
<p></p>
<div class="info">
    <p>Aucune date enregistrée pour ce spectacle.</p>
</div>
<p></p>
<?php
        }
    }
    }
    
    public function testDel() {
        if(!empty($this->idSpectacle)&& isset($_GET["idDel"])) {
            $this->id=  addslashes(htmlspecialchars($_GET["idDel"]));
            //on efface la date
            $sth=NULL;
            $array=array();
            $query="DELETE FROM table_evenements WHERE id=? AND id_spectacle=?";
            $sth=$this->dbh->prepare($query);
            $array=array(
                $this->id,
                $this->idSpectacle
            );
            $sth->execute($array);
        }
    }
    
    public function dispDates() {
        if(!empty($this->idSpectacle)) {
            $sth=NULL;
            $array=array();
            $query="SELECT S.libelle, E.id, E.horaire FROM table_salles S, table_evenements E WHERE E.id_spectacle=? AND S.id=E.id_salle ORDER BY S.tstp,E.horaire";
            $sth=$this->dbh->prepare($query);
            $array=array($this->idSpectacle);
            $sth->execute($array);
            $ancLibelle="";
            ?>
<select name="idDate" id="idDate">
    <optgroup>
    <option value="0"<?php if($this->idEvenement==0) { echo ' selected="selected"'; } ?>>Choisissez</option>
    <?php
            while($row=$sth->fetchObject()) {
                $libelle=  str_replace('\\', '', $row->libelle);
                $id=$row->id;
                $horaire=$row->horaire;
                $array=  explode(" ", $horaire);
                $arrayDate=explode("-", $array[0]);
                list($year, $month, $day)=$arrayDate;
                $arrayHour=  explode(":", $array[1]);
                list($hour, $minute, $second)=$arrayHour;
                $timestamp=mktime($hour, $minute, $second, $month, $day, $year);
                $dateTxt="Le ".$this->arrayDays[date("w", $timestamp)]." ".$day." ".$this->arrayMonths[date("n", $timestamp)-1]. " à ".$hour."H".$minute;
                if($libelle!=$ancLibelle) {
                    $ancLibelle=$libelle;
                    ?>
</optgroup>
<optgroup label="<?php echo $libelle; ?>">
    <?php
                }
                ?>
    <option value="<?php echo $id; ?>"<?php if($id==$this->idEvenement) { echo ' selected="selected"'; } ?>><?php echo $dateTxt; ?></option>
    <?php
            }
?>
    </select>
<?php
            }
    }
    
    public function verifFormRes() {
        if(isset($_POST["subm"])) {
            $this->getPostsRes();
            $this->verifPostsRes();
            if(empty($this->errorMsg)) {
                $this->recRes();
            }
        }
    }
    
    private function getPostsRes() {
        $this->idEvenement=  addslashes(htmlspecialchars($_POST["idDate"]));
        $this->nom=  addslashes(htmlspecialchars($_POST["nom"]));
        $this->prenom=  addslashes(htmlspecialchars($_POST["prenom"]));
        $this->email= strtolower(addslashes(htmlspecialchars($_POST["email"])));
        $this->telephone=  addslashes(htmlspecialchars($_POST["telephone"]));
        $this->nbPlaces=  addslashes(htmlspecialchars($_POST["nbPlaces"]));
        if(isset($_POST["groupes"])) {
            $this->groupes=TRUE;
        }
        if(isset($_POST["newsletter"])) {
            $this->newsletter=TRUE;
        }
    }
    
    private function verifPostsRes() {
        if(empty($this->idEvenement)) {
            $this->errorMsg.="Veuillez choisir une DATE SVP.<br/>";
        }
        if(empty($this->nom)) {
            $this->errorMsg.="Champ NOM vide.<br/>";
        } elseif(strlen($this->nom)>100) {
            $this->errorMsg.="Champ NOM trop long.<br/>";
        }
        if(empty($this->prenom)) {
            $this->errorMsg.="Champ PRÉNOM vide.<br/>";
        } elseif(strlen($this->prenom)>100) {
            $this->errorMsg.="Champ PRÉNOM trop long.<br/>";
        }
        if(empty($this->email)) {
            $this->errorMsg.="Champ ADRESSE EMAIL vide.<br/>";
        } elseif(strlen($this->email)>200) {
            $this->errorMsg.="Champ ADRESSE EMAIL trop long.<br/>";
        } elseif(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $this->email)) {
            $this->errorMsg.="Champ ADRESSE EMAIL non-valide.<br/>";
        }
        if(empty($this->telephone)) {
            $this->errorMsg.="Champ TÉLÉPHONE vide.<br/>";
        } elseif(strlen($this->telephone)>20) {
            $this->errorMsg.="Champ TÉLÉPHONE trop long.<br/>";
        }
        if(empty($this->nbPlaces)) {
            $this->errorMsg.="Champ NOMBRE DE PLACES vide.<br/>";
        } elseif(strlen($this->nbPlaces)>4) {
            $this->errorMsg.="Champ NOMBRE DE PLACES trop long.<br/>";
        } elseif(!preg_match("#^[0-9]{1,4}$#", $this->nbPlaces)) {
            $this->errorMsg.="Champ NOMBRE DE PLACES non-valide.<br/>";
        }
    }
    
    private function recRes() {
        //enregistrement de la reservation
        $sth=NULL;
        $array=array();
        $query="INSERT INTO table_reservations (id_evenement,nom,prenom,email,telephone,nb_places,groupes,newsletter,tstp) VALUES (?,?,?,?,?,?,?,?,?)";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->idEvenement,
            $this->nom,
            $this->prenom,
            $this->email,
            $this->telephone,
            $this->nbPlaces,
            $this->convBool($this->groupes),
            $this->convBool($this->newsletter),
            time()
        );
        $sth->execute($array);
        $this->id=$this->dbh->lastInsertId();
        //enregistre si newsletter:
        if($this->isNewsletter()) {
            //teste si l'email est enregistré
            $sth=NULL;
            $array=array();
            $query="SELECT COUNT(id) AS nb FROM table_newsletter WHERE email=?";
            $sth=$this->dbh->prepare($query);
            $array=array($this->email);
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $nb=$row->nb;
                if(empty($nb)) {
                $sth=NULL;
                $array=array();
                $query="INSERT INTO table_newsletter (nom,prenom,email,tstp) VALUES (?,?,?,?)";
                $sth=$this->dbh->prepare($query);
                $array=array(
                    $this->nom,
                    $this->prenom,
                    $this->email,
                    time()
                );
                $sth->execute($array);
                }
            }
        }
        $mail=new Mail();
        //$this->id='test';
        //recherche de la date;
        $sth=NULL;
        $array=array();
        $query="SELECT horaire FROM table_evenements WHERE id=? LIMIT 0,1";
        $sth=$this->dbh->prepare($query);
        $array=array($this->idEvenement);
        $sth->execute($array);
        $dateTxt="indéfini";
        $row=$sth->fetchObject();
        if($row!=NULL) {
            $horaire=$row->horaire;
            $array=  explode(" ", $horaire);
            $arrayDate=explode("-", $array[0]);
            list($year, $month, $day)=$arrayDate;
            $arrayHour=  explode(":", $array[1]);
            list($hour, $minute, $second)=$arrayHour;
            $timestamp=mktime($hour, $minute, $second, $month, $day, $year);
            $dateTxt="Le ".$this->arrayDays[date("w", $timestamp)]." ".$day." ".$this->arrayMonths[date("n", $timestamp)-1]. " &agrave; ".$hour."H".$minute;
        }
        //Envoi d'un mail à l'internaute
        $mail->setSubject("Réservation pour \"".$this->spectacle->getLibelle()."\" - Les Escholiers");
        $mail->setDest($this->getEmail());
        $mail->setReply("noreply@lesescholiers.fr");
        $mail->initMsg();
        include 'datas/mails/reservation2.mail.php';
        $mail->init();
        $this->errorMsg.=$mail->send();
        //Envoi d'un mail a l'administrateur
        $mail->setSubject("Site les escholiers - Nouvelle réservation");
        //recuperation de l'email de reservation
        $this->loadEmail();
        //
        $mail->setDest($this->getEmailReservation());
        $mail->setReply($this->getEmail());
        $mail->initMsg();
        include 'datas/mails/reservation.mail.php';
        $mail->init();
        $this->errorMsg.=$mail->send();
        if($this->isNewsletter()) {
        //envoies de la demande d'inscription à la newsletter
            $mail->setDest(Datas::$EMAIL_NEWSLETTER);
            $mail->setSubject("Les escholiers - inscription newsletter");
            $mail->setFrom($this->getEmail());
            $mail->setFromName($this->getPrenom()." ".$this->getNom());
            $mail->setReply($this->getEmail());
            $mail->initMsg();
            include "datas/mails/inscriptionNewsletter.mail.php";
            $mail->initInscNews();
            $this->errorMsg.=$mail->send();
        }
        if(empty($this->errorMsg)) {
            $this->message="Reservation enregistrée :<br/>
                ".$this->getNbPlaces()." places";
            if($this->isGroupes()) {
                $this->message.="(Groupées)";
            }
            $this->message.=" pour le spectacle \"".$this->spectacle->getLibelle()."\".<br/>
                ".$dateTxt.".<br/>";
            if($this->isNewsletter()) {
                $this->message.="&rarr; Enregistrement à la newsletter.";
            }
            $this->blank();
            $this->test=1;
        }
    }
    
    public function dispListRes() {
        $sth=NULL;
        $array=array();
        $query="SELECT E.id,S.libelle,E.horaire FROM table_evenements E, table_salles S WHERE E.id_spectacle=? AND S.id=E.id_salle AND E.id IN (SELECT id_evenement FROM table_reservations) ORDER BY S.tstp,E.horaire";
        $sth=$this->dbh->prepare($query);
        $array=array($this->getIdSpectacle());
        $sth->execute($array);
        $libelleSalle="";
        ?>
<ul class="listRes">
    <?php
    while($row=$sth->fetchObject()) {
        $idEvent=$row->id;
        $libSalle=  str_replace('\\', '', $row->libelle);
        $horaire=$row->horaire;
        if($libSalle!=$libelleSalle) { ?>
    <div><?php echo $libSalle; ?></div>
    <?php
        $libelleSalle=$libSalle;
        }
        $array=  explode(" ", $horaire);
        $arrayDate=explode("-", $array[0]);
        list($year, $month, $day)=$arrayDate;
        $arrayHour=  explode(":", $array[1]);
        list($hour, $minute, $second)=$arrayHour;
        $timestamp=mktime($hour, $minute, $second, $month, $day, $year);
        $dateTxt="Le ".$this->arrayDays[date("w", $timestamp)]." ".$day." ".$this->arrayMonths[date("n", $timestamp)-1]. " &agrave; ".$hour."H".$minute;
        ?>
    <li onclick="javascript:clickRes(<?php echo $idEvent; ?>);"><?php echo $dateTxt; ?></li>
    <div class="delete2" title="Éffacer" onclick="javascript:deleteReservation(<?php echo $idEvent; ?>);"></div>
        <ul id="listRes<?php echo $idEvent; ?>">
            <?php
            $sth2=NULL;
            $array2=array();
            $query2="SELECT id,nom,prenom,tstp FROM table_reservations WHERE id_evenement=? ORDER BY tstp ASC";
            $sth2=$this->dbh->prepare($query2);
            $array2=array($idEvent);
            $sth2->execute($array2);
            while($row2=$sth2->fetchObject()) {
                $idRes=$row2->id;
                $nom=  str_replace('\\', '', $row2->nom);
                $prenom=  str_replace('\\', '', $row2->prenom);
                $tstp=$row2->tstp;
                ?>
            <li onclick="javascript:window.location.href='reservation-<?php echo $idRes; ?>.html';">Réservation du <?php echo date('d-m-Y', $tstp); ?> : <?php echo $prenom; ?> <?php echo $nom; ?></li>
            <?php
            }
            ?>
        </ul>
            <script type="text/javascript">
                document.getElementById("listRes<?php echo $idEvent; ?>").style["display"]="none";
        </script>
    <?php
    }
    ?>
</ul>
<?php
    }
    
    public function testSpectacle() {
        if(isset($_GET["idSpectacle"])) {
            $this->idSpectacle=  addslashes(htmlspecialchars($_GET["idSpectacle"]));
        }
    }
    
    public function dispReservation() {
        $this->id=0;
        if(isset($_GET["idReservation"])) {
            $this->id=  addslashes(htmlspecialchars($_GET["idReservation"]));
            //on récupère les données de la reservation
            $sth=NULL;
            $array=array();
            $query="SELECT SP.libelle AS libelleSP, S.libelle AS libelleS, E.horaire, R.nom, R.prenom, R.email, R.telephone, R.nb_places, R.groupes, R.newsletter, R.tstp FROM table_reservations R,table_evenements E, table_salles S, table_spectacles SP WHERE R.id=? AND E.id=R.id_evenement AND S.id=E.id_salle AND SP.id=E.id_spectacle LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $array=array($this->id);
            $this->salle=new Salle();
            $this->spectacle=new Spectacle();
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $this->spectacle->setLibelle(str_replace('\\', '', $row->libelleSP));
                $this->salle->setLibelle(str_replace('\\', '', $row->libelleS));
                $horaire=$row->horaire;
                $this->nom=$row->nom;
                $this->prenom=$row->prenom;
                $this->email=$row->email;
                $this->telephone=$row->telephone;
                $this->nbPlaces=$row->nb_places;
                $this->groupes=$this->convBoolInt($row->groupes);
                $this->newsletter=$this->convBoolInt($this->newsletter);
                $tstp=$row->tstp;
                $array=  explode(" ", $horaire);
                $arrayDate=explode("-", $array[0]);
                list($year, $month, $day)=$arrayDate;
                $arrayHour=  explode(":", $array[1]);
                list($hour, $minute, $second)=$arrayHour;
                $timestamp=mktime($hour, $minute, $second, $month, $day, $year);
                $dateTxt="Le ".$this->arrayDays[date("w", $timestamp)]." ".$day." ".$this->arrayMonths[date("n", $timestamp)-1]. " &agrave; ".$hour."H".$minute;
            } else {
                $this->id=0;
                //echo 'error SQL';
            }
        }
        if(empty($this->id)) {
            ?>
<p></p>
<div class="erreur">
    <p>Réservation inconnue !</p>
</div>
<?php
        } else {
            ?>
<p><?php echo $this->getPrenom(); ?> <?php echo $this->getNom(); ?> a demandé une réservation le <?php echo date("d-m-Y", $tstp); ?> pour <?php echo $this->spectacle->getLibelle(); ?> (<?php echo $this->salle->getLibelle(); ?>).<br/>
Date de la réservation : <?php echo $dateTxt; ?>.
<?php echo $this->getNbPlaces(); ?> place(s)
<?php
if($this->groupes) {
    echo ' (Groupée(s)).';
} else {
    echo ' (Non groupée(s)).';
}
?>
<br/>
<?php
if($this->newsletter) {
    ?>
<?php echo $this->getPrenom(); ?> <?php echo $this->getNom(); ?> a été ajouté à la liste de ceux qui reçoivent la newsletter.<br/>
<?php
}
?>
</p>
<p>
    <a href="mailto:<?php echo $this->email; ?>"><?php echo $this->email; ?></a>
</p>
<?php
        }
    }
    
    public function verifSendMsg() {
        if(isset($_POST["subm"], $_POST["objet"], $_POST["message"])) {
            $this->getPostsMsg();
            $this->verifPostsMsg();
            if(empty($this->errorMsg)) {
                $this->sendMsg();
            }
        }
    }
    
    private function getPostsMsg() {
        $this->objet=  addslashes(htmlspecialchars($_POST["objet"]));
        $this->msg=$this->codeHTML($_POST["message"]);
    }
    
    private function verifPostsMsg() {
        if(empty($this->objet)) {
            $this->errorMsg.="Champ OBJET vide.<br/>";
        } elseif(strlen($this->objet)>100) {
            $this->errorMsg.="Champ OBJET trop long (100 Car. maxi).<br/>";
        }
        if(empty($this->msg)) {
            $this->errorMsg.="Champ MESSAGE vide.<br/>";
        } elseif(strlen($this->message)>10000) {
            $this->errorMsg.="Champ MESSAGE trop long (10000 Car Maxi).<br/>";
        }
    }
    
    private function sendMsg() {
        $mail=new Mail();
        $mail->initMsg();
        include_once '../datas/mails/message.mail.php';
        $mail->setSubject($this->getObjet());
        $mail->setDest($this->getEmail());
        $mail->setReply("jeanine.ribollet@wanadoo.fr");
        $mail->init();
        $this->errorMsg.=$mail->send();
        if(empty($this->errorMsg)) {
            $this->message="Message envoyé à ".$this->getPrenom()." ".$this->getNom();
            $this->blank();
            $this->test=1;
        }
    }
    
    public function  testDelDate() {
        if(isset($_GET["idEvent"])) {
            $idEvent=  addslashes(htmlspecialchars($_GET["idEvent"]));
            $sth=NULL;
            $array=array();
            $query="DELETE FROM table_reservations WHERE id_evenement=?";
            $sth=$this->dbh->prepare($query);
            $array=array($idEvent);
            $sth->execute($array);
        }
    }

    public function loadEmail() {
        $sth=NULL;
        $query="SELECT id,email FROM table_email_reservation LIMIT 0,1";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        $row=$sth->fetchObject();
        if($row!=NULL) {
            $this->idEmailReservation=$row->id;
            $this->emailReservation=$row->email;
        }
    }
    
    public function testChangeEmail() {
        if(isset($_POST["subm"], $_POST["email"])) {
            $this->getPostEmail();
            $this->verifPostEmail();
            if(empty($this->errorMsg)) {
                $this->updateEmail();
            }
        }
    }
    
    private function getPostEmail() {
        $this->emailReservation=  addslashes(htmlspecialchars($_POST["email"]));
    }
    
    private function verifPostEmail() {
        if(empty($this->emailReservation)) {
            $this->errorMsg.="Champ EMAIL vide.<br/>";
        }
        elseif(strlen($this->emailReservation)>200) {
            $this->errorMsg.="Champ EMAIL trop long (200 Car. maxi).<br/>";
        }
        elseif(!$this->isEmail($this->getEmailReservation())) {
            $this->errorMsg.="Champ EMAIL non-valide.<br/>";
        }
    }
    
    private function updateEmail() {
        $sth=NULL;
        $array=array();
        $query="UPDATE table_email_reservation SET email=? WHERE id=?";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->emailReservation,
            $this->idEmailReservation
                );
        $sth->execute($array);
        $this->test=1;
    }
    
    public function testGet() {
        if(isset($_GET["idSpectacle"])) {
            $this->idSpectacle=  addslashes(htmlspecialchars($_GET["idSpectacle"]));
        }
    }
    
    public function getGets() {
        if(isset($_GET['idSpectacle'])) {
            $this->idSpectacle=  addslashes(htmlspecialchars($_GET['idSpectacle']));
        }
    }
    
    public function initInfosSpectacle() {
        if(!empty($this->idSpectacle)) {
            $query="SELECT libelle FROM table_spectacles WHERE id=? LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $array=array($this->idSpectacle);
            $sth->execute($array);
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $this->spectacle->setId($this->idSpectacle);
                $this->spectacle->setLibelle($row->libelle);
            }
        }
    }

    public function blank() {
        parent::blank();
        $this->idSpectacle=0;
        $this->idSalle=0;
        $this->dateTimeTxt="";
        $this->nom="";
        $this->prenom="";
        $this->idEvenement=0;
        $this->email="";
        $this->telephone="";
        $this->nbPlaces="";
        $this->groupes=FALSE;
        $this->newsletter=FALSE;
        $this->objet="";
        $this->msg="";
    }
    
    public function blank2() {
        parent::blank();
        $this->dateTimeTxt="";
    }
    
    public function getDateTimeTxt() {
        return str_replace('\\', '', $this->dateTimeTxt);
    }
    
    public function getIdSpectacle() {
        return $this->idSpectacle;
    }
    
    public function setIdSpectacle($idSpectacle) {
        $this->idSpectacle=$idSpectacle;
    }
    
    public function getIdSalle() {
        return $this->idSalle;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getNom() {
        return str_replace('\\', '', $this->nom);
    }
    
    public function getPrenom() {
        return str_replace('\\', '', $this->prenom);
    }
    
    public function getEmail() {
        return str_replace('\\', '', $this->email);
    }
    
    public function getTelephone() {
        return str_replace('\\', '', $this->telephone);
    }
    
    public function getNbPlaces() {
        return str_replace('\\', '', $this->nbPlaces);
    }
    
    public function isGroupes() {
        return $this->groupes;
    }
    
    public function isNewsletter() {
        return $this->newsletter;
    }
    
    public function getIdEvenement() {
        return $this->idEvenement;
    }
    
    public function getActualSpec() {
        return str_replace('\\', '', $this->actualSpec);
    }
    
    public function setActualSpec($spec) {
        $this->actualSpec=$spec;
    }
    
    public function getObjet() {
        return str_replace('\\', '', $this->objet);
    }
    
    public function getMsg() {
        return str_replace('\\', '', $this->msg);
    }
    
    public function getEmailReservation() {
        return str_replace('\\', '', $this->emailReservation);
    }
    
    public function getSpectacle() {
        return $this->spectacle;
    }
}

?>

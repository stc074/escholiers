<?php

/**
 * 
 * Gestion de la newsletter
 *
 * @author pj
 */
class Newsletter extends Objet {
    
    private $object="";
    private $content="";
    private $emailTest="";
    private $mail=NULL;
    private $code="";
    private $id=0;
    private $codeCrypt="";
    private $idCrypt="";
    //
    private $prenom="";
    private $nom="";
    private $email="";
    
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function testFormSend() {
        if(isset($_POST["subm"], $_POST["object"], $_POST["content"])) {
            $this->getPostsSend();
            $this->verifPostsSend();
            if(empty($this->errorMsg)) {
                $this->sendNewsletter();
            }
        }
    }
    
    private function getPostsSend() {
        $this->object=addslashes(htmlspecialchars($_POST["object"]));
        $this->content=$this->codeHTML($_POST["content"]);
        $this->emailTest=  addslashes(htmlspecialchars($_POST["emailTest"]));
    }
    
    private function verifPostsSend() {
        if(!empty($this->emailTest)&&  strlen($this->emailTest)>200) {
            $this->errorMsg.="Champ EMAIL DE TEST trop long (200 Car. maxi).<br/>";
        } elseif(!empty($this->emailTest)&&!$this->isEmail($this->emailTest)) {
            $this->errorMsg.="Le champ EMAIL DE TEST n'est pas valide.<br/>";
        }
        if(empty($this->object)) {
            $this->errorMsg.="Champ OBJET DU MESSAGE vide.<br/>";
        } elseif(strlen($this->object)>150) {
            $this->errorMsg.="Champ OBJET DU MESSAGE trop long (150 Car. maxi).<br/>";
        }
        if(empty($this->content)) {
            $this->errorMsg.="Champ CONTENU DU MESSAGE vide.<br/>";
        } elseif(strlen($this->content)>50000) {
            $this->errorMsg.="Champ CONTENU DU MESSAGE trop long (50000 Car. maxi).<br/>";
        }
    }
    
    private function sendNewsletter() {
        $this->mail=new Mail();
        if(!empty($this->emailTest)) {
            $this->mail->initNewsletter();
            $this->mail->initMsg();
            include '../datas/mails/newsletterTest.mail.php';
            $this->mail->getMail()->AddAddress($this->getEmailTest());
            $this->mail->setSubject($this->getObject());
            $this->errorMsg.=$this->mail->sendNewsletter('"Prénom"', '"Nom"');
            if(empty($this->errorMsg)) {
                $this->test=1;
                $this->message="Newsletter de test envoyée vers \"".$this->getEmailTest()."\"<br/>";
            }
        } else {
            //on liste tous les abonnés
            $sth=NULL;
            $query="SELECT id ,nom, prenom, email FROM table_newsletter";
            $sth=$this->dbh->prepare($query);
            $sth->execute();
            while($row=$sth->fetchObject()) {
                $this->id=$row->id;
                $nom=  str_replace('\\', '', $row->nom);
                $prenom=  str_replace('\\', '', $row->prenom);
                $email=  str_replace('\\', '', $row->email);
                $this->initCode($nom);
                $this->mail->initNewsletter();
                $this->mail->initMsg();
                include '../datas/mails/newsletter.mail.php';
                $this->mail->setSubject($this->getObject());
                $this->mail->getMail()->AddAddress($email);
                $this->errorMsg.=$this->mail->sendNewsletter($prenom, $nom);
            }
            if(empty($this->errorMsg)) {
                $this->test=1;
                $this->message="Newsletter envoyée aux inscrits.<br/>";
            }
        }
    }
    
    public function testRec() {
        if(isset($_POST["submRec"])) {
            $this->getPostsSend();
            //on sauvegarde tous les champs sans les tester
            $sth=NULL;
            $array=array();
            $query="UPDATE table_datas_newsletter SET email_test=?, object=?, content=? WHERE id=?";
            $sth=$this->dbh->prepare($query);
            $array=array(
                $this->emailTest,
                $this->object,
                $this->content,
                1
            );
            $sth->execute($array);
            $this->test=1;
            $this->message="Newsletter enregistrée dans la base de données.";
            
        }
    }
    
    public function testRest() {
        if(isset($_POST["submRest"])) {
            //on charge les données depuis la bdd
            $sth=NULL;
            $query="SELECT email_test, object, content FROM table_datas_newsletter LIMIT 0,1";
            $sth=$this->dbh->prepare($query);
            $sth->execute();
            $row=$sth->fetchObject();
            if($row!=NULL) {
                $this->emailTest=$row->email_test;
                $this->object=$row->object;
                $this->content=$row->content;
            }
        }
    }
    
    private function initCode($nom) {
        $this->id=($this->id+777)*7;
        $this->code=  sha1(str_replace(Datas::$ARRAY_LETTERS, Datas::$ARRAY_CRYPT, $nom));
    }
    
    public function testUnsuscribe() {
        if(isset($_GET["code"], $_GET["id"])) {
            $this->codeCrypt=  addslashes(htmlspecialchars($_GET["code"]));
            $this->idCrypt=  addslashes(htmlspecialchars($_GET["id"]));
            if($this->testCrypt()) {
                $sth=NULL;
                $array=array();
                $query="DELETE FROM table_newsletter WHERE id=?";
                $sth=$this->dbh->prepare($query);
                $array=array($this->id);
                $sth->execute($array);
                $this->test=1;
                //on envoie la confirmation
                $mail=new Mail();
                $mail->setSubject("Desinscription de la newsletter");
                $mail->setFrom($this->email);
                $mail->setFromName($this->prenom." ".$this->nom);
                $mail->setReply($this->email);
                $mail->setDest(Datas::$EMAIL_NEWSLETTER);
                $mail->initMsg();
                include '../datas/mails/unsuscribeNewsletter.mail.php';
                $mail->initInscNews();
                $mail->send();
            }
        }
    }
    
    private function testCrypt() {
        //echo $this->idCrypt;
        $this->id=($this->idCrypt/7)-777;
        //echo $this->id;
        $sth=NULL;
        $array=array();
        $query="SELECT prenom,nom,email FROM table_newsletter WHERE id=? LIMIT 0,1";
        $sth=$this->dbh->prepare($query);
        $array=array($this->id);
        $sth->execute($array);
        $row=$sth->fetchObject();
        if($row!=NULL) {
            $this->prenom=  str_replace('\\', '', $row->prenom);
            $this->nom=$nom=  str_replace('\\', '', $row->nom);
            $this->email=  str_replace('\\', '', $row->email);
            $nomCrypt=sha1(str_replace(Datas::$ARRAY_LETTERS, Datas::$ARRAY_CRYPT, $nom));
            if($nomCrypt==$this->codeCrypt) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
    
    public function getObject() {
        return str_replace('\\', '', $this->object);
    }
    
    public function getContent() {
        return str_replace('\\', '', $this->content);
    }
    
    public function getEmailTest() {
        return str_replace('\\', '', $this->emailTest);
    }
}

?>

<?php
/**
 * Description of Contact
 *
 * @author pj
 */
class Contact extends Objet {
    
    private $email="";
    private $address="";
    private $id=0;
    private $nom="";
    private $prenom="";
    private $subject="";
    private $content="";
    private $captcha="";
        
    function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    function __destruct() {
        parent::__destruct();
    }
    
    public function initEmail() {
        $sth=NUL;
        $query="SELECT id,email FROM table_email LIMIT 0,1";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        $row=$sth->fetchObject();
        if($row!=NULL) {
            $this->id=$row->id;
            $this->email=$row->email;
        }
    }
    
    public function verifFormEmail() {
        if(isset($_POST["subm"], $_POST["email"])) {
            $this->getPostEmail();
            $this->verifPostEmail();
            if(empty($this->errorMsg)) {
                $this->updateEmail();
            }
        }
    }
    
    private function getPostEmail() {
        $this->email= strtolower(addslashes(htmlspecialchars($_POST["email"])));
    }
    
    private function verifPostEmail() {
        if(empty($this->email)) {
            $this->errorMsg.="Champ vide.<br/>";
        } elseif (strlen($this->email)>200) {
            $this->errorMsg.="Champ EMAIL trop long (200 Car. max).<br/>";
        } elseif(!preg_match("#^[a-z0-9\.\-_]+@[a-z1-9^\.]+\.[a-z]{2,5}$#", $this->getEmail())) {
            $this->errorMsg.="Adresse EMAIL non-valide.<br/>";
        }
    }
    
    private function updateEmail() {
        //
        $sth=NULL;
        $array=array();
        $query="UPDATE table_email SET email=? WHERE id=?";
        $sth=  $this->dbh->prepare($query);
        $array=array(
            $this->email,
            $this->id
        );
        $sth->execute($array);
        $this->test=1;
        $this->initEmail();
    }
    
    public function initAddress() {
        $sth=NULL;
        $query="SELECT id,address FROM table_address LIMIT 0,1";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        $row=$sth->fetchObject();
        if($row!=NULL) {
            $this->id=$row->id;
            $this->address=$row->address;
        }
    }
    
    public function verifFormAddress() {
        if(isset($_POST["subm"], $_POST["address"])) {
            $this->getPostAddress();
            $this->verifPostAddress();
            if(empty($this->errorMsg)) {
                $this->updateAddress();
            }
        }
    }
    
    private function getPostAddress() {
        $this->address=  addslashes(htmlspecialchars($_POST["address"]));
    }
    
    private function verifPostAddress() {
        if(empty($this->address)) {
            $this->errorMsg.="Champ ADRESSE vide.<br/>";
        } elseif(strlen($this->address)>500) {
            $this->errorMsg.="Champ ADRESSE trop long (500 Car. Maxi).<br/>";
        }
    }
    
    private function updateAddress() {
        //
        $sth=NULL;
        $array=array();
        $query="UPDATE table_address SET address=? WHERE id=?";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->address,
            $this->id
        );
        $sth->execute($array);
        $this->test=1;
        $this->initAddress();
    }
    
    public function verifFormCtc() {
        if(isset($_POST["subm"])) {
        $this->getPostsCtc();
        $this->verifPostsCtc();
        if(empty($this->errorMsg)) {
            $this->sendMsgCtc();
        }
        }
    }
    
    private function getPostsCtc() {
        if(isset($_POST["subm"])) {
            $this->prenom=  addslashes(htmlspecialchars($_POST["prenom"]));
            $this->nom=  addslashes(htmlspecialchars($_POST["nom"]));
            $this->email= strtolower(addslashes(htmlspecialchars($_POST["email"])));
            $this->subject=  addslashes(htmlspecialchars($_POST["subject"]));
            $this->content=  addslashes(htmlspecialchars($_POST["content"]));
            $this->captcha=  addslashes(htmlspecialchars($_POST["captcha"]));
        }
    }
    
    private function verifPostsCtc() {
        if(empty($this->prenom)) {
            $this->errorMsg.="Champ PRÉNOM vide.<br/>";
        } elseif($this->tooLong($this->prenom, 100)) {
            $this->errorMsg.="Champ PRÉNOM trop long.<br/>";
        }
        if(empty($this->nom)) {
            $this->errorMsg.="Champ NOM vide.<br/>";
        } elseif($this->tooLong($this->nom, 100)) {
            $this->errorMsg.="Champ NON trop long.<br/>";
        }
        if(empty($this->email)) {
            $this->errorMsg.="Champ ADRESSE MAIL vide.<br/>";
        } elseif($this->tooLong($this->email, 100)) {
            $this->errorMsg.="Champ ADRESSE MAIL trop long.<br/>";
        } elseif (!$this->isEmail($this->email)) {
            $this->errorMsg.="Champ ADRESSE MAIL non valide.<br/>";
        }
        if(empty($this->subject)) {
            $this->errorMsg.="Champ OBJET DU MESSAGE vide.<br/>";
        } elseif($this->tooLong($this->subject, 100)) {
            $this->errorMsg.="Champ OBJET DU MESSAGE trop long.<br/>";
        }
        if(empty($this->content)) {
            $this->errorMsg.="MESSAGE vide.<br/>";
        } elseif($this->tooLong($this->content, 5000)) {
            $this->errorMsg.="MESSAGE trop long.<br/>";
        }
        $securimage=new Securimage();
        if(empty($this->captcha)) {
            $this->errorMsg.="Champ CODE DE VALIDATION vide.<br/>";
        } elseif($securimage->check($this->captcha) == false) {
            $this->errorMsg.="Mauvais CODE DE VALIDATION.<br/>";
        }
    }
    
    private function sendMsgCtc() {
        //recupération de l'email de destination
        $sth=NULL;
        $query="SELECT email FROM table_email LIMIT 0,1";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        $row=$sth->fetchObject();
        if($row==NULL) {
            $this->errorMsg.="Impossible de trouver l'email de destination.<br/>";
        } else {
            $emailDest=$row->email;
            //envoi du mail;
            $this->mail=new Mail();
            $this->mail->setFrom($this->getEmail());
            $this->mail->setFromName($this->getPrenom()." ".$this->getNom());
            $this->mail->setDest($emailDest);
            $this->mail->setReply($this->getEmail());
            $this->mail->setSubject($this->getSubject());
            include 'datas/mails/contact.mail.php';
            $this->mail->initContact();
            $this->errorMsg.=$this->mail->send();
            if(empty($this->errorMsg)) {
                $this->blank();
                $this->test=1;
            }
        }
    }
    
    public function blank() {
        parent::blank();
        $this->prenom="";
        $this->nom="";
        $this->email="";
        $this->subject="";
        $this->content="";
    }

    public function getEmail() {
        return str_replace('\\', '', $this->email);
    }
    
    public function getAddress() {
        return str_replace('\\', '', $this->address);
    }
    
    public function getNom() {
        return str_replace('\\', '', $this->nom);
    }
    
    public function getPrenom() {
        return str_replace('\\', '', $this->prenom);
    }
    
    public function getSubject() {
        return str_replace('\\', '', $this->subject);
    }
    
    public function getContent() {
        return str_replace('\\', '', $this->content);
    }
}

?>

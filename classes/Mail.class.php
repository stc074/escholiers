<?php


/**
 * Description of Mail
 *
 * Envoie des mails
 * 
 * @author pj
 */
class Mail extends Objet {
    
    private $mail=NULL;
    private $from="";
    private $fromName="";
    private $dest="";
    private $reply="";
    private $subject="";
    private $msg="";
    
    public function __construct() {
        parent::__construct();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function init() {
        $this->mail=new PHPMailer();
        $this->mail->IsMail();
        $this->mail->IsHTML(TRUE);
        $this->mail->From="noreply@lesescholiers.fr";
        $this->mail->FromName="Site des escholiers";
        $this->mail->AddAddress($this->dest);
        $this->mail->AddReplyTo($this->reply);
        $this->mail->Subject=$this->subject;
        $this->mail->Body=$this->msg;
        $this->mail->CharSet = 'UTF-8';
    }
    
    public function initInscNews() {
        $this->mail=new PHPMailer();
        $this->mail->IsMail();
        $this->mail->IsHTML(TRUE);
        $this->mail->From=$this->from;
        $this->mail->FromName=$this->fromName;
        $this->mail->AddAddress($this->dest);
        $this->mail->AddReplyTo($this->reply);
        $this->mail->Subject=$this->subject;
        $this->mail->Body=$this->msg;
        $this->mail->CharSet = 'UTF-8';
    }

     public function initContact() {
        $this->mail=new PHPMailer();
        $this->mail->IsMail();
        $this->mail->IsHTML(TRUE);
        $this->mail->From=$this->from;
        $this->mail->FromName=$this->fromName;
        $this->mail->AddAddress($this->dest);
        $this->mail->AddReplyTo($this->reply);
        $this->mail->Subject=$this->subject;
        $this->mail->Body=$this->msg;
        $this->mail->CharSet = 'UTF-8';
    }

    public function initNewsLetter() {
        $this->mail=new PHPMailer();
        $this->mail->IsMail();
        $this->mail->IsHTML(true);
        $this->mail->From="noreply@lesescholiers.fr";
        $this->mail->FromName="Site des Escholiers - Newsletter du ".date("d-m-Y", time());
        $this->mail->AddReplyTo("noreply@lesescholiers.fr");
        $this->mail->CharSet = 'UTF-8';
    }
    
    public function send() {
        if(!$this->mail->Send()) {
            return $this->mail->ErrorInfo;
        } else {
            return "";
        }
    }
    
    public function sendNewsletter($first, $last) {
        $this->setNames($first, $last);
        $this->mail->Subject=$this->subject;
        $this->mail->Body=$this->msg;
        if(!$this->mail->Send()) {
            return $this->mail->ErrorInfo;
        } else {
            return "";
        }
    }
    
    private function setNames($first, $last) {
        $this->subject=str_replace("#1", $first, $this->subject);
        $this->subject=str_replace("#2", $last, $this->subject);
        $this->msg=str_replace("#1", $first, $this->msg);
        $this->msg=str_replace("#2", $last, $this->msg);
    }
    
    public function setFrom($from) {
        $this->from=$from;
    }
    
    public function setFromName($name) {
        $this->fromName=$name;
    }
    
    public function setDest($dest) {
        $this->dest=$dest;
    }
    
    public function setReply($reply) {
        $this->reply=$reply;
    }

    public function setSubject($subject) {
        $this->subject=$subject;
    }
    
    public function initMsg() {
        $this->msg="";
    }
    
    public function addMsg($content) {
        $this->msg.=$content;
    }
    
    public function getMail() {
        return $this->mail;
    }
}

?>

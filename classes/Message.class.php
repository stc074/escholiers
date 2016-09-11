<?php

/**
 * Description of Message
 *
 * @author pj
 */
class Message extends Objet {
    
    private $author="";
    private $tstp=0;
    private $content="";
    private $date="";
    private $captcha="";
    //
    private $authorValidator=NULL;
    private $contentValidator=NULL;
    private $captchaValidator=NULL;
    
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
        $this->authorValidator=new TextFieldValidator();
        $this->contentValidator=new TextFieldValidator();
        $this->captchaValidator=new CaptchaValidator();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function verifFormInsertLDO() {
        if(isset($_POST["subm"])) {
            $this->test=1;
            $this->getPostsInsert();
            $this->verifPostsInsert();
            if(Validator::getOK()) {
                $this->insertLDO();
            }
        }
    }
    
    private function getPostsInsert() {
        $this->author=  addslashes(htmlspecialchars($_POST["author"]));
        $this->content=  addslashes(htmlspecialchars($_POST["content"]));
        $this->captcha=  addslashes(htmlspecialchars($_POST["captcha"]));
    }
    
    private function verifPostsInsert() {
        Validator::setOK(TRUE);
        $this->authorValidator->validate($this->author, 2, 100);
        $this->contentValidator->validate($this->content, 5, 500);
        $this->captchaValidator->validate($this->captcha, 6);
    }
    
    private function insertLDO() {
        $query="INSERT INTO table_messages_ldo (author,content,tstp) VALUES (?,?,?)";
        $sth=$this->dbh->prepare($query);
        $array=array(
            $this->author,
            $this->content,
            time()
        );
        $sth->execute($array);
        $this->blank();
        $this->test=2;
        unset($_POST["subm"]);
    }
    
    public function blank() {
        parent::blank();
        $this->author="";
        $this->content="";
    }
    
    public function getValidator($validator) {
        switch ($validator) {
            case 'author':
                return $this->authorValidator;
                break;
            case 'content':
                return $this->contentValidator;
                break;
            case 'captcha':
                return $this->captchaValidator;
                break;
        }
        return new Validator();
    }
    
    public function getAuthor() {
        return str_replace('\\', '', $this->author);
    }
    
    public function getContent() {
        return str_replace('\\', '', $this->content);
    }
    
    public function getDate() {
        return str_replace('\\', '', $this->date);
    }
}

?>

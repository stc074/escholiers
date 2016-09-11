<?php
class Objet {
    
    protected $dbh=NULL;
    protected $errorMsg="";
    protected $test=0;
    protected $message="";




    function __construct() {
        if(!defined("HOSTNAME"))
            define("HOSTNAME", "localhost");
        if(!defined("DBNAME"))
            define("DBNAME", "leseschobescho");
        if(!defined("DBUSER"))
            define ("DBUSER", "leseschobescho");
        if(!defined("DBPASS"))
            define("DBPASS", "kv5p3Xz6U");
    }
    
    function __destruct() {
        $this->dbh=NULL;
    }

    protected function dbConnect() {
        try {
            $this->dbh=new PDO('mysql:host='.HOSTNAME.';dbname='.DBNAME, DBUSER, DBPASS);
    } catch (PDOException $e) {
        echo "Erreur lors de la connexion à la base de données : ".$e->getMessage()."<br/>";
    }
    }
    
    protected function codeHTML($texte) {
        $texte=  str_replace('<script', '&lt;script', $texte);
        $texte=  str_replace('<%', '&lt;%', $texte);
        $texte=  str_replace('<?php', '&lt;?php', $texte);
        $texte=  addslashes($texte);
        return $texte;
    }
    
    protected function codeURL($titre, $id) {
        return urlencode("page-".$id."-".strtolower(str_replace((' '), '-', $titre)).".html");
    }

    protected function convBool($bool) {
        if($bool) {
            return 1;
        } else {
            return 0;
        }
    }
    
    protected function convBoolInt($int) {
        if(!empty($int)) {
            return true;
        } else {
            return false;
        }
    }
    
    protected function isEmail($email) {
        return preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email);
    }
    
    protected function tooLong($txt, $len) {
        return (strlen($txt)>$len);
    }
    
    protected function getSha1($nb) {
        $code="";
        for($i=0; $i<$nb; $i++) {
            
        }
    }
    
    public function dispSelect($table, $actual=0) {
        ?>
<option value="0"<?php if($actual==0) { echo ' selected="selected"'; } ?>>Choisissez</option>
<?php
        $query="SELECT id,libelle FROM $table ORDER BY libelle";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        while($row=$sth->fetchObject()) {
            $id=$row->id;
            $libelle=str_replace('\\', '', $row->libelle);
            ?>
<option value="<?php echo $id; ?>"<?php if($id==$actual) { echo ' selected="selected"'; } ?>><?php echo $libelle; ?></option>
<?php
        }
    }

    public function getErrorMsg() {
        return str_replace('\\', '', $this->errorMsg);
    }
    
    public function getMessage() {
        return str_replace('\\', '', $this->message);
    }
    
    public function getTest() {
        return $this->test;
    }
    
    
    
    public function blank() {
        $this->errorMsg="";
        $this->test=0;
    }
}

?>

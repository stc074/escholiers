<?php

/**
 * Description of Validator
 *
 * @author pj
 */
class Validator extends Objet {
    
    static private $OK=TRUE;


    public function __construct() {
        parent::__construct();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function validate() {
        if(!empty($this->errorMsg)) {
            Validator::$OK=FALSE;
        }
    }
    
    static public function getOK() {
        return Validator::$OK;
    }
    
    static public function setOK($value) {
        Validator::$OK=$value;
    }
}

?>

<?php


/**
 * Description of TextFieldValidator
 *
 * @author pj
 */
class TextFieldValidator extends Validator {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function validate($value, $min, $max) {
        if(empty($value)) {
            $this->errorMsg="Champ vide.";
        } elseif (strlen($value)<$min) {
            $this->errorMsg="Champ trop court ($min Car. mini).";
        } elseif(strlen($value)>$max) {
            $this->errorMsg="Champ trop long ($max Car. maxi).";
        }
        parent::validate();
    }
}

?>

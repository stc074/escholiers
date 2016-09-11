<?php

/**
 * Description of CaptchaValidator
 *
 * @author pj
 */
class CaptchaValidator extends Validator {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function validate($value, $length) {
        $securimage=new Securimage();
        if(empty($value)) {
            $this->errorMsg="Champ vide.";
        } elseif(strlen($value)>$length) {
            $this->errorMsg="Champ trop long ($length Car.)";
        } elseif($securimage->check($value) == false) {
            $this->errorMsg="Code incorrect.";
        }
        parent::validate();
    }
}

?>

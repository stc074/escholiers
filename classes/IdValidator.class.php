<?php

/**
 * Description of IdValidator
 *
 * @author pj
 */
class IdValidator extends Validator {
    
    public function validate($value) {
        if(strlen($value)==0) {
            $this->errorMsg="Champ vide.";
        } elseif($value==0) {
            $this->errorMsg="Choisissez une option SVP.";
        }
        parent::validate();
    }
}

?>

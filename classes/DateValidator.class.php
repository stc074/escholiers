<?php

/**
 * Description of DateValidator
 *
 * @author pj
 */
class DateValidator extends Validator {
    
    public function validate($date) {
        if(empty($date)) {
            $this->errorMsg="Champ vide";
        } elseif(strlen($date)!=16) {
            $this->errorMsg="Champ non valide";
        } elseif(!preg_match('#^[0-9]{2}\/[0-9]{2}\/[0-9]{4} [0-9]{2}:[0-9]{2}$#', $date)) {
            $this->errorMsg="Champ non valide 2.";
        }
    }
}

?>

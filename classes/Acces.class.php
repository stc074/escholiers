<?php

/**
 * Description of Acces
 *
 * @author pj
 */
class Acces extends Objet {
    
    private $address="";
    private $addressInLine="";
    private $latitude=0;
    private $longitude=0;
    
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    public function loadAddress() {
        $sth=NULL;
        $query="SELECT address FROM table_address LIMIT 0,1";
        $sth=$this->dbh->prepare($query);
        $sth->execute();
        $row=$sth->fetchObject();
        if($row!=NULL) {
            $this->address=$row->address;
            $array=array(
                "\n",
                "\r"
            );
            $this->addressInLine=  str_replace($array, ' ', $this->address)." France";
            //$this->addressInLine="France";
        }
    }
    
    public function compCoords() {
        $ch = curl_init("http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=".urlencode($this->getAddressInLine()));
        //curl_setopt($ch, CURLOPT_URL, "http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=".urlencode($this->getAddressInLine()));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $result = curl_exec($ch);
        //on traite le résultat
        //echo $result;
        if(!$result) {
            echo "impossible de traiter les données.";
        }
        $phpresult = json_decode($result);
        //var_dump($phpresult->results[0]);
        if(is_array($phpresult->results) && sizeof($phpresult->results) > 0) {
            $this->latitude = $phpresult->results[0]->geometry->location->lat;
            $this->longitude = $phpresult->results[0]->geometry->location->lng;
        } else {
            echo '<div class="error"><p>Données indisponibles</p></div><p></p>';
        }
    }
    
    public function getAddress() {
        return str_replace('\\', '', $this->address);
    }
    
    public function getAddressInLine() {
        return str_replace('\\', '', $this->addressInLine);
    }
    
    public function getLatitude() {
        return $this->latitude;
    }
    
    public function getLongitude() {
        return $this->longitude;
    }
}

?>

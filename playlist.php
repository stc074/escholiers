<?php
	header("Content-type: text/xml; charset=UTF-8");
        
	echo '<'.'?xml version="1.0" encoding="iso-8859-1"?'.'>';
function __autoload($class) {
    include_once 'classes/'.$class.'.class.php';
}
        $playlist=new PlaylistVideo();
        $playlist->displayXML();
?>

<?php
$page=0;
if(isset($_GET["page"])) {
    $page=  addslashes(htmlspecialchars($_GET["page"]));
}

function __autoload($class) {
    include_once 'classes/'.$class.'.class.php';
}

//spl_autoload_register(autoloader);
//
$tags=new Tags();
$tags->getGets();
$tags->initTags();

?>

<?php
$page=0;
if(isset($_GET["page"])) {
    $page=  htmlspecialchars($_GET["page"]);
}

function __autoload($class) {
    include_once '../classes/'.$class.'.class.php';
}
?>

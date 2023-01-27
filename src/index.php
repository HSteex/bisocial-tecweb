<?php
require_once "bootstrap.php";

loginCheck($dbh);

$titolo = "General";
$postType=0;

if(isset($_GET["post_id"])){
    $postType=2;
}

$pagina = "post-load.php";

require("template-in.php");
?>

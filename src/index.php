<?php
require_once "bootstrap.php";

loginCheck($dbh);

$titolo = "General";
$postType=0;
$pagina = "post-load.php";

require("template-in.php");
?>

<?php
require_once "bootstrap.php";

loginCheck($dbh);

$titolo = "General";
$pagina = "post-load.php";

require("template-in.php");
?>

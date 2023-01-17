<?php
require_once "bootstrap.php";

loginCheck($dbh);

$titolo = "Personal";
$pagina = "post-load-personal.php";

require("template-in.php");
?>
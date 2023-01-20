<?php
require_once "bootstrap.php";

loginCheck($dbh);


$titolo = "Pagina di ".$_GET['username'];

$pagina = "profile-page.php";

require("template-in.php");
?>
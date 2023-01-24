<?php
require_once "bootstrap.php";

loginCheck($dbh);

$titolo = "Pagina di ".$_GET['username'];
$postType=1;
$pagina = "profile-page.php";

require("template-in.php");
?>
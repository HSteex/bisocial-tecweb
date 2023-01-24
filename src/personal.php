<?php
require_once "bootstrap.php";

loginCheck($dbh);

if(!isset($_GET['username'])){
   header("Location: index.php");
}
$titolo = "Pagina di ".$_GET['username'];

$pagina = "profile-page.php";

require("template-in.php");
?>
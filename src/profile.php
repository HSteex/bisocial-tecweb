<?php
require_once("bootstrap.php");

loginCheck($dbh);

$titolo = "Modifica Profilo";
$pagina = "profile-form.php";

require("template-in.php");
?>
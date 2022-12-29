<?php
require_once("utils/functions.php");
require_once("database/database.php");
sec_session_start();
$dbh = new DatabaseHelper("localhost","root","","besocial",3306);
?>
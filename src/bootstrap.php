<?php
require("utils/functions.php");
require("database/database.php");
sec_session_start();
$dbh = new DatabaseHelper("localhost","root","","besocial",3306);
?>
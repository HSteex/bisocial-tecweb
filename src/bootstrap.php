<?php /*
session_start();*/
require_once "functions.php";
sec_session_start();
require_once "database.php";
$dbh = new DatabaseHelper("localhost","root","","bisocial",3306);

//Constatnts
define("ROOT", "http://localhost/bisocial-tecweb/");
define("ASSETS", ROOT."assets/");
define("IMG", ASSETS."img/");
define("PROPIC", IMG."propic/");
define("COVER", IMG."cover/");
define("CSS", ASSETS."css/");
define("JS", ASSETS."js/");

function goBack() {
    echo '<script>';
    echo 'history.go(-1);';
    echo '</script>';
}

function alertBoxGoBack($message) {
    echo '<script>';
    echo 'alert("'.$message.'");';
    echo 'history.go(-1);';
    echo '</script>';
}

function alertBoxRedirect($message, $page) {
    echo '<script>';
    echo 'alert("'.$message.'");';
    echo 'window.location.href="'.$page.'"';
    echo '</script>';
}

/* Ciao è un commento */
?>

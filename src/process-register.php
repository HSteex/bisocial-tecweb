<?php
require_once "bootstrap.php";
require_once "functions.php";

if(isset($_POST['username'], $_POST['email'], $_POST['p'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['p'];
    $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
    $password = hash('sha512', $password . $random_salt);

    if (empty($dbh->getUserByEmail($email))) {
        if (empty($dbh->getUser($username))) {
            $dbh->addUser($username, $email, $password, $random_salt);
            alertBoxRedirect("Registrazione effettuata", "index.php");
        } else {
            alertBoxGoBack("Username già usato da un altro utente");
        }
    } else {
        alertBoxGoBack("Email già usata da un altro utente");
    }
}
?>
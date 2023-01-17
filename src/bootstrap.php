<?php /*
session_start();*/
require_once "functions.php";
sec_session_start();
require_once "database.php";
$dbh = new DatabaseHelper("localhost","root","","bisocial",3306);

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

function loginCheck() {
    if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        $result = $dbh->getUser($username)[0];
        $login_check = hash('sha512', $result['password'].$user_browser);
        if($login_check == $login_string) {
            return true;
        } else {
            header("Location: login.php");
            return false;
        }
    } else {
        header("Location: login.php");
        return false;
    }
}


/* Ciao è un commento */
?>

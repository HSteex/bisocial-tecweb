<?php
require_once "bootstrap.php";

if(isset($_POST['username'], $_POST['p'])) {
    $result = $dbh->getUser($_POST['username'])[0];
    if (!empty($result)) {
        $password_hashed = hash('sha512', $_POST['p'].$result['salt']);
        if($dbh->checkBrute($result['user_id'])) {
            alertBoxGoBack("Troppi tentativi errati, account disabilitato");
            // DA IMPLEMENTARE
        } else if ($result['password'] == $password_hashed) {
            $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.
            $result['user_id'] = preg_replace("/[^0-9]+/", "", $result['user_id']); // ci proteggiamo da un attacco XSS
            $_SESSION['user_id'] = $result['user_id'];
//           $result['username'] = preg_replace('/[^a-zA-Z0-9_\-]+/', '', $result['username']); // ci proteggiamo da un attacco XSS
            $_SESSION['username'] = $result['username'];
            $_SESSION['login_string'] = hash('sha512', $password_hashed.$user_browser);
            alertBoxRedirect("Accesso effettuato", "index.php");
        } else {
            $now = time();
            $dbh->addAttempt($result['user_id'], $now);
            alertBoxGoBack("Username o password errati");
            }
        } else {
        alertBoxGoBack("Username o password errati");
        }
} else {
    alertBoxGoBack("Username o password errati");
}
?>
<?php

function sec_session_start() {
    $session_name = 'sec_session_id'; // Imposta un nome di sessione
    $secure = false; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
    $httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
    ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
    $cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
    session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
    session_start(); // Avvia la sessione php.
    session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
}

function loginCheck($dbh) {
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

function  getUserImage($user_image){
    if($user_image=="" || $user_image==null){
       return "../assets/img/propic-placeholder.jpg";
    }else{
        if(file_exists("../assets/img/propic/".$user_image)){
            return "../assets/img/propic/".$user_image;
    }
    else{
        return "../assets/img/propic-placeholder.jpg";
    }
    }
}

/*
function login($username, $password) {
    // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.
    if ($result = $dbh->getLoginInfo($username)) {
        $password = hash('sha512', $password.$result["salt"]); // codifica la password usando una chiave univoca.
            // verifichiamo che non sia disabilitato in seguito all'esecuzione di troppi tentativi di accesso errati.
        if($dbh->checkBrute($result['user_id'])) {
                // Account disabilitato
                // Invia un e-mail all'utente avvisandolo che il suo account è stato disabilitato.
                return false;
            } else {
                if($result['db_password'] == $password) { // Verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente.
                    // Password corretta!
                    $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.

                    $result['user_id'] = preg_replace("/[^0-9]+/", "", $result['user_id']); // ci proteggiamo da un attacco XSS
                    $_SESSION['user_id'] = $result['user_id'];
                    $result['username'] = preg_replace('/[^a-zA-Z0-9_\-]+/', '', $result['username']); // ci proteggiamo da un attacco XSS
                    $_SESSION['username'] = $result['username'];
                    $_SESSION['login_string'] = hash('sha512', $password.$user_browser);
                    // Login eseguito con successo.
                    return true;
                } else {
                    // Password incorretta.
                    // Registriamo il tentativo fallito nel database.
                    $now = time();
                    $dbh->addAttempt($result['user_id'], $now);
                    return false;
                }
            }
        } else {
        // L'utente inserito non esiste.
        return false;
    }
}

function login_check($mysqli) {
    // Verifica che tutte le variabili di sessione siano impostate correttamente
    if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
        $user_browser = $_SERVER['HTTP_USER_AGENT']; // reperisce la stringa 'user-agent' dell'utente.
        if ($result = $dbh->getPassword($user_id)) {
            $login_check = hash('sha512', $result['password'].$user_browser);
            if($login_check == $login_string) {
                // Login eseguito!!!!
                return true;
            } else {
                //  Login non eseguito
                return false;
            }
        } else {
            // Login non eseguito
            return false;
        }
    } else {
        // Login non eseguito
        return false;
    }
}*/

?>
<?php
$userInfo = $dbh->getUserInfo($_SESSION['user_id'])[0];
$GLOBALS['updateResponse'] = 0;
$updateMessage = "Profilo modificato correttamente";
if (isset($_POST['updateProfile']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    updateProfile();
}

function updateProfile()
{
    global $userInfo, $dbh, $updateMessage, $fileName;
    $email = !empty($_POST['email']) ? $_POST['email'] : $userInfo['email'];
    $nome = !empty($_POST['nome']) ? $_POST['nome'] : (!empty($userInfo['nome']) ? $userInfo['nome'] : NULL);
    $cognome = !empty($_POST['cognome']) ? $_POST['cognome'] : (!empty($userInfo['cognome']) ? $userInfo['cognome'] : NULL);
    $bio = !empty($_POST['bio']) ? $_POST['bio'] : (!empty($userInfo['bio']) ? $userInfo['bio'] : NULL);
    $image = !empty($fileName) ? $fileName : (!empty($userInfo['user_image']) ? $userInfo['user_image'] : NULL);

    if (!empty($_POST['password'])) {
        if (!empty($_POST['confirmpass'])) {
            if ($_POST['password'] == $_POST['confirmpass']) {
                $salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
                $password = hash('sha512', $_POST['password'] . $salt);
                $dbh->updateProfile($_SESSION['user_id'], $email, $password, $salt, $nome, $cognome, $bio, $image);
            } else {
                $GLOBALS['updateResponse'] = 1;       //password diverse
                $updateMessage = "Le due password non sono uguali";
            }
        } else {
            $GLOBALS['updateResponse'] = 1;           //password di conferma non inserita
            $updateMessage = "La password di conferma non è stata inserita";
        }
    } else {

        $password = $userInfo['password'];
        $salt = $userInfo['salt'];
        $dbh->updateProfile($_SESSION['user_id'], $email, $password, $salt, $nome, $cognome, $bio, $image);
    }
}
?>

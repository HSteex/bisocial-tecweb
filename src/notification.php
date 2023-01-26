<?php
    $notify=$dbh->showNotify($_SESSION['user_id']);
    foreach($notify as $n){
    echo '<ul>'.$n['username'].'ha appena commentato un tuo post.</ul>';
    }
?>
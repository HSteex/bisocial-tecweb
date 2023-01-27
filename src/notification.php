<?php
    $notify=$dbh->showNotify($_SESSION['user_id']);
    foreach($notify as $n){

    echo '<ul><span></span><span class="notif-name">'.$n['username'].'</span> ha appena commentato un tuo post.</ul>';
    
}
?>

<?php
    $notify=$dbh->showNotify($_SESSION['user_id']);
    foreach($notify as $n){
    $nUserImage=getUserImage($n['user_image']);
    echo '
    
    <li>
    <div onclick="deleteNotification('.$n["notif_id"].',`'.$n["href"].'`)" class="custom-row">
            
            <div class="profilepicture propicfollower margin-auto">
            <img class="profilepicture" src="'.$nUserImage.'">
        </div>

    <div class="comment">
       <p> <b>'.$n['username'].'</b> '.$n['content'].'</p>
    </div>
    
</div>
<hr class="rounded">
</li>';
    }
?>
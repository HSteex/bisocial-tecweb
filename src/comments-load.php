<?php
require("bootstrap.php");
$post_id=$_POST['post_id'];
$comments = $dbh->getComments($post_id);
$path = "../assets/img/";
$html = '';
foreach ($comments as $comment) {
    $user_image = getUserImage($comment['user_image']);
    $html .= '<div class="custom-row">
    <div class="profilepicture propicfollower margin-auto">
        <img class="profilepicture" src="'.$user_image.'">
    </div>
    
        <div class="comment">
            <a href="personal.php?username='.$comment['username'].'"><b class="vertical-text">'.$comment['username'].'</b></a>
            <p>'.$comment['content'].'</p>
        </div>
    
    </div>';
}
echo $html;
?>
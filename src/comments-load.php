<?php
require("bootstrap.php");
$post_id=$_POST['post_id'];
$comments = $dbh->getComments($post_id);
$path = "../assets/img/propic/";
$html = '';
foreach ($comments as $comment) {
    $user_image = file_exists($path . $comment['user_image']) ? $path . $comment['user_image'] : $path . "propic-placeholder.jpg";
    $html .= '<div class="custom-row">
    <div class="profilepicture propicfollower">
        <img src="../assets/img/' . $user_image . '">
    </div>
    <div style="display: flex; justify-content: left;">
        <div>
            <a href="personal.php?username='.$comment['username'].'"><b class="vertical-text">'.$comment['username'].'</b></a>
            <p><br>'.$comment['content'].'</p>
        </div>
    </div>
    </div>';
}
echo $html;
?>
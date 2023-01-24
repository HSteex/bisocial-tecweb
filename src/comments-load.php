<?php
require("bootstrap.php");
$post_id=$_POST['post_id'];
$comments = $dbh->getComments($post_id);
$html = '';
foreach ($comments as $comment) {
    $html .= '<div class="custom-row">
    
        <div class="profilepicture propicfollower">
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
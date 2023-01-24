<?php
    include "bootstrap.php";

if(isset($_POST['like'])){
    if($dbh->isLiked($_SESSION['user_id'], $_POST['post_id'])){
        $isLiked=true;
    }else{
        $isLiked=false;
    }
    $dbh->toggleLike($_SESSION['user_id'], $_POST['post_id'], $isLiked);
    $likes=$dbh->getLikesCount($_POST['post_id']);
    echo json_encode(array("status"=>$isLiked? "liked" : "unliked", "likes"=>$likes));
}

?>
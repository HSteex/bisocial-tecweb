<?php
    include "bootstrap.php";

if(isset($_POST['like'])){
    if($dbh->isLiked($_SESSION['user_id'], $_POST['user_id'])){
        $isLiked=true;
    }else{
        $isLiked=false;
    }
    $dbh->tooggleLike($_SESSION['user_id'], $_POST['user_id'], $isLiked);
    $likes=$dbh->getLikesCount($_POST['user_id']);
    echo json_encode(array("status"=>$isLiked? "liked" : "unliked", "likes"=>$likes));
}

?>
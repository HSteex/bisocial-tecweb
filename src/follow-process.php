<?php
    include "bootstrap.php";



    $isFollowing=$_POST['isFollowing'];
    if($isFollowing){
        $dbh->unfollow($_SESSION['user_id'], $_POST['user_id']);
        $isFollowing=false;
        echo json_encode(array("status"=>"unfollowed"));
    }else{
        $dbh->follow($_SESSION['user_id'], $_POST['user_id']);
        $isFollowing=true;
        echo json_encode(array("status"=>"followed"));
    
    }

?>
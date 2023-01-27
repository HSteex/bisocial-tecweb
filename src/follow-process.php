<?php
    include "bootstrap.php";



if(isset($_POST['like'])){
    
}



if(isset($_POST['follow'])){
    if($dbh->isFollowing($_SESSION['user_id'], $_POST['user_id'])){
        $isFollowing=true;
    }else{
        $isFollowing=false;
    }
    if($isFollowing){
        $dbh->unfollow($_SESSION['user_id'], $_POST['user_id']);
        $isFollowing=false;
        $followers=$dbh->getFollowersCount($_POST['user_id'])["followers"];
        echo json_encode(array("status"=>"unfollowed", "followers"=>$followers));
    }else{
        $dbh->follow($_SESSION['user_id'], $_POST['user_id']);
        $dbh->saveNotify($_SESSION["user_id"], $_POST['user_id'],"ti sta seguendo", "http://localhost/bisocial-tecweb/src/personal.php?username=".$_SESSION["username"]);
        $isFollowing=true;
        $followers=$dbh->getFollowersCount($_POST['user_id'])["followers"];
        echo json_encode(array("status"=>"followed", "followers"=>$followers));
        
    }
}
?>
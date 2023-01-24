<?php

$followersList=$dbh->getFollowers($user['user_id']);
$followingList=$dbh->getFollowing($user['user_id']);


function generateFollower($user){
    $propic = "../assets/img/propic/".$user['username'].'.jpg';
    if(file_exists($propic)){
      
    }else{
        $propic = IMG.'propic-placeholder.jpg';
    }

    $html = '<div class="custom-row">
    
        <div class="profilepicture propicfollower ">
        <img class="profilepicture" src="'.$propic.'" alt="follower-image">
    </div>
    <div>
        <div class="follower-username">
            <a href="personal.php?username='.$user['username'].'"><p class="vertical-text">'.$user['username'].'</p>  </a>
        </div>
    </div>
    </div>';

    return $html;

}

?>
    

    <div class="floating-div" id="floating-followers">
        
        <div class="floating-div-content" id="follower-content" style="padding-top: 12px;">
        <div class="follower-title">
        <div class="close-icon"><button class="btn-close"  onclick="followersOverlayOff()"> 
        </div>  
        <div class="center" style="margin:8px;">
                <b>Followers</b>
            </div>
        </div>
        
            
            
            <?php 
            for ($i=0; $i < count($followersList); $i++) { 
                echo generateFollower($followersList[$i]);
            } 
            ?> 
            
          


        </div>
    </div>

    <div class="floating-div" id="floating-following">
        
        <div class="floating-div-content" id="follower-content" style="padding-top: 12px;">
        <div class="follower-title">
        <div class="close-icon"><button class="btn-close"  onclick="followingOverlayOff()"> 
        </div>  
        <div class="center" style="margin:8px;">
                <b>Following</b>
            </div>
        </div>
        
            
            
            <?php 
            for ($i=0; $i < count($followingList); $i++) { 
                echo generateFollower($followingList[$i]);
            } 
            ?> 
            
          


        </div>
    </div>

    
<?php


//Check if user is logged in
if(!isset   ($_SESSION['username'])){
    header("Location: login.php");
}

//Check if username is set
if(isset($_GET['username'])){
    $username = $_GET['username'];
    //Get user data from database
    $user = $dbh->getUserDetail($username);
   
    //If user is not found, alert box and redirect to index.php
    if(empty($user)){
        alertBoxRedirect("Utente non trovato", "index.php");
    }
    $user=$user[0];
}else{
    header("Location: index.php");
}

//Get followers count
$followers=$dbh->getFollowersCount($user['user_id']);

//Check if user is profile owner
if($user['username']==$_SESSION['username']){
    $isOwner=true;
}else{
    $isOwner=false;
}

//Check if user is following profile owner
$isFollowing=$dbh->isFollowing($_SESSION['user_id'], $user['user_id']);

if(isset($_POST['unfollow'])) {
    $dbh->unfollow($_SESSION['user_id'], $user['user_id']);
    $isFollowing=false;
}
if(isset($_POST['follow'])) {
    $dbh->follow($_SESSION['user_id'], $user['user_id']);
        $isFollowing=true;
}
?>


<!------------------------ HTML ------------------------>
        <script src=../assets/js/forms.js></script>
        <?php
        //Print menu bar if user is profile owner
        if($isOwner){
            
        }
        require 'follower.php';
        ?>
        <div class="profilepicture center margin">
            <img class="profilepicture" <?php
            //Print user cover image if set else print default image
            if(file_exists('../assets/img/propic/'.$user['user_image'])){
                echo 'src="../assets/img/propic/'.$user["user_image"].'"';
            }else{
                echo 'src="../assets/img/propic-placeholder.jpg"';
            }

            ?> alt="Foto profilo">
        </div>

        <div class="name center">
            <!-- Print name and surname if set else print username-->
            <h1>
            <?php
            if((isset($user['nome']) && $user['nome']!="") || (isset($user['cognome']) && $user['cognome']!="")){
                echo $user['nome'] . " " . $user['cognome'];
                $nameSet=true;
            }else{
                echo "@".$user['username'];
                $nameSet=false;
            }
            ?>
            </h1>
            <i>
                <?php  
                //Print username
                if($nameSet){
                    echo "@".$user['username'];
                }
                ?>
            </i>
            
        </div>

        <div class="center">
        <button class="btn btn-primary updateProfile center" onclick="window.location.href='profile.php';" type="submit" name="updateProfile" value="updateProfile">Update Profile</button>
        </div>

        <div class="row follower-count margin">
            <div class="col-6">
                <div class="center">
                    <p onclick="followersOverlayOn()">Followers: <b id="followers"><?php echo $followers["followers"] ?></b><p>
                </div>
            </div>
            <div class="col-6">
                <div class="center">
                    <p onclick="followingOverlayOn()">Following: <b><?php echo $followers["following"] ?></b></p>
                </div>
            </div>
        </div>
        <?php 
        //if user is not profile owner, print follow/unfollow button
        if(!$isOwner){
            echo '<button class="btn btn-primary followButton center '.($isFollowing? "unfollow" : "follow" ).' type="button" onclick="toggleFollow(1,'.$user['user_id'].')" id="follow-button" name="follow-button" value="1">'.($isFollowing ? "Unfollow" : "Follow" ).'</button>';
        }
        ?>
        
        
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        
        
        <div class="center underline">
            <b>Post</b>
        </div>
        <?php
        $postType=1;
        require("post-load.php");
        ?>

        <!-- TEST LIKE BUTTON -->
        <div>
        <object style="fill: white" type="image/svg+xml" data="../assets/like-icon.svg"></object>
        </div>
        <script src="../assets/js/ajax-functions.js"></script>
        
    <!-- </body>

</html> -->

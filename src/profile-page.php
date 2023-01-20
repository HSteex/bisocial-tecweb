<?php


//Check if user is logged in
if(!isset($_SESSION['username'])){
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
if($dbh->isFollowing($_SESSION['user_id'], $user['user_id'])){
    $isFollowing=true;
}else{
    $isFollowing=false;
}
// if(isset($_POST['follow'])){
//     if($isFollowing){
//         $dbh->unfollow($_SESSION['user_id'], $user['user_id']);
//         $isFollowing=false;
//     }else{
//         $dbh->follow($_SESSION['user_id'],  $user['user_id']);
//         $isFollowing=true;
    
//     }

// }

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
<!-- <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title><?php echo 'Pagina di '.$user['username']  ?> </title>
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    </head>
    
    <body> -->
        <?php
        //Print menu bar if user is profile owner
        if($isOwner){
            ;
        }
        ?>
        <div class="profilepicture center margin">
            <img class="propilepicture" <?php
            //Print user cover image if set else print default image
            if(file_exists('../assets/img/propic/'.$user['username'].'.jpg')){
                echo 'src="../assets/img/propic/'.$user['username'].'.jpg"';
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
        <div class="row follower-count margin">
            <div class="col">
                <div class="center">
                    <p>Followers: <b><?php echo $followers["followers"] ?></b><p>
                </div>
            </div>
            <div class="col">
                <div class="center">
                    <p>Following: <b><?php echo $followers["following"] ?></b></p>
                </div>
            </div>
        </div>
        
        <?php 
        //if user is not profile owner, print follow/unfollow button
        if(!$isOwner){
            if($isFollowing){
                echo '<button class="btn btn-primary followButton center unfollow" type="submit" name="unfollow" value="unfollow">Unfollow</button>';
            }else{
                echo '<button class="btn btn-primary followButton center follow" type="submit" name="follow" value="follow">Follow</button>';
            }
        }
        ?>
        <button class="btn btn-primary followButton center follow" type="button" onclick="toggleFollow(1)" id="follow-button" name="follow-button" value="1">Follow</button>
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <script>

            function toggleFollow($followFlag){
                //Use ajax to follow/unfollow
                $.ajax({
                    type: "POST",
                    url: "follow-process.php",
                    data: {follow: $followFlag,isFollowing: <?php if($dbh->isFollowing($_SESSION['user_id'], $user['user_id'])){echo 1;}else{echo 0;} ?>, user_id: <?php echo $user['user_id'] ?>},
                    success: function(data){
                        console.log(data.status);
                        //If follow is successful, change follow-button button text
                        if(data.status=="followed"){
                            $("#follow-button").text("Unfollow");
                           
                        }else{
                            $("#follow-button").text("Follow");}
                    }
                });
            }
            
        </script>
                
        <div class="btn-group post_media" role="group"><button class="btn line" type="button">Post</button><button class="btn" type="button">Media</button></div>
        
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- </body>

</html> -->

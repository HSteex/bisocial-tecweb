<?php
include 'database.php';
include 'functions.php';
include 'bootstrap.php';

//$local_username=$_SESSION['username'];
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

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
    //Return to home page
    header("Location: index.php");

}

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

if(isset($_POST['follow'])){
    if($isFollowing){
        $dbh->unfollow($_SESSION['user_id'], $user['follow']);
        $isFollowing=false;
    }else{
        $dbh->follow($_SESSION['user_id'], $user['follow']);
        $isFollowing=true;
    }
}







?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo 'Pagina di '.$user['username']  ?> </title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/profilepage.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>
<body>
<div class="coverimage"><img class="coverimage" <?php
//Print user cover image if set else print default image
if(file_exists('../assets/img/cover/'.$user['username'].'.jpg')){
    echo 'src="../assets/img/cover/'.$user['username'].'.jpg"';
}else{
    echo 'src="../assets/img/back-image-placeholder.jpg"';
}

?> ></div>
    <div class="profilepicture"><img class="profilepicture" <?php
//Print user cover image if set else print default image
if(file_exists('../assets/img/propic/'.$user['username'].'.jpg')){
    echo 'src="../assets/img/propic/'.$user['username'].'.jpg"';
}else{
    echo 'src="../assets/img/propic-placeholder.jpg"';
}

?> alt="Foto profilo"></div>
    <div class="name">
        <!-- Print name and surname if set else print username-->
        <h1>
        <?php
        if((isset($user['nome']) && $user['nome']!="") || (isset($user['cognome']) && $user['cognome']!="")){
            echo $user['nome'] . " " . $user['cognome'];
            $nameSet=true;
        }else{
            echo "@".$user['username'];

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
    
    <div class="follow">
    <button id="follow" class="btn btn-primary" type="button" >Cacca</button>
    <div class="btn-group post_media" role="group"><button class="btn line" type="button">Post</button><button class="btn" type="button">Media</button></div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>

    <script>
    getElementById("follow").addEventListener("click", function(){
        $.ajax({
            url: 'profile.php',
            type: 'post',
            data: { "follow": "1"},
            success: function(response) { console.log(response); }
        });
    });

    </script>
</body>

</html>

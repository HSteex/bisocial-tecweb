<?php
include 'database.php';
include 'functions.php';
include 'bootstrap.php';

//$local_username=$_SESSION['username'];

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

$followers=$dbh->getFollowers($user['user_id']);
PROPIC;


function generateFollower($user){
    if(file_exists(PROPIC.$user['username'].'.jpg')){
        $propic = PROPIC.$user['username'].'.jpg';
    }else{
        $propic = IMG.'propic-placeholder.jpg';
    }

    $html = '<div class="row">
    <div class="col-4 propic follower-image">
        <img class="propic" src="'.$propic.'" alt="follower-image">
    </div>
    <div class="follower-info">
        <div class="col follower-username">
            <a href="profile.php?username='.$user['username'].'">'.$user['username'].'</a>
        </div>
    </div>';
    return $html;

}

?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo 'Follower di '.$user['username'] ?> </title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>
<body>
    <?php for ($i=0; $i < count($followers); $i++) { 
        echo generateFollower($followers[$i]);
    } ?>
    <!-- Template for follower-->
    <div class="row">
        <div class="column propic follower-image">
            <img class="propic" src="../assets/img/propic-placeholder.jpg" alt="follower-image">
        </div>
        <div class=" column follower-info">
            <div class="follower-username">
                <a href="profile.php?username=utente">utente</a>
            </div>
        </div>
</body>
</html>

    
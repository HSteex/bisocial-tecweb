<!--<?php
if(($_FILES['user_image']['size'] != 0)) {
    require("image-upload.php");
}
if(!empty($_POST['email']) || !empty($_POST['nome']) ||
    !empty($_POST['cognome']) || !empty($_POST['password']) ||
    !empty($_POST['confirmpass']) || !empty($_POST['bio']) ||
    isset($GLOBALS['uploadResponse'])) {
    require("profile-update.php");
}
$userImage = $dbh->getImage($_SESSION['user_id'])[0];
?>-->
<div id="overlay">
    <div class="container profile profile-view" id="post-form">
        <div class="row">
            <div class="col-md-12 alert-col relative">
                <div style="display: none; background-color: lightcoral" class="alert" role="alert"><button style="float: right" data-bs-dismiss="alert" aria-label="Chiudi" type="button" class="btn-close"></button><span id="upload-message"></span></div>
            </div>
        </div>
        <form method="post" class="profile" name="profile-form" enctype="multipart/form-data">
            <div class="row profile-row post-form" style="margin:20px 0px">
                <input class="post-form-label" type="file" name="image" style="font-family: 'Roboto Condensed', sans-serif;">
            </div>
            <div class="row profile-row post-form">
                <label class="post-form-label" style="font-family: 'Roboto Condensed', sans-serif;">Descrizione</label><input class="form-control" type="text" name="description" autocomplete="off">
            </div>
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script>
                function uploadPost($post_image,$description){
                    //Use ajax to follow/unfollow
                    $.ajax({
                        type: "POST",
                        url: "post-upload.php",
                        data: {post_image: $post_image, description: $description},
                        success: function(data){
                            $dataArray=JSON.parse(data);
                            //If follow is successful, change follow-button button text
                            if($dataArray["response"]){
                                $("#upload-message").text($dataArray["message"]);
                                $("#upload-message").style.display("block");
                            } else {
                                postOverlayOff();
                            }
                        }
                    });
                }
            </script>
            <div class="row">
                <div class="col-md-12 content-right"><button class="btn btn-primary form-btn" name="updateProfile" value="updateProfile" onclick="uploadPost(this.form.image, this.form.description)" type="submit" style="font-family: 'Roboto Condensed', sans-serif;padding-right: 22px;padding-left: 22px;padding-bottom: 8px;padding-top: 8px;">POST </button><button class="btn btn-danger form-btn" onclick="postOverlayOff()" type="reset" style="font-family: 'Roboto Condensed', sans-serif;padding-right: 22px;padding-left: 22px;padding-bottom: 8px;padding-top: 8px;">CANCEL </button></div>
            </div>
        </form>
    </div>
</div>

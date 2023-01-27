<?php
if(isset($_FILES['post_image']['size'])) {
    require("image-upload.php");
}
?>
<div id="overlay">
    <div class="container profile profile-view" style="margin:0px 10px 0px 10px;" id="post-form">
        <form method="post" class="profile" name="profile-form" enctype="multipart/form-data">
            <div class="row profile-row post-form" style="margin:20px 0px">
                <input class="post-form-label" type="file" name="post_image">
            </div>
            <div class="row profile-row post-form">
                <label class="post-form-label">Descrizione</label>
                <input class="form-control" id="description" type="text" name="description" autocomplete="off">
            </div>
            <div class="row">
                <div class="col-md-12 content-right">
                    <button class="btn btn-primary btn-post" type="submit">POST</button>
                    <button class="btn btn-primary btn-cancel" onclick="postOverlayOff()" type="reset">CANCEL</button>
                </div>
            </div>
        </form>
    </div>
</div>

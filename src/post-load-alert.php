<?php
if(($_FILES['image']['size'] != 0) || !empty($_POST['description'])) {
    require("post-upload.php");
}

if (isset($GLOBALS['uploadResponse'])) {
    if (!$GLOBALS['uploadResponse']) {
        echo '<div class="col-md-12 alert-col relative">
                        <div id="profile-edit" style="display: block; background-color: lightgreen" class="alert" role="alert"><button style="float: right" data-bs-dismiss="alert" aria-label="Chiudi" type="button" class="btn-close"></button><span id="profile-edit-message">' . $uploadMessage . '</span></div>
                    </div>';
    } else {
        echo '<div class="col-md-12 alert-col relative">
                        <div id="profile-edit" style="display: block; background-color: lightcoral" class="alert" role="alert"><button style="float: right" data-bs-dismiss="alert" aria-label="Chiudi" type="button" class="btn-close"></button><span id="profile-edit-message">' . $uploadMessage . '</span></div>
                    </div>';
    }
    unset($GLOBALS['uploadResponse']);
}
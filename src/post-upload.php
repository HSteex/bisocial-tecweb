<?php
if (!empty($_FILES['post_image'])) {
    $uploadType = 1;
    if (!empty($_POST['description'])) {
        require("image-upload.php");
        if (!$GLOBALS['uploadResponse']) {
            $dbh->addPost($_SESSION['user_id'], $_POST['description'], date('Y-m-d H:i:s', time()), $fileName);
        }
        //echo json_encode(array("response"=>$GLOBALS['uploadResponse'], "message"=>$uploadMessage));
    } else {
        require("image-upload.php");
        if (!$GLOBALS['uploadResponse']) {
            $dbh->addPost($_SESSION['user_id'], NULL, date('Y-m-d H:i:s', time()), $fileName);
        }
        //echo json_encode(array("response"=>$GLOBALS['uploadResponse'], "message"=>$uploadMessage));
    }
} else if (!empty($_POST['description'])) {
    $dbh->addPost($_SESSION['user_id'], $_POST['description'], date('Y-m-d H:i:s', time()), NULL);
    //echo json_encode(array("response"=>$GLOBALS['uploadResponse'], "message"=>$uploadMessage));
}
//echo json_encode(array("response"=>$GLOBALS['uploadResponse'], "message"=>$uploadMessage));
?>

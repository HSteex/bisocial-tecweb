<?php
$userInfo = $dbh->getUserInfo($_SESSION['user_id'])[0];
$GLOBALS['uploadResponse'] = 0;
$uploadMessage = "ok";
if (!empty($_POST['image'])) {
    $uploadType = 1;
    if (!empty($_POST['description'])) {
        require("image-upload.php");
        if (!$GLOBALS['uploadResponse']) {
            $dbh->addPost($_SESSION['user_id'], $_POST['description'], time(), $fileName);
        }
        echo json_encode(array("response"=>$GLOBALS['uploadResponse'], "message"=>$uploadMessage));
    } else {
        require("image-upload.php");
        if (!$GLOBALS['uploadResponse']) {
            $dbh->addPost($_SESSION['user_id'], NULL, time(), $fileName);
        }
        echo json_encode(array("response"=>$GLOBALS['uploadResponse'], "message"=>$uploadMessage));
    }
} else if (!empty($_POST['description'])) {
    $dbh->addPost($_SESSION['user_id'], $_POST['description'], time(), NULL);
    echo json_encode(array("response"=>$GLOBALS['uploadResponse'], "message"=>$uploadMessage));
}
echo json_encode(array("response"=>$GLOBALS['uploadResponse'], "message"=>$uploadMessage));
?>

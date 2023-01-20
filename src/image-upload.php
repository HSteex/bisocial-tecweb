<?php
//uploadType = 0 se carico immagine profilo 1 se carico immagine post;
if ($uploadType){
    $target_dir = "../assets/img/posts/";
    $imageFileType = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));
    $lastPost = $dbh->getLastPostID();
    if (!empty($lastPost)) { $lastPost = 1; }
    else { $lastPost++; }
    $fileName = $lastPost . '.' . $imageFileType;
    $target_file = $target_dir . $fileName;
} else {
    $target_dir = "../assets/img/propic/";
    $imageFileType = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));
    $fileName = $_SESSION['username'] . '.' . $imageFileType;
    $target_file = $target_dir . $fileName;
    $oldImage = $dbh->getImage($_SESSION['user_id'])[0];
    //Destroy the file if already exists
    if ($oldImage['user_image'] != NULL) {
        unlink($target_dir . $oldImage['user_image']);
    }
}
$GLOBALS['uploadResponse'] = 0;
$uploadMessage = "ok";

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["user_image"]["tmp_name"]);
if($check !== false) {
    $uploadMessage = "Il file è un'immagine - " . $check["mime"];
    $GLOBALS['uploadResponse'] = 0;
} else {
    $uploadMessage = "Il file non è un'immagine";
    $GLOBALS['uploadResponse'] = 1;
}

// Check file size
if ($_FILES["user_image"]["size"] > 500000) {
    $uploadMessage =  "Mi dispiace, la tua immagine è troppo grande";
    $GLOBALS['uploadResponse'] = 1;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    $uploadMessage =  "Mi dispiace, solo file JPG, JPEG, PNG & GIF sono consentiti";
    $GLOBALS['uploadResponse'] = 1;
}

// Check if $GLOBALS['uploadResponse'] is set to 0 by an error
if ($GLOBALS['uploadResponse'] == 0) {
    if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
        $uploadMessage =  "L'immagine è stata caricata";
    } else {
        $GLOBALS['uploadResponse'] = 1;
        $uploadMessage =  "Mi dispiace, c'è stato un errore nel caricamento dell'immagine";
    }
}
?>

<?php
$target_dir = "/opt/lampp/htdocs/bisocial-tecweb/assets/img/propic/";
$imageFileType = strtolower(pathinfo(basename($_FILES["user_image"]["name"]),PATHINFO_EXTENSION));
$target_file = $target_dir . $_SESSION['username'] . '.' . $imageFileType;
$fileName = $_SESSION['username'] . $imageFileType;          //Usato in profile-update.php per il db
$GLOBALS['uploadResponse'] = 0;
$uploadMessage = "ok";

// Check if image file is a actual image or fake image
if(isset($_POST["updateProfile"])) {
    $check = getimagesize($_FILES["user_image"]["tmp_name"]);
    if($check !== false) {
        $uploadMessage = "Il file è un'immagine - " . $check["mime"];
        $GLOBALS['uploadResponse'] = 0;
    } else {
        $uploadMessage = "Il file non è un'immagine";
        $GLOBALS['uploadResponse'] = 1;
    }
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
//Destroy the file if already exists
if (file_exists($target_file)) {
    unlink($target_file);
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

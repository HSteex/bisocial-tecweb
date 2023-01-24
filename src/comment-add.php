<?php
require("bootstrap.php");
if (!empty($_POST['content'])) {
    $dbh->addComment($_POST['post_id'], $_POST['user_id'], $_POST['content']);
}

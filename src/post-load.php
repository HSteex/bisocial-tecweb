<?php
#Following posts and creator details
if ($postType==0){
    $posts=$dbh->getPostsOfFollowing($_SESSION['user_id']);
} else if($postType==1){
#Following posts and creator details
    $posts=$dbh->getPostsOfPersonal($user['user_id']);
#Single post
}else if($postType==2){
    $posts=$dbh->getSinglePost($_GET["post_id"]);
}

if (sizeof($posts) != 0) {
    foreach ($posts as $post) {
        //$postPropic="assets/img/profile_pictures/".$post['profile_picture'];
        $postPropic = getUserImage($post['user_image']);
        $nameToShow;
        if($post['nome']!="" && $post['cognome']!=""){
            $nameToShow=$post['nome'] . " " . $post['cognome'];
        }else{
            $nameToShow="@".$post['username'];
        }
        if(!file_exists($postPropic)){
            $postPropic= '../assets/img/propic-placeholder.jpg';
        }
        $isLiked = $dbh->isLiked($_SESSION["user_id"], $post["post_id"]) ? "liked" : "unliked ";

        echo '<div class="container center" style="margin: 5px auto;">
        <div class="col mb-5" style="max-width: 540px;border-radius: 15px;border: 4px solid #662c94;margin: 20px auto">
        <div class="card shadow-sm" style="background: rgb(45,44,56);">
            <div class="card-body px-4 py-5 px-md-5" style="border-radius: 4px;background: rgb(45,44,56);">
                <div class="row">
                    <div class="col post-column" style="">
                        <h5 class="fw-bold">' . $nameToShow . '</h5><div></div>
                        <a href="http://localhost/bisocial-tecweb/src/personal.php?username=' . $post['username'] . '">
                        <div class="profilepicture" style="width: 50px; height:50px">
                        <img class="profilepicture" src="'.$postPropic.'"></div></a>
                    </div>
                </div>
                <div class="center">
                    <img class="rounded img-fluid w-100 fit-cover" src="../assets/img/posts/' . $post['post_image'] . '" style="max-width: 250px;max-height: 250px;margin:10px auto">
                    <li style="list-style-type: none;">
                        <p class="text-muted card-text mb-4" style="font-family: "Roboto Flex", sans-serif;">' . $post['description'] . '</p>
                    </li>
                    </div>
                    <div class="center">
                    <b id="likes-count-'.$post['post_id'].'">'.$dbh->getLikesCount($post['post_id']).'</b>
                    <button class="btn btn-primary shadow '.$isLiked.'" id="like-button-'.$post["post_id"].'" type="button" onclick="toggleLike('.$post['post_id'].')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-hand-thumbs-up-fill" style="width: 18px;height: 18px;">
                            <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"></path>
                        </svg>
                    </button>
                    <button type="submit" onclick="loadComments('.$post["post_id"].')" class="btn btn-primary shadow bi bi-hand-thumbs-up" type="button" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-chat-dots-fill" style="width: 18px;height: 18px;">
                            <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"></path>
                        </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>';
    }
} else {
    echo '<div class="center "><a>Non hai nessun post da vedere</a></div>';
}
echo '<div class="floating-div" id="floating-comments">
        <div class="floating-div-content" id="follower-content" style="padding-top: 12px;">
            <div class="follower-title">
                <div class="close-icon"><button class="btn-close"  onclick="closeComments()"> 
                </div>  
                <div class="center" style="margin:8px;">
                    <b>Commenti</b>
                </div>
            </div>
            <div id="comments-container">
        
            </div>
            <div class="floating-form higher">
           
                <span style="width:70%">
                    <input type="text" name="comment" id="comment-content">
                </span>
                <span style="width:30%"><button type="submit" class="fas fa-arrow-alt-circle-up" name="btn-comment" id="comment-btn" ></button>
                <script>
                var btn = document.getElementById("comment-content");
                btn.addEventListener("keypress", function(event) {
                    if (event.key === "Enter") {
                        event.preventDefault();
                        document.getElementById("comment-btn").click();
                    }
                });
                </script>
                </span>
            
            </div>
        </div>
    </div>';
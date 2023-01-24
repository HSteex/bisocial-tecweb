<?php
#Following posts and creator details
if($postType==0){
    $posts=$dbh->getPostsOfFollowing($_SESSION['user_id']);
}else if($postType==1){
#Following posts and creator details
    $posts=$dbh->getPostsOfPersonal($_SESSION['user_id']);
}else{
    echo "Impossibile caricare i posts. Errore.";
}

    foreach($posts as $post) {
        echo '<div class="container center" style="margin: 5px auto;">
        <div class="col mb-5" style="max-width: 540px;border-radius: 15px;border: 4px solid #662c94;margin: 20px auto">
        <div class="card shadow-sm" style="background: rgb(45,44,56);">
            <div class="card-body px-4 py-5 px-md-5" style="border-radius: 4px;background: rgb(45,44,56);">
                <div class="row">
                    <div class="col" style="width: 20%;display: inline-flex;position: relative;align-items: right;justify-content: right;vertical-align: middle !important;">
                        <h5 class="fw-bold" style="text-align: right;font-size: 18px;width: 160px;align-items: right !important;justify-content: right !important;margin:5px 0px;position: relative;transform: translate(0px);margin-top: 24px;font-family: "Roboto Condensed", sans-serif;">'.$post['nome']." ".$post['cognome'].'</h5><div></div>
                        <a href="http://localhost/bisocial-tecweb/src/personal.php?username='.$post['username'].'"><img class="profilepicture rounded img-fluid shadow w-100 fit-cover" src="../assets/img/propic/'.$post['user_image'].'" style="max-width: 50px;max-height: 50px;margin:5px"></a>
                    </div>
                </div>
                <div class="center">
                <img class="rounded img-fluid shadow w-100 fit-cover" src="../assets/img/posts/'.$post['post_image'].'" style="max-width: 250px;max-height: 250px;margin:10px auto">
                <li style="list-style-type: none;"><p class="text-muted card-text mb-4" style="font-family: "Roboto Flex", sans-serif;">'.$post['description'].'</p></li>
                    </div>
                    <div class="center">
                    <button class="btn btn-primary shadow" type="button" style="width: 42px;height: 42px;padding: 0px;background: #662c94;margin-left: 5px;border-color: #662c94;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-hand-thumbs-up-fill" style="width: 18px;height: 18px;">
                        <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"></path>
                    </svg></button><button class="btn btn-primary shadow" type="button" style="width: 42px;height: 42px;padding: 0px;background: #662c94;margin-left: 5px;border-color: #662c94;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-chat-dots-fill" style="width: 18px;height: 18px;">
                        <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"></path>
                    </svg></button><button class="btn btn-primary shadow" type="button" style="width: 42px;height: 42px;padding: 0px;background: #662c94;margin-left: 5px;border-color: #662c94;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-shift-fill" style="width: 18px;height: 18px;font-size: 939px;">
                        <path d="M7.27 2.047a1 1 0 0 1 1.46 0l6.345 6.77c.6.638.146 1.683-.73 1.683H11.5v3a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1v-3H1.654C.78 10.5.326 9.455.924 8.816L7.27 2.047z"></path>
                    </svg></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
';
 } 

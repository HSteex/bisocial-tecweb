//Function to toggle like/unlike
function toggleLike($post_id){
    //Use ajax to like/unlike
    $.ajax({
        type: "POST",
        url: "like-process.php",
        data: {like:1 , post_id: $post_id},
        success: function(data){
            console.log(data);
            //If like is successful, change like-button button text
            if(data=="liked"){
                //TODO
            }
            if(data=="unliked"){
                //TODO
            }
        }
    });
}

//Function to toggle follow/unfollow
function toggleFollow($followFlag,$user_id){
    //Use ajax to follow/unfollow
    $.ajax({
        type: "POST",
        url: "follow-process.php",
        data: {follow: $followFlag, user_id: $user_id},
        success: function(data){
            $dataArray=JSON.parse(data);
            //If follow is successful, change follow-button button text
            if($dataArray["status"]=="followed"){
               
                $("#follow-button").text("Unfollow");
                $("#follow-button").removeClass("follow").addClass("unfollow");
            
            }
            if($dataArray["status"]=="unfollowed"){
                $("#follow-button").text("Follow");
                $("#follow-button").removeClass("unfollow").addClass("follow");
            }
            $("#followers").text($dataArray["followers"]);
        }
    });
}

function loadComments($post_id){
    //Use ajax to follow/unfollow
    $.ajax({
        type: "POST",
        url: "comments-load.php",
        data: {post_id: $post_id},
        success: function(data){
            document.getElementById("comments-container").innerHTML+=(data);
            document.getElementById("floating-comments").style.display="block";
        }
    });
}

function addComment($post_id, $user_id, $content){
    //Use ajax to follow/unfollow
    $.ajax({
        type: "POST",
        url: "comment-add.php",
        data: {post_id: $post_id, user_id: $user_id, content: $content},
        success: function(data){
            document.getElementById("comment-content").value = "";
            document.getElementById("comments-container").innerHTML="";
            loadComments($post_id);
        }
    });
}
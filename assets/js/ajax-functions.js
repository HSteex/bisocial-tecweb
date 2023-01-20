

//Function to toggle like/unlike
function toggleLike($likeFlag,$isLiked,$post_id){
    //Use ajax to like/unlike
    $.ajax({
        type: "POST",
        url: "like-process.php",
        data: {like: $likeFlag, isLiked: $isLiked, post_id: $post_id},
        success: function(data){
            console.log(data);
            //If like is successful, change like-button button text
            if(data=="liked"){
                $("#like-button").text("Unlike");
                $isLiked=1;
            }else{
                $("#like-button").text("Like");
                $isLiked=0;
                
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

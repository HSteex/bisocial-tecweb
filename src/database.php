<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        /*if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }*/
    }

    // Add user to db
    public function addUser($username, $email, $password, $salt) {
        $insert_stmt = $this->db->prepare("INSERT INTO user (username, email, password, salt) VALUES (?, ?, ?, ?)");
        $insert_stmt->bind_param('ssss', $username, $email, $password, $salt);
        $insert_stmt->execute();
    }

    //Get user
    public function getUser($username) {
        $stmt = $this->db->prepare("SELECT user_id, username, password, salt FROM user WHERE username = ? LIMIT 1");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Get user info
    public function getUserInfo($user_id) {
        $stmt = $this->db->prepare("SELECT email, password, salt, nome, cognome, bio, user_image  FROM user WHERE user_id = ? LIMIT 1");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Get user detail
    public function getUserDetail($username){
        $stmt = $this->db->prepare("SELECT user_id, username, nome,cognome ,bio,user_image FROM user WHERE username = ? LIMIT 1");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Get user followers
    public function getFollowers($user_id) {
        $stmt = $this->db->prepare("SELECT u.username, u.user_image, u.nome, u.cognome
        FROM user u
        JOIN follower f 
        ON 	u.user_id=f.source_id AND u.user_id
        WHERE f.target_id =?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Get people that user follow
    public function getFollowing($user_id){
        $stmt=$this->db->prepare("SELECT u.username, u.user_image, u.nome, u.cognome
        FROM user u
        JOIN follower f
        ON 	u.user_id=f.target_id AND u.user_id
        WHERE f.source_id =?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Get user post
    public function getPostsOfPersonal($user_id){
        $stmt = $this->db->prepare("SELECT u.username, u.user_image, u.nome, u.cognome ,p.* 
        from user u 
        join `post` p on u.user_id=p.creator_id 
        where u.user_id =?
        order by p.post_id desc");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Get single post
    public function getSinglePost($post_id){
        $stmt = $this->db->prepare("SELECT u.username, u.user_image, u.nome, u.cognome ,p.* 
        from user u 
        join `post` p on u.user_id=p.creator_id 
        where p.post_id=?");
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Get post of people that user follow
    public function getPostsOfFollowing($user_id){
        $stmt = $this->db->prepare("SELECT u.username, u.user_image, u.nome, u.cognome, p.*
        from follower f 
        join `user` u on f.target_id =user_id 
        join `post` p on  f.target_id=p.creator_id
        where source_id =?
        order by p.post_id desc"
        );
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Check if the user is following another user       
    public function isFollowing($user_id, $target_id) {
        $stmt = $this->db->prepare("SELECT * FROM follower WHERE source_id = ?  AND target_id = ?");
        $stmt->bind_param('ii', $user_id, $target_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    //Save notification details after user trigger (comment)
    public function saveNotify($user_id, $target_id, $content, $href){
        $stmt = $this->db->prepare("INSERT INTO `notif` (source_id, target_id, content, href) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('iiss', $user_id, $target_id, $content, $href);
        $stmt->execute();
    }

    //Show the notify in dropdown menu
    public function showNotify($user_id){
        $stmt = $this->db->prepare("SELECT u.username, u.user_image, n.href, n.content, n.notif_id
        from `user` u 
        join notif n on u.user_id=n.source_id 
        where n.target_id =?
        order by n.notif_id desc");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);  
    }

    //Count the number of notification
    public function countNotification($user_id){
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM notif WHERE target_id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0]['count'];

    }

    //Delete signle notification
    public function deleteNotification($notif_id){
        $stmt = $this->db->prepare("DELETE FROM notif WHERE notif_id = ?");
        $stmt->bind_param('i', $notif_id);
        $stmt->execute();
    }

    //Delete all notification
    public function deleteAllNotifications($user_id){
        $stmt = $this->db->prepare("DELETE FROM notif WHERE target_id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
    }

    //Action to add or remove like
    public function toggleLike($user_id, $post_id, $like_bool){
        if(!$like_bool){
            $stmt = $this->db->prepare("INSERT INTO `like` (user_id, post_id) VALUES (?, ?)");
            $stmt->bind_param('ii', $user_id, $post_id);
            $stmt->execute();
        } else {
            $stmt = $this->db->prepare("DELETE FROM `like` WHERE user_id = ?  AND post_id = ?");
            $stmt->bind_param('ii', $user_id, $post_id);
            $stmt->execute();
        }
    }

    //Check if the user already liked a post
    public function isLiked($user_id, $post_id) {
        $stmt = $this->db->prepare("SELECT * FROM `like` 
        WHERE user_id = ?  AND post_id = ?");
        $stmt->bind_param('ii', $user_id, $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    //Get number of likes of a post
    public function getLikesCount($post_id){
        $stmt = $this->db->prepare("SELECT COUNT(*) 
        FROM `like`
        where post_id = ?");
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0]["COUNT(*)"];
    }

    //Get number of followers
    public function getFollowersCount($user_id){
        $follow=array();
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM follower WHERE target_id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $follow['followers']=$result->fetch_all(MYSQLI_ASSOC)[0]["COUNT(*)"];
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM follower WHERE source_id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $follow['following']=$result->fetch_all(MYSQLI_ASSOC)[0]["COUNT(*)"];
        return $follow;
    }

    //Action to add or remove follow
    public function toggleFollow($user_id, $target_id, $flag) {
        $stmt = $this->db->prepare("SELECT  follower (source_id, target_id) VALUES (?, ?)");
    }

    //Action to follow
    public function follow($user_id, $target_id) {
        try {
            $stmt = $this->db->prepare("INSERT INTO follower (source_id, target_id) VALUES (?, ?)");
            $stmt->bind_param('ii', $user_id, $target_id);
            $stmt->execute();
        } catch(mysqli_sql_exception $e) {
            if($e->getCode() == 1062) {
                echo('Already following');
            } else {
                throw $e;
            }
        }
    }

    //Action to unfollow
    public function unfollow($user_id, $target_id) {
        $stmt = $this->db->prepare("DELETE FROM follower WHERE source_id = ? AND target_id = ?");
        $stmt->bind_param('ii', $user_id, $target_id);
        $stmt->execute();
    }

    //Get user by email
    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT user_id, username, email, password, salt FROM user WHERE email = ? LIMIT 1");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Get user image
    public function getImage($user_id) {
        $stmt = $this->db->prepare("SELECT user_image FROM user WHERE user_id = ? LIMIT 1");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Get last post by ID
    public function getLastPostID() {
        $stmt = $this->db->prepare("SELECT post_id FROM post ORDER BY post_id DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Add post
    public function addPost($user_id, $description, $created_at, $post_image) {
        $insert_stmt = $this->db->prepare("INSERT INTO post (creator_id, description, created_at, post_image) VALUES (?, ?, ?, ?)");
        $insert_stmt->bind_param('isss', $user_id, $description, $created_at, $post_image);
        $insert_stmt->execute();
    }

    //Get creator ID by post
    public function getPostOwner($post_id){
        $stmt = $this->db->prepare("SELECT creator_id from post where post_id =?");
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0]["creator_id"];
    }

    //Get comments
    public function getComments($post_id) {
        $stmt = $this->db->prepare("SELECT c.user_id, u.username, u.nome, u.cognome, u.user_image, content FROM comment c
                                          JOIN user u ON c.user_id = u.user_id
                                          WHERE post_id = ?
                                          ORDER BY c.created_at");
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Add comment
    public function addComment($post_id, $user_id, $content, $created_at) {
        $insert_stmt = $this->db->prepare("INSERT INTO comment (post_id, user_id, content, created_at) VALUES (?, ?, ?, ?)");
        $insert_stmt->bind_param('iiss', $post_id, $user_id, $content, $created_at);
        $insert_stmt->execute();
    }

    //Add login attempt to db
    public function addAttempt($user_id, $now) {
        $this->db->query("INSERT INTO login_attempts (user_id, time) VALUES ('$user_id', '$now')");
    }

    //Update profile info
    public function updateProfile($user_id, $email, $password, $salt, $nome, $cognome, $bio, $image) {
        $insert_stmt = $this->db->prepare("UPDATE user SET email=?,password=?,salt=?,nome=?,cognome=?,bio=?,user_image=?
                                                 WHERE user_id=?");
        $insert_stmt->bind_param('sssssssi',  $email, $password, $salt, $nome, $cognome, $bio, $image, $user_id);
        $insert_stmt->execute();
    }

    //Check bruteforcing attempts
    public function checkBrute($user_id) {
        $now = time();
        // Vengono analizzati tutti i tentativi di login a partire dalle ultime due ore.
        $valid_attempts = $now - (2 * 60 * 60);
        if ($stmt = $this->db->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) {
            $stmt->bind_param('i', $user_id);
            // Eseguo la query creata.
            $stmt->execute();
            $stmt->store_result();
            // Verifico l'esistenza di più di 5 tentativi di login falliti.
            if($stmt->num_rows > 5) {
                return true;
            } else {
                return false;
            }
        }
    }
}
?>
